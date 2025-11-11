<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// === HALAMAN UTAMA ===
Route::get('/', function () {
    return view('welcome');
<<<<<<< HEAD
})->name('welcome'); // ← WAJIB ADA INI
=======
})->name('welcome'); //
>>>>>>> 1780a40 (Penyesuian dengan desain)

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
    return view('users.dashboard-user');
})->middleware('auth')->name('dashboard.user');
