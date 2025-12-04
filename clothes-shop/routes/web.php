<?php

use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/contact', [ContactMessageController::class, 'create'])->name('contact');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');


Route::get('/about', function () {
    return view('about');
})->name('about');

require __DIR__.'/auth.php';
