<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\OrderStatus;

class AdminOrderController extends Controller
{
public function index(Request $request): View
{
    $query = Order::with('user');

    // Filter by status
    if ($request->filled('status')) {
        $query->where('status', $request->status);
    }

    // Filter by customer shipping name (letter search)
if ($request->filled('search')) {
    $query->where('ship_name', 'like', '%' . $request->search . '%');
}

    // Filter by date range
    if ($request->filled('date_from')) {
        $query->whereDate('order_date', '>=', $request->date_from);
    }

    if ($request->filled('date_to')) {
        $query->whereDate('order_date', '<=', $request->date_to);
    }

    $orders = $query
        ->orderByDesc('order_date')
        ->paginate(10); // better than get()

    return view('admin.orders.index', compact('orders'));
}


public function updateStatus(Request $request, $order_id) 
{
    $validated = $request->validate([
        'status' => 'required|in:Pending,Paid,Shipped,Completed,Cancelled,Return Requested,Return Accepted,Refunded',
    ]);

    $order = Order::with('items.variant')->findOrFail($order_id);

    $oldStatus = $order->status; 
    $newStatus = OrderStatus::from($validated['status']);

    if ($oldStatus !== $newStatus) {

        if ($newStatus === OrderStatus::COMPLETED) {
            foreach ($order->items as $item) {
                $variant = $item->variant;

                if ($variant) {
                    $variant->stock_qty -= $item->qty;
                    $variant->save();
                }
            }
        }

        if ($newStatus === OrderStatus::REFUNDED) {
            foreach ($order->items as $item) {
                $variant = $item->variant;

                if ($variant) {
                    $variant->stock_qty += $item->qty;
                    $variant->save();
                }
            }
        }
    }

    $order->status = $newStatus;
    $order->save();

    return redirect()->route('admin.orders.index')
        ->with('success', 'Order status successfully updated');
}

    public function show($order_id) {
        $order = Order::with(['items.product', 'items.variant', 'user'])
            ->findOrFail($order_id);

        return view('admin.orders.order_details', compact('order'));
    }

  /* Admin sales analytics dashboard */
    public function salesAnalytics()
    {
        $totalOrders = Order::count();

        $topProducts = OrderItem::select('product_id', DB::raw('SUM(qty) as total_qty'))
            ->groupBy('product_id')
            ->orderByDesc('total_qty')
            ->with('product')
            ->take(10)
            ->get();

        $categoryBreakdown = OrderItem::join('products', 'order_items.product_id', '=', 'products.product_id')
            ->join('categories', 'products.category_id', '=', 'categories.category_id')
            ->select('categories.name as category_name', DB::raw('SUM(order_items.qty) as total_qty'))
            ->groupBy('categories.name')
            ->orderByDesc('total_qty')
            ->get();

        return view('admin.dashboard.salesAnalytics', [
            'totalOrders' => $totalOrders,
            'topProducts' => $topProducts,
            'categoryBreakdown' => $categoryBreakdown,
        ]);
    }

    public function salesAnalyticsCount()
    {
        return response()->json(['totalOrders' => Order::count()]);
    }
}
