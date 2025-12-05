<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $cart = $user->cart ?? Cart::create([
            'user_id'       => $user->user_id,
            'session_token' => null
        ]);

        $items = $cart->items()
            ->with(['product'])
            ->get();

        return view('cart.basket', [
            'cart'  => $cart,
            'items' => $items
        ]);
    }

    public function addItem(Request $request)
    {
        $request->validate([
            // now we check product table
            'variant_id' => 'required|exists:products,product_id',
            'qty'        => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        $cart = $user->cart ?? Cart::create([
            'user_id'       => $user->user_id,
            'session_token' => null
        ]);

        $product = Product::findOrFail($request->variant_id);

        $existing = CartItem::where('cart_id', $cart->cart_id)
            ->where('variant_id', $product->product_id)
            ->first();

        if ($existing) {
            $existing->qty += $request->qty;
            $existing->save();
        } else {
            CartItem::create([
                'cart_id'    => $cart->cart_id,
                'variant_id' => $product->product_id,
                'qty'        => $request->qty,
            ]);
        }

        return redirect()->back()->with('success', 'Item added to cart.');
    }

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

    public function removeItem($variant_id)
    {
        $cart = Auth::user()->cart;

        CartItem::where('cart_id', $cart->cart_id)
            ->where('variant_id', $variant_id)
            ->delete();

        return redirect()->back()->with('success', 'Item removed.');
    }

    public function clear()
    {
        $cart = Auth::user()->cart;

        CartItem::where('cart_id', $cart->cart_id)->delete();

        return redirect()->back()->with('success', 'Cart cleared.');
    }
}
