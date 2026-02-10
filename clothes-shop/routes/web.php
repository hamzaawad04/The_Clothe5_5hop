<?php

use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/dashboard', function () {
    return view('profile.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    /* Profile routes */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /* Cart routes */
    Route::get('/cart', [CartController::class, 'index'])->name('cart.basket');
    Route::post('/cart/add', [CartController::class, 'addItem'])->name('cart.add');
    Route::post('/cart/update/{variant_id}', [CartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/remove/{variant_id}', [CartController::class, 'removeItem'])->name('cart.remove');
    Route::delete('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');

    /* Order routes */
    Route::get('/checkout', [OrderController::class, 'showCheckout'])->name('orders.checkout');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout.place-order');
    Route::get('/orders/confirmation/{order_id}', [OrderController::class, 'confirmation'])->name('orders.confirmation');
});

/* Contact routes */
Route::get('/contact', [ContactMessageController::class, 'create'])->name('contact');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

/* Product Variant routes */
Route::resource('variants', ProductVariantController::class);

/* Category routes */
Route::resource('categories', CategoryController::class);

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

/* Category browsing */
Route::get('/tops', [ProductController::class, 'tops'])->name('products.tops');
Route::get('/bottoms', [ProductController::class, 'bottoms'])->name('products.bottoms');
Route::get('/footwear', [ProductController::class, 'footwear'])->name('products.footwear');
Route::get('/outerwear', [ProductController::class, 'outerwear'])->name('products.outerwear');
Route::get('/accessories', [ProductController::class, 'accessories'])->name('products.accessories');

/* Product Show (individual product page) */
Route::get('/product/{product_id}', [ProductController::class, 'show'])->name('product.show');

require __DIR__.'/auth.php';
