<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;


Route::get('/', [DashboardController::class, 'home']);


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::resource('produk', ProdukController::class)->middleware(['auth', 'verified']);
Route::resource('transaksi', TransaksiController::class)->middleware(['auth', 'verified']);
Route::resource('cart', CartController::class)->middleware('auth');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
