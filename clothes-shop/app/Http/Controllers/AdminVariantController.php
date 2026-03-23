<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductVariant;

class AdminVariantController extends Controller
{
    public function edit($variant_id) {
        $variant = ProductVariant::findOrFail($variant_id);
        return view('admin.variants.edit', compact('variant'));
    }


    public function update(Request $request, $variant_id) {

        $variant = ProductVariant::findOrFail($variant_id);

        $request->validate([
            'size' => 'required|string',
            'colour' => 'required|string',
            'stock_qty' => 'required|integer|min:0',
            'low_stock_threshold' => 'required|integer|min:0',
        ]);


        $variant->update([
            'size' => $request->size,
            'colour' => $request->colour,
            'stock_qty' => $request->stock_qty,
            'low_stock_threshold' => $request->low_stock_threshold,
        ]);

        return redirect()->back()->with('success', 'Variant updated successfully');
    }


    public function destroy($variant_id) {
        $variant = ProductVariant::findOrFail($variant_id);
        $variant->delete();

        return redirect()->back()->with('success', 'Variant deleted successfully');
    }
}
