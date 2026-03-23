<?php

use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminVariantController;
use App\Http\Controllers\AdminCustomerController;
use App\Http\Controllers\CustomerController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Category;
use App\Models\Product;

Route::get('/', function () {
    return view('pages.home');
});

Route::get('/dashboard', [ProfileController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


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
    /* Wishlist routes */
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::post('/wishlist/move/{variant_id}', [WishlistController::class, 'moveToCart'])->name('wishlist.move');
    Route::delete('/wishlist/{variant_id}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');
    /* Order routes */
    Route::get('/checkout', [OrderController::class, 'showCheckout'])->name('orders.checkout');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('orders.place-order');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/returns', [OrderController::class, 'returns'])->name('orders.returns');
    Route::post('/orders/{order_id}/request-return', [OrderController::class, 'requestReturn'])
        ->whereNumber('order_id')
        ->name('orders.requestReturn');
    Route::get('/orders/confirmation/{order_id}', [OrderController::class, 'confirmation'])->name('orders.confirmation');
    Route::post('/orders/{order_id}/cancel', [OrderController::class, 'cancel'])
        ->whereNumber('order_id')
        ->name('orders.cancel');
    Route::get('/orders/{order_id}', [OrderController::class, 'show'])
        ->whereNumber('order_id')
        ->name('orders.show');
    Route::post('/product/{product_id}/review', [ReviewController::class, 'store'])->name('reviews.store');
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

Route::get('/tops', [ProductController::class, 'tops'])->name('products.tops');

Route::get('/bottoms', [ProductController::class, 'bottoms'])->name('products.bottoms');

Route::get('/footwear', [ProductController::class, 'footwear'])->name('products.footwear');

Route::get('/outerwear', [ProductController::class, 'outerwear'])->name('products.outerwear');

Route::get('/accessories', [ProductController::class, 'accessories'])->name('products.accessories');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/product/{product_id}', [ProductController::class, 'show'])->name('products.show');

/* Admin Routes */
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.admindashboard');

        Route::resource('products', AdminProductController::class);

        Route::resource('customers', AdminCustomerController::class);

        Route::get('/sales-analytics', [AdminOrderController::class, 'salesAnalytics'])
            ->name('dashboard.sales-analytics');

        Route::get('/sales-analytics/order-count', [AdminOrderController::class, 'salesAnalyticsCount'])
            ->name('sales-analytics.order-count');

        Route::get('/orders', [AdminOrderController::class, 'index'])
            ->name('orders.index');

        Route::patch('/orders/{order_id}/status', [AdminOrderController::class, 'updateStatus'])
            ->name('orders.updateStatus');

        Route::get('/orders/{order_id}', [AdminOrderController::class, 'show'])
            ->name('orders.show');

        Route::get('/inventory', [App\Http\Controllers\Admin\InventoryController::class, 'index'])->name('inventory.index');
        Route::post('/inventory/{variant}/add-stock', [App\Http\Controllers\Admin\InventoryController::class, 'addStock'])->name('inventory.addStock');    });

        Route::get('/admin/variants/{variant}/edit', [AdminVariantController::class, 'edit'])
        ->name('admin.variants.edit');
        
        Route::put('/admin/variants/{variant}', [AdminVariantController::class, 'update'])
        ->name('admin.variants.update');

        Route::delete('/admin/variants/{variant}', [AdminVariantController::class, 'destroy'])
        ->name('admin.variants.destroy');

require __DIR__.'/auth.php';
