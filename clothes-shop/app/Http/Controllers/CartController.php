<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    /* Show entire cart */
    public function index()
    {
        $user = Auth::user();

        $cart = $user->cart ?? Cart::create([
            'user_id' => $user->user_id,
            'session_token' => null
        ]);

        $items = $cart->items()->with(['variant.product'])->get();

        return view('cart.basket', [
            'cart' => $cart,
            'items' => $items
        ]);
    }

    /* Add product variant to cart */
    public function addItem(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,variant_id',
            'qty' => 'required|integer|min=1'
        ]);

        $user = Auth::user();

        $cart = $user->cart ?? Cart::create([
            'user_id' => $user->user_id,
            'session_token' => null
        ]);

        $variant = ProductVariant::find($request->variant_id);

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

    /* Update the quantity of a product variant within cart */
    public function updateQuantity(Request $request, $variant_id)
    {
        $request->validate([
            'qty' => 'required|integer|min=1'
        ]);

        $cart = Auth::user()->cart;

        $item = CartItem::where('cart_id', $cart->cart_id)
            ->where('variant_id', $variant_id)
            ->firstOrFail();

        $item->qty = $request->qty;
        $item->save();

        return redirect()->back()->with('success', 'Quantity updated.');
    }

    /* Remove product variant from cart */
    public function removeItem($variant_id)
    {
        $cart = Auth::user()->cart;

        CartItem::where('cart_id', $cart->cart_id)
            ->where('variant_id', $variant_id)
            ->delete();

        return redirect()->back()->with('success', 'Item removed.');
    }

    /* Empty cart */
    public function clear()
    {
        $cart = Auth::user()->cart;

        CartItem::where('cart_id', $cart->cart_id)->delete();

        return redirect()->back()->with('success', 'Cart cleared.');
    }
}
