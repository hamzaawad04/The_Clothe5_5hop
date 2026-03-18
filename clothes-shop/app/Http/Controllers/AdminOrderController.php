<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminOrderController extends Controller
{

    public function index(Request $request): View {

        // Get orders
        $orders = Order::with('user')
            ->orderByDesc('order_date')
            ->get();

        return view('admin.orders.index', compact('orders'));
    }


    public function updateStatus(Request $request, $order_id) {
        
        $validated = $request->validate([
            'status' => 'required|in:pending,paid,shipped,completed,cancelled'
        ]);

        $order = Order::findOrFail($order_id);
        $order->status = $validated['status'];
        $order->save();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Order status successfully updated');
    }

    public function show($order_id) {
        $order = Order::with(['items.product', 'items.variant', 'user'])
            ->findOrFail($order_id);

        return view('orders.status_details', compact('order'));
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

        return view('profile.admin.salesAnalytics', [
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

