<?php

use App\Http\Controllers\admin\BerandaAdminController;
use App\Http\Controllers\admin\KegiatanController;
use App\Http\Controllers\admin\KendaraanController;
use App\Http\Controllers\admin\PemeriksaanKendaraanController;
use App\Http\Controllers\admin\PeralatanController;
use App\Http\Controllers\admin\PetugasController;
use App\Http\Controllers\petugas\BerandaPetugasController;
use App\Http\Controllers\petugas\PemriksaanController;
use App\Http\Controllers\petugas\PemriksaanKendaraanController;
use App\Http\Controllers\pimpinan\BerandaPimpinanController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login_sneat');
});

Auth::routes();

Route::prefix('admin')->middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('beranda', [BerandaAdminController::class, 'index'])->name('admin.beranda');
    Route::resource('petugas', PetugasController::class);
    Route::resource('kendaraan', KendaraanController::class);
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('peralatan', PeralatanController::class);
    Route::resource('pemeriksaan-kendaraan', PemeriksaanKendaraanController::class);
});

Route::prefix('pimpinan')->middleware(['auth', 'auth.pimpinan'])->group(function () {
    Route::get('beranda', [BerandaPimpinanController::class, 'index'])->name('pimpinan.beranda');
});

Route::prefix('petugas')->middleware(['auth', 'auth.petugas'])->group(function () {
    Route::get('beranda', [BerandaPetugasController::class, 'index'])->name('petugas.beranda');
    Route::resource('pemeriksaan', PemriksaanKendaraanController::class);
});

Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
