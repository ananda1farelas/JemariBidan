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
use App\Http\Controllers\Admin\AdminArtikelController;
use App\Http\Controllers\Admin\AdminProdukController;
use App\Http\Controllers\Admin\AdminTransaksiController;
use App\Http\Controllers\Admin\AdminPenggunaController;


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

    // ─── NOTIFIKASI ───
    Route::get('/notifikasi', [App\Http\Controllers\User\NotifikasiController::class, 'index'])->name('user.notifikasi');
    Route::post('/notifikasi/baca/{id}', [App\Http\Controllers\User\NotifikasiController::class, 'baca'])->name('user.notifikasi.baca');
    Route::post('/notifikasi/baca-semua', [App\Http\Controllers\User\NotifikasiController::class, 'bacaSemua'])->name('user.notifikasi.baca-semua');

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
    
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Kelola Artikel
    Route::get('/artikel', [AdminArtikelController::class, 'index'])->name('artikel');
    Route::get('/artikel/create', [AdminArtikelController::class, 'create'])->name('artikel.create');
    Route::post('/artikel', [AdminArtikelController::class, 'store'])->name('artikel.store');
    Route::get('/artikel/{id}/edit', [AdminArtikelController::class, 'edit'])->name('artikel.edit');
    Route::put('/artikel/{id}', [AdminArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('/artikel/{id}', [AdminArtikelController::class, 'destroy'])->name('artikel.destroy');
    
    // Kelola Produk
    Route::get('/produk', [AdminProdukController::class, 'index'])->name('produk');
    
    // Kelola Produk - Kategori
    Route::get('/produk/kategori', [AdminProdukController::class, 'kategoriIndex'])->name('produk.kategori');
    Route::get('/produk/kategori/create', [AdminProdukController::class, 'kategoriCreate'])->name('produk.kategori.create');
    Route::post('/produk/kategori', [AdminProdukController::class, 'kategoriStore'])->name('produk.kategori.store');
    Route::get('/produk/kategori/{id}/edit', [AdminProdukController::class, 'kategoriEdit'])->name('produk.kategori.edit');
    Route::put('/produk/kategori/{id}', [AdminProdukController::class, 'kategoriUpdate'])->name('produk.kategori.update');
    Route::delete('/produk/kategori/{id}', [AdminProdukController::class, 'kategoriDestroy'])->name('produk.kategori.destroy');

    // Kelola Produk - Paket
    Route::get('/produk/paket', [AdminProdukController::class, 'paketIndex'])->name('produk.paket');
    Route::get('/produk/paket/create', [AdminProdukController::class, 'paketCreate'])->name('produk.paket.create');
    Route::post('/produk/paket', [AdminProdukController::class, 'paketStore'])->name('produk.paket.store');
    Route::get('/produk/paket/{id}/edit', [AdminProdukController::class, 'paketEdit'])->name('produk.paket.edit');
    Route::put('/produk/paket/{id}', [AdminProdukController::class, 'paketUpdate'])->name('produk.paket.update');
    Route::delete('/produk/paket/{id}', [AdminProdukController::class, 'paketDestroy'])->name('produk.paket.destroy');
    
    // ====== KELOLA TRANSAKSI ======
    Route::get('/transaksi', [AdminTransaksiController::class, 'index'])->name('transaksi');
    Route::get('/transaksi/{id}', [AdminTransaksiController::class, 'show'])->name('transaksi.show');
    Route::get('/transaksi/{id}/edit', [AdminTransaksiController::class, 'edit'])->name('transaksi.edit');
    Route::put('/transaksi/{id}', [AdminTransaksiController::class, 'update'])->name('transaksi.update');
    Route::delete('/transaksi/{id}', [AdminTransaksiController::class, 'destroy'])->name('transaksi.destroy');
    
    // ====== KELOLA PENGGUNA ======
    Route::get('/pengguna', [AdminPenggunaController::class, 'index'])->name('pengguna');
    Route::get('/pengguna/create', [AdminPenggunaController::class, 'create'])->name('pengguna.create');
    Route::post('/pengguna', [AdminPenggunaController::class, 'store'])->name('pengguna.store');
    Route::get('/pengguna/{id}', [AdminPenggunaController::class, 'show'])->name('pengguna.show');
    Route::get('/pengguna/{id}/edit', [AdminPenggunaController::class, 'edit'])->name('pengguna.edit');
    Route::put('/pengguna/{id}', [AdminPenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('/pengguna/{id}', [AdminPenggunaController::class, 'destroy'])->name('pengguna.destroy');
    
});