<?php

use Illuminate\Support\Facades\Route;

// ============================================
// CONTROLLERS
// ============================================
use App\Http\Controllers\LandingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// ─── USER CONTROLLERS ───
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\KatalogController as UserKatalogController;
use App\Http\Controllers\User\KeranjangController as UserKeranjangController;
use App\Http\Controllers\User\CheckoutController;
use App\Http\Controllers\User\HistoryController;
use App\Http\Controllers\User\ArtikelController;

// ─── ADMIN CONTROLLERS ───
use App\Http\Controllers\Admin\AdminDashboardController;


// ============================================
// PUBLIC
// ============================================
Route::get('/', [LandingController::class, 'index'])->name('landing');


// ============================================
// AUTH (Guest only)
// ============================================
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'show'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);
});


// ============================================
// AUTHENTICATED (Semua role yang login)
// ============================================
Route::middleware('auth')->group(function () {
    
    // Logout (bisa diakses semua role)
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


// ============================================
// USER ROUTES (Role: user / customer)
// ============================================
Route::middleware(['auth'])->group(function () {
    
    // ─── DASHBOARD USER ───
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');
    
    // ─── KATALOG PRODUK ───
    Route::get('/katalog', [UserKatalogController::class, 'index'])->name('user.katalog');
    Route::get('/katalog/{slug}', [UserKatalogController::class, 'kategori'])->name('user.katalog.kategori');
    Route::get('/katalog/{kategoriSlug}/{paketSlug}', [UserKatalogController::class, 'detail'])->name('user.katalog.detail');
    
    // KERANJANG (AJAX/Popup)
    Route::post('/keranjang/tambah', [UserKeranjangController::class, 'tambah'])->name('user.keranjang.tambah');
    Route::get('/keranjang/data', [UserKeranjangController::class, 'data'])->name('user.keranjang.data');
    Route::delete('/keranjang/hapus/{index}', [UserKeranjangController::class, 'hapus'])->name('user.keranjang.hapus');
    Route::post('/keranjang/update/{index}', [UserKeranjangController::class, 'update'])->name('user.keranjang.update');

    // === CHECKOUT ===
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('user.checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('user.checkout.store');
        
    // ─── HISTORY TRANSAKSI ───
    Route::get('/history', [HistoryController::class, 'index'])->name('user.history');
    Route::get('/history/{id}', [HistoryController::class, 'show'])->name('user.history.show');
    
    // ─── ARTIKEL KESEHATAN ───
    Route::get('/artikel', [ArtikelController::class, 'index'])->name('user.artikel');
    Route::get('/artikel/{slug}', [ArtikelController::class, 'show'])->name('user.artikel.show');
    
});


// ============================================
// ADMIN ROUTES (Role: admin)
// ============================================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // ─── DASHBOARD ADMIN ───
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Nanti tambahin route admin lainnya di sini:
    // Route::get('/users', [AdminUserController::class, 'index'])->name('users');
    // Route::get('/transaksi', [AdminTransaksiController::class, 'index'])->name('transaksi');
    // Route::get('/produk', [AdminProdukController::class, 'index'])->name('produk');
    
});