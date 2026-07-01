<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PenjualanController;
use App\Http\Controllers\Api\PembelianController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);

Route::get('/penjualan', [PenjualanController::class, 'index']);
Route::post('/penjualan', [PenjualanController::class, 'store']);

Route::get('/pembelian', [PembelianController::class, 'index']);
Route::post('/pembelian', [PembelianController::class, 'store']);