<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Show user cart (basket page)
     */
    public function index()
    {
        $user = Auth::user();

        // If user has no cart yet, create one
        $cart = $user->cart ?? Cart::create([
            'user_id' => $user->user_id,
            'session_token' => null
        ]);

        

        // Eager load product & variant
        $items = $cart->items()
            ->with(['variant.product'])
            ->get();

        return view('cart.basket', [
            'cart' => $cart,
            'items' => $items
        ]);

        dd($cart);

    }

    /**
     * Add a product variant to the cart
     */
   public function addItem(Request $request)
{
    // For debugging: show request data and stop execution
    //dd($request->all());
    


    $request->validate([
        'variant_id' => 'required|exists:product_variants,variant_id',
        'qty' => 'required|integer|min:1'
    ]);

    $user = Auth::user();

    $cart = $user->cart ?? Cart::create([
        'user_id' => $user->user_id,
        'session_token' => null
    ]);

    $variant = ProductVariant::findOrFail($request->variant_id);

    $existing = CartItem::where('cart_id', $cart->cart_id)
        ->where('variant_id', $variant->variant_id)
        ->first();

    if ($existing) {
        $existing->qty += $request->qty;
        $existing->save();
    } else {
        CartItem::create([
            'cart_id' => $cart->cart_id,
            'variant_id' => $variant->variant_id,
            'qty' => $request->qty
        ]);
    }

    return redirect()->back()->with('success', 'Item added to cart.');
}

    /**
     * Update item quantity in cart
     */
    public function updateQuantity(Request $request, $variant_id)
    {
        $request->validate([
            'qty' => 'required|integer|min:1'
        ]);

        $cart = Auth::user()->cart;

        $item = CartItem::where('cart_id', $cart->cart_id)
            ->where('variant_id', $variant_id)
            ->firstOrFail();

        $item->qty = $request->qty;
        $item->save();

        return redirect()->back()->with('success', 'Quantity updated.');
    }

    /**
     * Remove an item from the cart
     */
    public function removeItem($variant_id)
    {
        $cart = Auth::user()->cart;

        CartItem::where('cart_id', $cart->cart_id)
            ->where('variant_id', $variant_id)
            ->delete();

        return redirect()->back()->with('success', 'Item removed.');
    }

    /**
     * Clear the entire cart
     */
    public function clear()
    {
        $cart = Auth::user()->cart;

        CartItem::where('cart_id', $cart->cart_id)->delete();

        return redirect()->back()->with('success', 'Cart cleared.');
    }
}
