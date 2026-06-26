<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\publik\PageController;
use App\Http\Controllers\publik\KontakController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Import Controller untuk masing-masing Dashboard & Fitur Admin
use App\Http\Controllers\Administrator\AdminController; 
use App\Http\Controllers\Administrator\AdminDashboardController;
use App\Http\Controllers\Administrator\UserController; 
use App\Http\Controllers\Administrator\VerifikasiController;
use App\Http\Controllers\Administrator\TransaksiController; 
use App\Http\Controllers\Administrator\KategoriController;
use App\Http\Controllers\Administrator\LaporanController;
use App\Http\Controllers\Administrator\LogController;
use App\Http\Controllers\Administrator\KontakMasukController;
use App\Http\Controllers\Administrator\ListingLimbahController;// 👈 Controller baru lu berhasil di-import
use App\Http\Controllers\MitraController; 
use App\Http\Controllers\PengelolaController; 

/*
|--------------------------------------------------------------------------
| Web Routes — SambungPangan
|--------------------------------------------------------------------------
*/

// ==========================================
// Public Pages (Bisa diakses tanpa login)
// ==========================================
Route::get('/', [PageController::class, 'beranda'])->name('beranda');
Route::get('/tentang', [PageController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [KontakController::class, 'kirim'])->name('kontak.kirim');

// ==========================================
// Auth Routes (Manajemen Akun)
// ==========================================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ==========================================
// Protected Routes (Harus Login Terlebih Dahulu)
// ==========================================
Route::middleware('auth')->group(function () {

    // 1. Dashboard Default / Fallback jika role tidak spesifik
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // ==========================================
    // 2. Route Group Khusus - Administrator
    // ==========================================
    Route::group([
        'prefix' => 'admin',
        'as' => 'admin.',
        'middleware' => function ($request, $next) {
            if (auth()->user()->role !== 'administrator') {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        }
    ], function () {
        // Dashboard menggunakan AdminDashboardController
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        
        // Manajemen User menggunakan UserController
        Route::get('/users', [UserController::class, 'index'])->name('users');
        
        // 🚀 MANAJEMEN VERIFIKASI MITRA (Sesuai Alur image_437c49.png & image_4300a6.png)
        Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('verifikasi');
        Route::get('/verifikasi/{id}', [VerifikasiController::class, 'show'])->name('verifikasi.show'); // 👈 Halaman Detail
        Route::post('/verifikasi/{id}/proses', [VerifikasiController::class, 'proses'])->name('verifikasi.proses'); // 👈 Proses Setuju/Tolak
        
        // Route operasional sisa lainnya tetap menggunakan AdminController bawaanmu
        Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi');
        Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('transaksi.show');
        Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
        Route::get('/kategori/tambah', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::get('/log', [LogController::class, 'index'])->name('log');
        Route::get('/kontak-masuk', [KontakMasukController::class, 'index'])->name('kontak-masuk');
        Route::get('/listing-limbah', [ListingLimbahController::class, 'index'])->name('listing');
    });

    // ==========================================
    // 3. Route Group Khusus - Restoran
    // ==========================================
    Route::group([
        'prefix' => 'restoran',
        'as' => 'mitra.',
        'middleware' => function ($request, $next) {
            if (auth()->user()->role !== 'restoran') {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        }
    ], function () {
        Route::get('/dashboard', [MitraController::class, 'dashboard'])->name('dashboard');
    });

    // ==========================================
    // 4. Route Group Khusus - Pengelola Pangan
    // ==========================================
    Route::group([
        'prefix' => 'pengelola-pangan',
        'as' => 'pengelola.',
        'middleware' => function ($request, $next) {
            if (auth()->user()->role !== 'pengelola_pangan') {
                abort(403, 'Unauthorized action.');
            }
            return $next($request);
        }
    ], function () {
        Route::get('/dashboard', [PengelolaController::class, 'dashboard'])->name('dashboard');
    });

});
Route::delete('transaksi/{id}', [TransaksiController::class, 'destroy'])->name('admin.transaksi.destroy');