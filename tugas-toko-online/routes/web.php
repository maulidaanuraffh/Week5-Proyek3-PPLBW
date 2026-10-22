<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

// Redirect root ke daftar produk
Route::get('/', function () {
    return redirect()->route('products.index');
});

// Auth routes (guest only)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Produk (bisa diakses semua orang)
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Keranjang + Order (harus login Customer)
Route::middleware('auth','can:use-cart')->group(function () {
    // Keranjang
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/tambah', [CartController::class, 'tambah'])->name('cart.tambah');
    Route::post('/cart/tambah-jumlah', [CartController::class, 'tambahJumlah'])->name('cart.tambahJumlah');
    Route::post('/cart/kurang-jumlah', [CartController::class, 'kurangJumlah'])->name('cart.kurangJumlah');
    Route::post('/cart/hapus', [CartController::class, 'hapus'])->name('cart.hapus');
    Route::post('/cart/kosongkan', [CartController::class, 'kosongkan'])->name('cart.kosongkan');

    // Checkout & Riwayat Pesanan
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id_order}', [OrderController::class, 'show'])->name('orders.show');
});

// role management (Admin)
Route::patch('/admin/users/{user}/role',
    [RoleController::class, 'update'])
    ->middleware(['auth', 'can:manage-roles'])
    ->name('admin.users.role.update');

Route::get('/admin/users', [RoleController::class, 'index'])
    ->middleware(['auth', 'can:manage-roles'])
    ->name('admin.users.index');