<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\Admin\BarangController as AdminBarangController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;

/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/fitur', function () {
    return view('fitur');
})->name('fitur');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


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

Route::get('/peminjaman/create/{id}', [PeminjamanController::class, 'create'])
    ->middleware('auth')
    ->name('peminjaman.create');

Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])
    ->middleware('auth')
    ->name('peminjaman.store');


/*
|--------------------------------------------------------------------------
| HALAMAN AUTH OPSIONAL
|--------------------------------------------------------------------------
*/

Route::get('/auth', function () {
    return view('auth.auth');
})->name('auth');


/*
|--------------------------------------------------------------------------
| HALAMAN ADMIN
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Tambahan: akses /admin langsung ke dashboard
        Route::get('/', function () {
            return redirect()->route('admin.dashboard');
        })->name('home');

        // Dashboard admin
        Route::get('/dashboard', function () {
            return view('admin.dashboard-admin');
        })->name('dashboard');

        // CRUD barang admin (resource)
        Route::resource('barang', AdminBarangController::class);

        // Daftar permintaan peminjaman (halaman admin)
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])
            ->name('peminjaman.index');

        // Aksi Admin: Setujui / Tolak
        Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])
            ->name('peminjaman.approve');

        Route::post('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])
            ->name('peminjaman.reject');

        Route::get('/manajemen-admin', [\App\Http\Controllers\Admin\AdminController::class, 'manajemenAdmin'])
            ->name('manajemen.admin');
    });


/*
|--------------------------------------------------------------------------
| VERIFIKASI EMAIL
|--------------------------------------------------------------------------
*/

Route::get('/verify/{token}', [AuthController::class, 'verifyUser'])
    ->name('verify.user');
