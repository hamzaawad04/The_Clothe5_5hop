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
    $cart = auth()->user()->cart;

    if (!$cart) {
        return view('cart.basket')->with('items', []);
    }

    $items = $cart->items()->with('variant.product.images')->get();

    return view('cart.basket', compact('items'));
}

    /* Add product variant to cart */
   public function addItem(Request $request)
{
    $request->validate([
        'variant_id' => 'required|exists:product_variants,variant_id',
        'qty' => 'required|integer|min:1'
    ]);

    $user = auth()->user();

    // Get or create cart
    $cart = Cart::firstOrCreate(['user_id' => $user->user_id]);

    // If item already in cart, update quantity
    $existing = CartItem::where('cart_id', $cart->cart_id)
                        ->where('variant_id', $request->variant_id)
                        ->first();

    if ($existing) {
        $existing->qty += $request->qty;
        $existing->save();
    } else {
        CartItem::create([
            'cart_id' => $cart->cart_id,
            'variant_id' => $request->variant_id,
            'qty' => $request->qty
        ]);
    }

    return redirect()->route('cart.basket')->with('success', 'Item added to basket!');
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
