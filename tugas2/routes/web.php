<?php

use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

Route::get('/tugas2/index', [KeranjangController::class, 'index'])
    ->name('tugas2.index');

Route::get('/tugas2/keranjang', [KeranjangController::class, 'keranjang'])
    ->name('keranjang');

Route::post('/tugas2/keranjang/tambah/{id}', [KeranjangController::class, 'tambah'])
    ->name('keranjang.tambah');

Route::post('/tugas2/keranjang/tambah-jumlah/{id}', [KeranjangController::class, 'tambahJumlah'])
    ->name('keranjang.tambahJumlah');

Route::post('/tugas2/keranjang/kurang-jumlah/{id}', [KeranjangController::class, 'kurangJumlah'])
    ->name('keranjang.kurangJumlah');

Route::post('/tugas2/keranjang/hapus/{id}', [KeranjangController::class, 'hapus'])
    ->name('keranjang.hapus');

Route::post('/tugas2/keranjang/kosongkan', [KeranjangController::class, 'kosongkan'])
    ->name('keranjang.kosongkan');
