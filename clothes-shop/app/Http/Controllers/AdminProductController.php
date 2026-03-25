<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with([
            'category',
            'images' => function ($query) {
                $query->orderByDesc('is_primary')
                      ->orderBy('product_image_id');
            }
        ]);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query
            ->orderByDesc('product_id')
            ->paginate(10);

        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,category_id',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048',

            'variant.size' => 'required|string',
            'variant.colour' => 'required|string',
            'variant.stock_qty' => 'required|integer|min:0',
            'variant.low_stock_threshold' => 'required|integer|min:0',
        ]);

        $product = Product::create([
            'name' => $request->name,
            'base_price' => $request->base_price,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'slug' => Str::slug($request->name),
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');

            ProductImage::create([
                'product_id' => $product->product_id,
                'url' => 'storage/' . $path,
                'is_primary' => 1,
            ]);
        }

        $product->variants()->create([
            'size' => $request->variant['size'],
            'colour' => $request->variant['colour'],
            'stock_qty' => $request->variant['stock_qty'],
            'low_stock_threshold' => $request->variant['low_stock_threshold'],
        ]);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully');
    }

    public function edit($product_id)
    {
        $product = Product::with('images')
            ->where('product_id', $product_id)
            ->firstOrFail();

        $categories = Category::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $product_id)
    {
        $product = Product::where('product_id', $product_id)->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'base_price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,category_id',
            'description' => 'nullable|string',
        ]);

        $product->update([
            'name' => $request->name,
            'base_price' => $request->base_price,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'slug' => Str::slug($request->name),
        ]);

        if (
        $request->filled('variant.size') ||
        $request->filled('variant.colour') ||
        $request->filled('variant.stock_qty') ||
        $request->filled('variant.low_stock_threshold')
    ) {

        $request->validate([
            'variant.size' => 'required|string',
            'variant.colour' => 'required|string',
            'variant.stock_qty' => 'required|integer|min:0',
            'variant.low_stock_threshold' => 'required|integer|min:0',
        ]);

        $product->variants()->create([
            'size' => $request->variant['size'],
            'colour' => $request->variant['colour'],
            'stock_qty' => $request->variant['stock_qty'],
            'low_stock_threshold' => $request->variant['low_stock_threshold'],
        ]);
    }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully');
    }

    public function destroy($product_id)
    {
        $product = Product::where('product_id', $product_id)->firstOrFail();

        foreach ($product->images as $image) {
            $image->delete();
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully');
    }

    public function show($product_id)
    {
        $product = Product::with('variants')
            ->where('product_id', $product_id)
            ->firstOrFail();

        return view('admin.products.variant', compact('product'));
    }
}