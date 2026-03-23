<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\ProductVariant;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalOrders   = Order::count();
        $totalProducts = Product::count();
        $totalUsers    = User::count();
        $totalRevenue  = Order::whereIn('status', ['paid', 'shipped', 'completed'])->sum('total_amount');

        $urgentOrders = Order::whereIn('status', ['pending', 'paid'])
            ->latest()
            ->take(5)
            ->get();

        $pendingOrdersCount = Order::whereIn('status', ['pending', 'paid'])->count();

        $lowStockVariants = ProductVariant::with('product')
            ->where('stock_qty', '<=', 10)
            ->orderBy('stock_qty', 'asc')
            ->take(5)
            ->get();

        $lowStockCount = ProductVariant::where('stock_qty', '<=', 10)->count();

$recentOrders = Order::where('status', 'completed')->latest()->take(5)->get();
        
return view('admin.dashboard.admindashboard', compact(
            'totalOrders',
            'totalProducts',
            'totalUsers',
            'totalRevenue',
            'urgentOrders',
            'pendingOrdersCount',
            'lowStockVariants',
            'lowStockCount',
            'recentOrders'
        ));
    }
}