<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('landingpage');

Route::middleware(['auth', 'adminMiddleware'])->group(function () {
    // Admin routes
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Orders management routes
    Route::get('admin/orders', [OrdersController::class, 'index'])->name('admin.orders.index');
    Route::patch('admin/orders/{transaction}/status', [OrdersController::class, 'updateStatus'])
        ->name('admin.orders.update-status');

    // Menu management routes
    Route::get('admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    // Customer management routes
    Route::get('admin/customers', [CustomerController::class, 'tampil'])->name('admin.customers.index');


});

Route::middleware(['auth', 'customerMiddleware'])->group(function () {
    Route::get('/dashboard', [CustomerController::class, 'index'])->name('dashboard');

    // Cart
    Route::post('/cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('update-cart/{product}', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('remove-from-cart/{product}', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // Transaction routes
    Route::post('/checkout', [TransactionsController::class, 'checkout'])->name('checkout');
    Route::get('/history', [TransactionsController::class, 'history'])->name('history');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';