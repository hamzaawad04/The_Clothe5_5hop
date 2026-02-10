<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use App\Models\InventoryTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    /* Show one order */
    public function show($order_id)
    {
        $user = Auth::user();

        $order = Order::where('order_id', $order_id)
                      ->where('user_id', Auth::id())
                      ->with('items.product', 'items.variant')
                      ->firstOrFail();

        return view('showOrder', [
            'order' => $order,
            'user' => $user
        ]);
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
                'status' => 'pending',
                'total_amount' => 0, 
                'ship_name' => $request->ship_name,
                'ship_address' => $request->ship_address,
                'payment_method' => $request->payment_method,
                'order_date' => now(),
            ]);

            $total = 0;

            foreach ($cartItems as $item) {
                $variant = $variant = $item->variant;

                if (!$variant || $variant->stock_qty < $item->qty) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Insufficient stock for one or more items.');
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

                $variant->stock_qty -= $item->qty;
                $variant->save();

                InventoryTransaction::create([
                    'variant_id' => $variant->variant_id,
                    'change_qty' => -$item->qty,
                    'reason' => 'Order #' . $order->order_id,
                ]);
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

        /* if (!$cart || $cart->items->isEmpty()) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        } */

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
                        'color' => $item->variant->color,
                        'quantity' => $item->qty,
                        'description' => $item->variant->product->description
                    ];
                })
            ]
        ]);
    }

}

