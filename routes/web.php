<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\User\CategoryController as UserCategoryController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\OrderController as UserOrderController;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentication routes
Route::get('/signin', [AuthController::class, 'showSignin'])->name('auth.signin');
Route::post('/signin', [AuthController::class, 'signin'])->name('auth.signin.post');
Route::get('/signup', [AuthController::class, 'showSignup'])->name('auth.signup');
Route::post('/signup', [AuthController::class, 'signup'])->name('auth.signup.post');
Route::get('/profile', [AuthController::class, 'profile'])->name('auth.profile');
Route::post('/profile', [AuthController::class, 'updateProfile']);
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/logout', [AuthController::class, 'logout']);

// Admin routes (protected by middleware)
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('products', AdminProductController::class);
    Route::resource('orders', AdminOrderController::class)->except(['create', 'store']);
});

// User routes
Route::prefix('user')->name('user.')->group(function () {
    // Categories
    Route::get('/categories', [UserCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}', [UserCategoryController::class, 'show'])->name('categories.show');

    // Products
    Route::get('/products', [UserProductController::class, 'index'])->name('products.index');
    Route::get('/products/{id}', [UserProductController::class, 'show'])->name('products.show');

    // Checkout (protected)
    Route::post('/checkout', [CheckoutController::class, 'show'])->name('checkout.show');
    Route::post('/checkout/process', [CheckoutController::class, 'store'])->name('checkout.process');

    // Orders (protected)
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [UserOrderController::class, 'show'])->name('orders.show');
});

// Legacy routes for compatibility
Route::get('/category', [UserCategoryController::class, 'index']);
Route::get('/product', [UserProductController::class, 'index']);
Route::get('/product/single/{id}', [UserProductController::class, 'show']);
Route::get('/product/category/{id}', [UserCategoryController::class, 'show']);
Route::get('/order', [UserOrderController::class, 'index']);

// Legacy checkout routes
// Route::post('/user/checkout', [CheckoutController::class, 'store'])->name('user.checkout.store');
