<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;
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
| DASHBOARD USER (HANYA ROLE "user")
|--------------------------------------------------------------------------
*/

Route::get('/home', [UserDashboardController::class, 'index'])
    ->middleware(['auth', 'user'])
    ->name('dashboard.user');

/*
|--------------------------------------------------------------------------
| BARANG USER (HANYA ROLE "user")
|--------------------------------------------------------------------------
*/

Route::get('/barang', [BarangController::class, 'index'])
    ->middleware(['auth', 'user'])
    ->name('barang.index');

/*
|--------------------------------------------------------------------------
| PEMINJAMAN USER (HANYA ROLE "user")
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'user'])->group(function () {

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
        Route::get('/', fn () => redirect()->route('admin.dashboard'))->name('home');

        // Dashboard Admin
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        // CRUD Barang Admin
        Route::resource('barang', AdminBarangController::class);

        // ✅ Manajemen Peminjaman
        Route::get('/peminjaman', [PeminjamanController::class, 'index'])
            ->name('peminjaman.index');

        Route::post('/peminjaman/{id}/approve', [PeminjamanController::class, 'approve'])
            ->name('peminjaman.approve');

        Route::post('/peminjaman/{id}/reject', [PeminjamanController::class, 'reject'])
            ->name('peminjaman.reject');

        Route::get('/peminjaman/dikembalikan', [PeminjamanController::class, 'dikembalikanAdmin'])
            ->name('peminjaman.dikembalikan');

        // ✅ Manajemen Admin
        Route::get('/manajemen-admin', [AdminController::class, 'manajemenAdmin'])
            ->name('manajemen.admin');

        /*
        |--------------------------------------------------------------------------
        | ✅ NOTIF REALTIME + CACHE (AJAX)
        |--------------------------------------------------------------------------
        */

        Route::get('/notif-count', function () {

            $peminjaman = Cache::remember('notif_menunggu', 10, function () {
                return \App\Models\Peminjaman::where('status', 'menunggu')->count();
            });

            $dikembalikan = Cache::remember('notif_dikembalikan', 10, function () {
                return \App\Models\Peminjaman::where('status', 'dikembalikan')->count();
            });

            $dibacaPeminjaman   = session('notif_peminjaman_dibaca', false);
            $dibacaDikembalikan = session('notif_dikembalikan_dibaca', false);

            return response()->json([
                'peminjaman'   => $dibacaPeminjaman ? 0 : $peminjaman,
                'dikembalikan' => $dibacaDikembalikan ? 0 : $dikembalikan,
            ]);
        });

        // ✅ MARK PEMINJAMAN DIBACA
        Route::post('/notif-read/peminjaman', function () {
            session()->put('notif_peminjaman_dibaca', true);
            return response()->json(['success' => true]);
        })->name('notif.read.peminjaman');

        // ✅ MARK DIKEMBALIKAN DIBACA
        Route::post('/notif-read/dikembalikan', function () {
            session()->put('notif_dikembalikan_dibaca', true);
            return response()->json(['success' => true]);
        })->name('notif.read.dikembalikan');
    });

/*
|--------------------------------------------------------------------------
| VERIFIKASI EMAIL
|--------------------------------------------------------------------------
*/

Route::get('/verify/{token}', [AuthController::class, 'verifyUser'])
    ->name('verify.user');
