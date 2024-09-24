<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $categories = Category::whereNull('parent_id')->get();
    $categories->load('childrenRecursive');
    return view('home', [
        // 'products' => \App\Models\Product::take(8)->get(),
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Shopping cart routes
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
Route::patch('/cart/{product}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{product}', [CartController::class, 'destroy'])->name('cart.destroy');
Route::get('/cart/checkout', [CartController::class, 'checkout'])->name('checkout.index');

// Order routes
Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('order.show');
Route::get('/orders', [OrderController::class, 'index'])->name('order.index');

// Payment
Route::post('/payments', [PaymentController::class, 'submit'])->name('payment.submit');

// Categories
Route::get('/shop/{category}', [CategoryController::class, 'show'])->name('categories.show');

// Products
Route::get('/products', [ProductController::class, 'index'])->name('product.index');
Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('product.show');

// Brands
// Route::get('/brands/{brand}', [BrandController::class, 'show'])->name('brands.show');
// Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');

// Collections
// Route::get('/collections/{collection}', [CollectionController::class, 'show'])->name('collections.show');


require __DIR__.'/auth.php';
