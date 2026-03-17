<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller
{
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

