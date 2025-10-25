<?php

use App\Http\Controllers\BarangController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BarangController::class, 'index']);
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::DELETE('/destroy/{id} ', [BarangController::class, 'destroy'])->name('barang.destroy');
Route::PUT('/update/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::resource('barang', BarangController::class);