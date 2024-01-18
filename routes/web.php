<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registerSimpan'])->name('register.simpan');
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'loginAksi'])->name('login.aksi');
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/dashboard', [BarangController::class, 'dashboard'])->name('dashboard');

    Route::prefix('barang')->group(function () {
        Route::get('index', [BarangController::class, 'index'])->name('barang.index');
        Route::get('tambah', [BarangController::class, 'tambah'])->name('barang.tambah');
        Route::post('tambah', [BarangController::class, 'simpan'])->name('barang.tambah.simpan');
        Route::get('edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
        Route::put('update/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::get('hapus/{id}', [BarangController::class, 'hapus'])->name('barang.hapus');
        Route::get('/barang/{id}', [BarangController::class, 'detail'])->name('barang.detail');
    });

    Route::prefix('kategori')->group(function () {
        Route::get('index', [KategoriController::class, 'index'])->name('kategori.index');
        Route::get('tambah', [KategoriController::class, 'tambah'])->name('kategori.tambah');
        Route::post('tambah', [KategoriController::class, 'simpan'])->name('kategori.tambah.simpan');
        Route::get('edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::post('edit/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::get('hapus/{id}', [KategoriController::class, 'hapus'])->name('kategori.hapus');
    });


        Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
        Route::post('/transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
        Route::get('/transaksi/create', [TransaksiController::class, 'create'])->name('transaksi.create');


});
