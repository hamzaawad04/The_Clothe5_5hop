<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())
            ->with(['product.images', 'variant'])
            ->get();

        return view('wishlist.wishlist', [
            'wishlists' => $wishlists,
            'count' => $wishlists->count()
        ]);
    }

    public function addToWishlist(Request $request)
    {
        $request->validate([
            'variant_id' => 'required|exists:product_variants,variant_id',
        ]);

        $variant = \App\Models\ProductVariant::findOrFail($request->variant_id);

        // Check if already in wishlist
        $existing = Wishlist::where('user_id', Auth::id())
            ->where('variant_id', $request->variant_id)
            ->first();

        if ($existing) {
            return response()->json([
            'success' => false,
            'message' => 'Item already in wishlist'
        ]);
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $variant->product_id,
            'variant_id' => $request->variant_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Item added to wishlist'
        ]);
    }

    public function removeFromWishlist($variant_id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('variant_id', $variant_id)
            ->firstOrFail();

        $wishlist->delete();

        return redirect()->route('wishlist.index')->with('success', 'Item removed from favorites');
    }

    public function moveToCart($variant_id)
    {
        $wishlist = Wishlist::where('user_id', Auth::id())
            ->where('variant_id', $variant_id)
            ->firstOrFail();

        $cart = \App\Models\Cart::firstOrCreate(['user_id' => Auth::id()]);

        $existingCartItem = \App\Models\CartItem::where('cart_id', $cart->cart_id)
            ->where('variant_id', $variant_id)
            ->first();

        if ($existingCartItem) {
            $existingCartItem->qty += 1;
            $existingCartItem->save();
        } else {
            \App\Models\CartItem::create([
                'cart_id' => $cart->cart_id,
                'variant_id' => $variant_id,
                'qty' => 1,
            ]);
        }

        $wishlist->delete();

        return redirect()->route('wishlist.index')->with('success', 'Item moved to basket');
    }
}
