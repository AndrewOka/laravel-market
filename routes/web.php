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

    // ------------------------------------------------------------------
    // ROUTE TAMBAHAN UNTUK KOTAK SAMPAH KATEGORI (Wajib di atas resource categories)
    // ------------------------------------------------------------------
    Route::get('categories/trash', [CategoryController::class, 'trash'])->name('categories.trash');
    Route::post('categories/{id}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{id}/force-delete', [CategoryController::class, 'forceDelete'])->name('categories.force-delete');

    // CRUD Otomatis untuk Kategori
    Route::resource('categories', CategoryController::class);

    // ROUTE TAMBAHAN UNTUK KOTAK SAMPAH BARANG (Wajib di atas resource items)
    Route::get('items/trash', [ItemController::class, 'trash'])->name('items.trash');
    Route::post('items/{id}/restore', [ItemController::class, 'restore'])->name('items.restore');
    Route::delete('items/{id}/force-delete', [ItemController::class, 'forceDelete'])->name('items.force-delete');

    // CRUD Otomatis untuk Barang
    Route::resource('items', ItemController::class);
    
    // Halaman utama setelah login diarahkan ke daftar barang
    Route::get('/', function () {
        return redirect()->route('items.index');
    });
});