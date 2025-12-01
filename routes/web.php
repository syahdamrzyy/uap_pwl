<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\BarangController;

// === HALAMAN UTAMA ===
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/fitur', function () {
    return view('fitur');
})->name('fitur');

Route::get('/tentang', function () {
    return view('tentang');
})->name('tentang');

// === AUTHENTICATION ===
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// === DASHBOARD USER ===
Route::get('/home', function () {
    $barangs = \App\Models\Barang::take(5)->get();
    $total_barang_tersedia = \App\Models\Barang::where('stok', '>', 0)->count();
    $sedang_dipinjam = 0; // Placeholder, akan diupdate saat ada tabel peminjaman
    $total_dipinjam = 0; // Placeholder, akan diupdate saat ada tabel peminjaman
    return view('users.dashboard-user', compact('barangs', 'total_barang_tersedia', 'sedang_dipinjam', 'total_dipinjam'));
})->middleware('auth')->name('dashboard.user');


// === HALAMAN AUTH (opsional jika ada halaman gabungan login-register) ===
Route::get('/auth', function () {
    return view('auth.auth');
})->name('auth');

// === HALAMAN ADMIN ===
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard-admin');
})->middleware(['auth', 'admin'])->name('dashboard.admin');

Route::get('/verify/{token}', [AuthController::class, 'verifyUser'])->name('verify.user');

Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {

    Route::get('/barang', [BarangController::class, 'index'])->name('admin.barang.index');
    Route::get('/barang/create', [BarangController::class, 'create'])->name('admin.barang.create');
    Route::post('/barang/store', [BarangController::class, 'store'])->name('admin.barang.store');

    Route::get('/barang/{id}/edit', [BarangController::class, 'edit'])->name('admin.barang.edit');
    Route::put('/barang/{id}', [BarangController::class, 'update'])->name('admin.barang.update');

    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('admin.barang.delete');

});
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('barang', \App\Http\Controllers\Admin\BarangController::class);
});

