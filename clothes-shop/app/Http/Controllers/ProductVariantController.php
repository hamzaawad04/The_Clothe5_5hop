<?php

namespace App\Http\Controllers;

use App\Models\ProductVariant;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductVariantController extends Controller
{
    public function index()
    {
        $variants = ProductVariant::with('product')->paginate(20);
        return view('variants.index', ['variants' => $variants]);
    }

    public function show(ProductVariant $variant)
    {
        $variant->load('product');
        return view('variants.show', ['variant' => $variant]);
    }

}