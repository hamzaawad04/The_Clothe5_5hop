<?php

namespace App\Http\Controllers;

use App\OrderStatus;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use App\Models\InventoryTransaction;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /* Show all orders for the logged-in customer */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->withCount('items')
            ->orderByDesc('order_date')
            ->get();

        return view('orders.status', [
            'orders' => $orders,
        ]);
    }

    /* Show one order */
    public function show($order_id)
    {
        $order = Order::where('order_id', $order_id)
            ->where('user_id', Auth::id())
            ->with('items.product', 'items.variant')
            ->firstOrFail();

        return view('orders.status_details', [
            'order' => $order,
        ]);
    }

    /* Cancel a customer's cancellable order */
    public function cancel($order_id)
    {
        DB::beginTransaction();

        try {
            $order = Order::where('order_id', $order_id)
                ->where('user_id', Auth::id())
                ->lockForUpdate()
                ->firstOrFail();

            $cancellableStatuses = [OrderStatus::PENDING->value, OrderStatus::PAID->value];
            if (!in_array($order->status->value, $cancellableStatuses, true)) {
                DB::rollBack();
                return redirect()
                    ->route('orders.index')
                    ->with('error', 'This order can no longer be cancelled.');
            }

            $orderItems = OrderItem::where('order_id', $order->order_id)
                ->with('variant')
                ->get();

            foreach ($orderItems as $item) {
                if ($item->variant) {
                    $item->variant->stock_qty += $item->qty;
                    $item->variant->save();
                }
            }

            $order->status = OrderStatus::CANCELLED;
            $order->save();

            DB::commit();

            return redirect()
                ->route('orders.index')
                ->with('success', "Order #{$order->order_id} has been cancelled.");
        } catch (ModelNotFoundException $e) {
            DB::rollBack();
            abort(404);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()
                ->route('orders.index')
                ->with('error', 'Unable to cancel this order right now. Please try again.');
        }
    }

    /* Convert user's cart into an order */
    public function checkout(Request $request)
    {
        $user = Auth::user();
        
        $cart = Cart::where('user_id', $user->user_id)->firstOrFail();
        $cartItems = CartItem::where('cart_id', $cart->cart_id)->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();

        try {
            $order = Order::create([
                'user_id' => $user->user_id,
                'status' => 'Pending',
                'total_amount' => 0, 
                'ship_name' => $request->ship_name,
                'ship_address' => $request->ship_address,
                'payment_method' => $request->payment_method,
                'order_date' => now(),
            ]);

            $total = 0;

            foreach ($cartItems as $item) {
                $variant = $item->variant;

                if (!$variant) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'A product in your cart is no longer available.');
                }

                if ($item->qty > $variant->stock_qty) {
                    DB::rollBack();
                    return redirect()->back()->with('error', "Insufficient stock for {$variant->product->name} ({$variant->size}, {$variant->colour}).");
                }

                $unitPrice = $variant->product->base_price;
                $lineTotal = $unitPrice * $item->qty;

                $total += $lineTotal;

                OrderItem::create([
                    'order_id'   => $order->order_id,
                    'product_id' => $variant->product->product_id,
                    'variant_id' => $variant->variant_id,
                    'unit_price' => $unitPrice,
                    'qty'        => $item->qty,
                    'line_total' => $lineTotal,
                ]);

                /* InventoryTransaction::create([
                    'variant_id' => $variant->variant_id,
                    'change_qty' => -$item->qty,
                    'reason' => 'Order #' . $order->order_id,
                ]); */
            }

            $order->total_amount = $total;
            $order->save();

            CartItem::where('cart_id', $cart->cart_id)->delete();

            DB::commit();

            return redirect()->route('orders.confirmation', $order->order_id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Checkout failed: ' . $e->getMessage());
        }
    }

    /* Show confirmation page after order has been placed */
    public function confirmation($order_id)
    {
        $order = Order::where('order_id', $order_id)
                      ->where('user_id', Auth::id())
                      ->with('items.product', 'items.variant')
                      ->firstOrFail();

        return view('orders.confirmation', [
            'order' => $order
        ]);
    }

    /* Show checkout page */
    public function showCheckout()
    {
        $user = auth()->user();
        $cart = $user->cart;

        if (!$cart || $cart->items->isEmpty()) {
            return view('orders.checkout', [
                'basket' => ['items' => []]
        ]);
    }

        return view('orders.checkout', [
            'basket' => [
                'items' => $cart->items->map(function ($item) {
                    return [
                        'id' => $item->variant_id,
                        'name' => $item->variant->product->name,
                        'image' => $item->variant->product->images->first()->url ?? null,
                        'price' => $item->variant->product->base_price,
                        'size' => $item->variant->size,
                        'colour' => $item->variant->colour,
                        'quantity' => $item->qty,
                        'description' => $item->variant->product->description
                    ];
                })
            ]
        ]);
    }


    public function returns()
    {
        $returnStatuses = [
            OrderStatus::COMPLETED->value,
            OrderStatus::RETURNREQUESTED->value,
            OrderStatus::RETURNACCEPTED->value,
            OrderStatus::REFUNDED->value,
        ];

        $orders = Order::where('user_id', Auth::id())
            ->whereIn('status', $returnStatuses)
            ->withCount('items')
            ->orderByDesc('order_date')
            ->get();

        return view('orders.returns', [
            'orders' => $orders,
        ]);
    }

    public function requestReturn($order_id)
    {
        $order = Order::where('order_id', $order_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($order->status->value !== OrderStatus::COMPLETED->value) {
            return redirect()
                ->route('orders.returns')
                ->with('error', 'Only completed orders can be requested for return.');
        }

        $order->status = OrderStatus::RETURNREQUESTED;
        $order->save();

        return redirect()
            ->route('orders.returns')
            ->with('success', "Return requested for order #{$order->order_id}.");
    }

}
