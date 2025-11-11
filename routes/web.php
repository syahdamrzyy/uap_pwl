<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

// === AUTHENTICATION ===
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// === EMAIL VERIFICATION (Custom) ===

Route::get('/verify/{token}', [AuthController::class, 'verifyUser']);

// === HOME (Contoh setelah login berhasil) ===
Route::get('/home', function () {
    return view('home'); // nanti bisa kamu ubah ke dashboard admin/user
})->middleware('auth');

Route::get('/auth', function () {
    return view('auth.auth');
});
