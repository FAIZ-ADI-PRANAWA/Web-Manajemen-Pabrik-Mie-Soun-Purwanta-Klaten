<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProduksiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BahanBakuController;
use App\Http\Controllers\Api\TransaksiController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\LaporanController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::prefix('v1')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index']);
        
        Route::apiResource('bahan-baku', BahanBakuController::class);
        Route::apiResource('produksi', ProduksiController::class);
        
        Route::post('transaksi/bahan-baku', [TransaksiController::class, 'storeBahanBaku']);
        Route::post('transaksi/soun', [TransaksiController::class, 'storeSoun']);
        
        Route::get('laporan/harian', [LaporanController::class, 'harian']);
        
        Route::get('harga-jual', [\App\Http\Controllers\Api\HargaJualController::class, 'index']);
        Route::post('harga-jual/update', [\App\Http\Controllers\Api\HargaJualController::class, 'update']);
    });
});
