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

    public function create()
    {
        $products = Product::all();
        return view('variants.create', ['products' => $products]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'size' => 'required|string|max:50',
            'colour' => 'nullable|string|max:50',
            'stock_qty' => 'required|integer|min:0',
        ]);

        ProductVariant::create($validated);
        return redirect()->route('variants.index')->with('success', 'Variant created');
    }

    public function show(ProductVariant $variant)
    {
        $variant->load('product');
        return view('variants.show', ['variant' => $variant]);
    }

    public function edit(ProductVariant $variant)
    {
        $products = Product::all();
        return view('variants.edit', ['variant' => $variant, 'products' => $products]);
    }

    public function update(Request $request, ProductVariant $variant)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'size' => 'required|string|max:50',
            'colour' => 'nullable|string|max:50',
            'stock_qty' => 'required|integer|min:0',
        ]);

        $variant->update($validated);
        return redirect()->route('variants.index')->with('success', 'Variant updated');
    }

    public function destroy(ProductVariant $variant)
    {
        $variant->delete();
        return redirect()->route('variants.index')->with('success', 'Variant deleted');
    }
}