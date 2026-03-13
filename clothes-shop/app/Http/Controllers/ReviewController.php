<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $product_id)
    {
        // Validate input
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'nullable|string|max:1000'
        ]);

        // Prevent duplicate reviews
        $existingReview = Review::where('product_id', $product_id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingReview) {
            return back()->with('error', 'You have already reviewed this product.');
        }

        // Create review
        Review::create([
            'product_id' => $product_id,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'review_text' => $request->review_text
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }
}