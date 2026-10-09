<?php

use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

Route::get('/', [KeranjangController::class, 'index'])->name('index');
Route::get('/tugas2/index', [KeranjangController::class, 'index'])->name('index');

Route::post('/tambah', [KeranjangController::class, 'tambah'])->name('tambah');
Route::get('/tugas2/keranjang', [KeranjangController::class, 'keranjang'])->name('keranjang');
Route::post('/tambah-jumlah', [KeranjangController::class, 'tambahJumlah'])->name('tambahJumlah');
Route::post('/kurang-jumlah', [KeranjangController::class, 'kurangJumlah'])->name('kurangJumlah');
Route::post('/hapus', [KeranjangController::class, 'hapus'])->name('hapus');
Route::post('/kosongkan', [KeranjangController::class, 'kosongkan'])->name('kosongkan');