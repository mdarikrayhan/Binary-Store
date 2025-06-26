<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [HomeController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Authentication routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Category routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/categories/{id}/filter', [CategoryController::class, 'filter'])->name('categories.filter');
Route::get('/categories/{id}/sort', [CategoryController::class, 'sort'])->name('categories.sort');

// Product routes
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
Route::get('/products/filter', [ProductController::class, 'filter'])->name('products.filter');
Route::get('/products/sort', [ProductController::class, 'sort'])->name('products.sort');
Route::get('/products/search', [ProductController::class, 'search'])->name('products.search');

// Cart routes
Route::post('/cart/add', [CheckoutController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CheckoutController::class, 'viewCart'])->name('checkout.cart');
Route::post('/cart/update', [CheckoutController::class, 'updateCart'])->name('cart.update');
Route::post('/cart/remove', [CheckoutController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/clear', [CheckoutController::class, 'clearCart'])->name('cart.clear');

// Authenticated user routes
Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
    Route::post('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    
    // Checkout routes
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    
    // Order routes
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');
    Route::get('/orders/filter', [OrderController::class, 'filter'])->name('orders.filter');
    Route::get('/orders/{id}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');
    Route::get('/orders/{id}/invoice/download', [OrderController::class, 'downloadInvoice'])->name('orders.invoice.download');
});

// Admin routes
Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    // Admin dashboard
    Route::get('/', function () {
        return redirect()->route('admin.orders.index');
    })->name('dashboard');
    
    // Admin category routes
    Route::resource('categories', AdminCategoryController::class);
    
    // Admin product routes
    Route::resource('products', AdminProductController::class);
    
    // Admin order routes
    Route::resource('orders', AdminOrderController::class)->except(['create', 'store', 'destroy']);
    Route::get('orders/filter', [AdminOrderController::class, 'filter'])->name('orders.filter');
    Route::get('orders/export', [AdminOrderController::class, 'export'])->name('orders.export');
});

// Fallback route for 404
Route::fallback(function () {
    return view('errors.404');
});