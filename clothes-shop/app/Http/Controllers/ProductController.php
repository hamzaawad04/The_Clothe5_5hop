<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{   

    /**
     *  Returns the index view for the products.
     * 
     *  @return Illuminate\View\View 
     */
    public function index() {
        return view('products.index', ['products' => Product::all()]);
    }

    public function tops() {
        $products = Product::where('category_id', 1)
                            ->with('images')
                            ->get();

        return view('products.tops', compact('products'));
    }

    public function bottoms() {
        $products = Product::where('category_id', 2)
                            ->with('images')
                            ->get();

        return view('products.bottoms', compact('products'));
    }

    public function footwear() {
        $products = Product::where('category_id', 3)
                            ->with('images')
                            ->get();

        return view('products.footwear', compact('products'));
    }

    public function outerwear() {
        $products = Product::where('category_id', 4)
                            ->with('images')
                            ->get();

        return view('products.outerwear', compact('products'));
    }

    public function accessories() {
        $products = Product::where('category_id', 5)
                            ->with('images')
                            ->get();

        return view('products.accessories', compact('products'));
    }


    /**
     *  Returns the create view for the products.
     * 
     *  @return Illuminate\View\View
     */
    public function create() {
        return view('products.create');
    }


    /**
     *  Method for storing product data into database
     * 
     *  @param Illuminate\Http\Request : $request 
     *  @return Illuminate\Http\RedirectResponse
     */

    public function store(Request $request) {

        //  Validate
        $product = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'base_price' => 'required|numeric',
            'low_stock_threshold' => 'nullable|integer',
            'category_id' => 'required|integer|exists:categories,category_id'
        ]);

        Product::create($product);

        return redirect()
        ->route('products.index');
    }

    
    /**
     *  Method for getting attributes for individual product
     * 
     *  @param $product_id
     *  @return Illuminate\View\View
     */

    public function show($product_id) {
        return view('products.show', ['product' => Product::findOrFail($product_id)]);
    }

    /**
     *  Gets product based off of its product_id, and will return the 'products.edit' view,
     *  and pass the specific product data to that view.
     * 
     *  @param $product_id
     *  @return Illuminate\View\View
     */

    public function edit($product_id) {
        return view('products.edit', ['product' => Product::findOrFail($product_id)]);
        
    }


    /**
     *  Method for updating the attributes of an existing product.
     *  
     *  @param Illuminate\Http\Request : $request
     *  @param $product_id
     *  @return Illuminate\Http\RedirectResponse
     */

    public function update(Request $request, $product_id) {
        
        $product = Product::findOrFail($product_id);

        $updated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'base_price' => 'required|numeric',
            'low_stock_threshold' => 'nullable|integer',
            'category_id' => 'required|integer|exists:categories,category_id'
        ]);

        $product->update($updated);

        return redirect()
        ->route('products.index');
    }


    /**
     *  Delete the specified product
     * 
     *  @param $product_id
     */

    public function destroy($product_id) {
        $productToDelete = Product::findOrFail($product_id);
        $productToDelete->delete();

        return redirect()
        ->route('products.index');
    }
}
