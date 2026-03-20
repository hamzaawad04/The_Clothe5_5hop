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
            return redirect()->back()->with('info', 'Item already in wishlist');
        }

        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $variant->product_id,
            'variant_id' => $request->variant_id,
        ]);

        return redirect()->back()->with('success', 'Item added to wishlist');
    }

    public function removeFromWishlist($wishlist_id)
    {
        $wishlist = Wishlist::findOrFail($wishlist_id);
        
        if ($wishlist->user_id !== Auth::id()) {
            abort(403);
        }

        $wishlist->delete();

        return redirect()->route('wishlist.index')->with('success', 'Item removed from favorites');
    }
}
