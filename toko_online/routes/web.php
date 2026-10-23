<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderHistoryController;
use App\Http\Controllers\StatelessCartController;



Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/{id_barang}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id_barang}', [CartController::class, 'remove'])->name('cart.remove');
});


Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('/riwayat-pesanan', [OrderHistoryController::class, 'index'])->name('orders.index');

Route::get('/stateless-shop', [StatelessCartController::class, 'index'])
    ->name('stateless.shop');

Route::post('/stateless-cart/add', [StatelessCartController::class, 'add'])
    ->name('stateless.cart.add');

Route::post('/stateless-cart/update', [StatelessCartController::class, 'update'])
    ->name('stateless.cart.update');

