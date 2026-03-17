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
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalUsers = User::count();

        $recentOrders = Order::latest()
            ->take(5)
            ->get();

        //$lowStockProducts = ProductVariant::whereColumn('stock_qty', '<=', 'low_stock_threshold')->get();

        return view('profile.admin.admindashboard', [
            'totalOrders' => $totalOrders,
            'totalProducts' => $totalProducts,
            'totalUsers' => $totalUsers,
            'recentOrders' => $recentOrders,
            //'lowStockProducts' => $lowStockProducts
        ]);
    }
}