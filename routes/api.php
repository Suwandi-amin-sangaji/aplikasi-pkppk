<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PemeriksaanController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // Menambahkan prefix 'api' ke grup rute di bawah
    Route::prefix('kendaraan')->group(function () {
        Route::get('/pemeriksaan-kendaraan', [PemeriksaanController::class, 'pemriksaanKendaraan']);
        Route::post('/add-pemeriksaan-kendaraan', [PemeriksaanController::class, 'addPemeriksaanKendaraan']);

        Route::get('/pemeriksaan-peralatan', [PemeriksaanController::class, 'pemriksaanPeralatan']);
        Route::post('/add-pemeriksaan-peralatan', [PemeriksaanController::class, 'addPemeriksaanPeralatan']);
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
