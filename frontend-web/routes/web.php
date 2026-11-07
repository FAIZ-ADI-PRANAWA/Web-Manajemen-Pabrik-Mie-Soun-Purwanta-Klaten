<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduksiWebController;
use App\Http\Controllers\AuthController;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('api.auth')->group(function () {
    Route::get('/', [App\Http\Controllers\DashboardWebController::class, 'index'])->name('dashboard');

    Route::resource('produksi', ProduksiWebController::class)->only(['index', 'create', 'store']);
    
    Route::get('/bahan-baku', [App\Http\Controllers\BahanBakuWebController::class, 'index'])->name('bahan-baku.index');
    Route::post('/bahan-baku', [App\Http\Controllers\BahanBakuWebController::class, 'store'])->name('bahan-baku.store');
    Route::get('/transaksi', [App\Http\Controllers\TransaksiWebController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi/bahan', [App\Http\Controllers\TransaksiWebController::class, 'storeBahan'])->name('transaksi.bahan.store');
    Route::post('/transaksi/soun', [App\Http\Controllers\TransaksiWebController::class, 'storeSoun'])->name('transaksi.soun.store');
    
    Route::get('/harga-jual', [App\Http\Controllers\HargaJualWebController::class, 'index'])->name('harga-jual.index');
    Route::post('/harga-jual', [App\Http\Controllers\HargaJualWebController::class, 'update'])->name('harga-jual.update');
    
    Route::get('/laporan', [App\Http\Controllers\LaporanWebController::class, 'index'])->name('laporan.index');
});
