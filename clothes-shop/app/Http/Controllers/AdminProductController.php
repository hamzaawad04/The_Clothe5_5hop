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

    public function index()
    {
        $products = Product::with(['category', 'images' => function ($query) {
            $query->orderByDesc('is_primary')->orderBy('product_image_id');
        }])
        ->orderByDesc('product_id')
        ->get();

        return view('admin.products.index', compact('products'));
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

            'variants' => 'required|array|min:1',
            'variants.*.size' => 'required|string',
            'variants.*.colour' => 'required|string',
            'variants.*.stock_qty' => 'required|integer|min:0',
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

        if ($request->has('variants')) {
            foreach ($request->variants as $variant) {
                $product->variants()->create([
                    'size' => $variant['size'],
                    'colour' => $variant['colour'],
                    'stock_qty' => $variant['stock_qty'],
                ]);
            }
        }

        return redirect()->route('admin.products.index')
            ->with('success', 'Product created successfully');
    }

    public function edit($product_id)
    {
        $product = Product::with('images')->where('product_id', $product_id)->firstOrFail();
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

            'variants' => 'required|array|min:1',
            'variants.*.size' => 'required|string',
            'variants.*.colour' => 'required|string',
            'variants.*.stock_qty' => 'required|integer|min:0',
        ]);

        $product->update([
            'name' => $request->name,
            'base_price' => $request->base_price,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'slug' => Str::slug($request->name),
        ]);

        $existingVariantIds = [];

        foreach ($request->variants as $variantData) {

            if (isset($variantData['variant_id'])) {
                $variant = ProductVariant::find($variantData['variant_id']);

                if ($variant) {
                    $variant->update([
                        'size' => $variantData['size'],
                        'colour' => $variantData['colour'],
                        'stock_qty' => $variantData['stock_qty'],
                    ]);

                    $existingVariantIds[] = $variant->variant_id;
                }
            } 
            else {
                $newVariant = $product->variants()->create([
                    'size' => $variantData['size'],
                    'colour' => $variantData['colour'],
                    'stock_qty' => $variantData['stock_qty'],
                ]);

                $existingVariantIds[] = $newVariant->variant_id;
            }
        }

        $product->variants()
            ->whereNotIn('variant_id', $existingVariantIds)
            ->delete();

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
}