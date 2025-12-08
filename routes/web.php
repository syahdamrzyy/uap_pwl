<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\Admin\BarangController as AdminBarangController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboardController;

/*
|--------------------------------------------------------------------------
| HALAMAN UMUM (HANYA UNTUK GUEST / BELUM LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware(['guest'])->group(function () {

    Route::view('/', 'welcome')->name('welcome');
    Route::view('/fitur', 'fitur')->name('fitur');
    Route::view('/tentang', 'tentang')->name('tentang');

    // AUTH GUEST
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

/*
|--------------------------------------------------------------------------
| LOGOUT (HANYA UNTUK YANG SUDAH LOGIN)
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| DASHBOARD USER
|--------------------------------------------------------------------------
*/

Route::get('/home', [UserDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard.user');

/*
|--------------------------------------------------------------------------
| BARANG USER
|--------------------------------------------------------------------------
*/

Route::get('/barang', [BarangController::class, 'index'])
    ->middleware('auth')
    ->name('barang.index');

/*
|--------------------------------------------------------------------------
| PEMINJAMAN USER
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/peminjaman/create/{id}', [PeminjamanController::class, 'create'])
        ->name('peminjaman.create');

    Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])
        ->name('peminjaman.store');

    Route::post('/peminjaman/{id}/kembalikan', [PeminjamanController::class, 'kembalikan'])
        ->name('peminjaman.kembalikan');
});

/*
|--------------------------------------------------------------------------
| ADMIN AREA (AUTO REDIRECT & AMAN ✅)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Redirect /admin → dashboard
        Route::get('/', fn () => redirect()->route('admin.dashboard'))
            ->name('home');

        // Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // CRUD Barang Admin
        Route::resource('barang', AdminBarangController::class);

        // Manajemen Peminjaman
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])
            ->name('peminjaman.index');

        Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])
            ->name('peminjaman.approve');

        Route::post('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])
            ->name('peminjaman.reject');

        Route::get('/peminjaman/dikembalikan', [PeminjamanController::class, 'dikembalikanAdmin'])
            ->name('peminjaman.dikembalikan');

        // Manajemen Admin
        Route::get('/manajemen-admin', [AdminController::class, 'manajemenAdmin'])
            ->name('manajemen.admin');
    });

/*
|--------------------------------------------------------------------------
| VERIFIKASI EMAIL
|--------------------------------------------------------------------------
*/

Route::get('/verify/{token}', [AuthController::class, 'verifyUser'])
    ->name('verify.user');
