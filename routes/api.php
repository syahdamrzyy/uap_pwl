<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\BarangApiController;
use App\Http\Controllers\API\PeminjamanApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/barang', [BarangApiController::class, 'index']);
Route::get('/barang/{id}', [BarangApiController::class, 'show']);

Route::get('/peminjaman', [PeminjamanApiController::class, 'index']);
Route::get('/peminjaman/user/{id}', [PeminjamanApiController::class, 'byUser']);
Route::get('/peminjaman-filter', [PeminjamanApiController::class, 'filter']);