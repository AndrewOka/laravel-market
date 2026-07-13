<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

// ==========================================
// GUEST ROUTES (Hanya bisa diakses jika BELUM login)
// ==========================================
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// ==========================================
// PROTECTED ROUTES (Hanya bisa diakses jika SUDAH login)
// ==========================================
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');

    // CRUD Otomatis untuk Kategori dan Barang
    Route::resource('categories', CategoryController::class);
    Route::resource('items', ItemController::class);
    
    // Halaman utama setelah login diarahkan ke daftar barang
    Route::get('/', function () {
        return redirect()->route('items.index');
    });
});