<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\PetugasController;
use App\Http\Controllers\admin\KegiatanController;
use App\Http\Controllers\admin\KendaraanController;
use App\Http\Controllers\admin\PeralatanController;
use App\Http\Controllers\admin\BerandaAdminController;
use App\Http\Controllers\petugas\BerandaPetugasController;
use App\Http\Controllers\pimpinan\BerandaPimpinanController;
use App\Http\Controllers\admin\PemeriksaanKendaraanController;
use App\Http\Controllers\petugas\PemriksaanKendaraanController;
use App\Http\Controllers\petugas\PemeriksaanPeralatanController;
use App\Http\Controllers\pimpinan\PemeriksaanKendaraanPimpinanController;
use App\Http\Controllers\pimpinan\PemeriksaanPeralatanPimpinanController;
use App\Http\Controllers\admin\PemeriksaanPeralatanController as AdminPemeriksaanPeralatanController;
use App\Http\Controllers\admin\SopController;

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


// Admin
Route::prefix('admin')->middleware(['auth', 'auth.admin'])->group(function () {
    Route::get('beranda', [BerandaAdminController::class, 'index'])->name('admin.beranda');
    Route::resource('petugas', PetugasController::class);
    Route::resource('kendaraan', KendaraanController::class);
    Route::resource('kegiatan', KegiatanController::class);
    Route::resource('peralatan', PeralatanController::class);
    Route::resource('pemeriksaan-kendaraan-admin', PemeriksaanKendaraanController::class);
    Route::resource('pemeriksaan-peralatan-admin', AdminPemeriksaanPeralatanController::class);
    Route::post('pemeriksaan-kendaraan-admin/verifikasi/{id}', [PemeriksaanKendaraanController::class, 'verifikasi'])->name('pemeriksaan-kendaraan-admin.verifikasi');
    Route::get('generate-pdf', [PemeriksaanKendaraanController::class, 'generatePDF']);
    Route::resource('sop', SopController::class);

});

// Pimpinan
Route::prefix('pimpinan')->middleware(['auth', 'auth.pimpinan'])->group(function () {
    Route::get('beranda', [BerandaPimpinanController::class, 'index'])->name('pimpinan.beranda');
    Route::resource('pemeriksaan-kendaraan-pimpinan', PemeriksaanKendaraanPimpinanController::class);
    Route::resource('pemeriksaan-peralatan-pimpinan', PemeriksaanPeralatanPimpinanController::class);
    Route::post('pemeriksaan-kendaraan-pimpinan/verifikasi/{id}', [PemeriksaanKendaraanPimpinanController::class, 'verifikasi'])->name('pemeriksaan-kendaraan-pimpinan.verifikasi');
});

// Petugas
Route::prefix('petugas')->middleware(['auth', 'auth.petugas'])->group(function () {
    Route::get('beranda', [BerandaPetugasController::class, 'index'])->name('petugas.beranda');
    Route::resource('pemeriksaan-kendaraan', PemriksaanKendaraanController::class);
    Route::get('pemeriksaan-kendaraan/scan/{id_kendaraan}', [PemriksaanKendaraanController::class, 'scanKegiatanByKendaraan'])->name('pemeriksaan.scanKegiatanByKendaraan');
    Route::get('pemeriksaan-kendaraan/create/{id_kendaraan}', [PemriksaanKendaraanController::class, 'getKegiatanByKendaraan']);


    Route::resource('pemeriksaan-peralatan', PemeriksaanPeralatanController::class);
    // Route::get('pemeriksaan-kendaraan/create/{id_user}', [PemriksaanKendaraanController::class, 'create'])->name('pemeriksaan-kendaraan.create');
    Route::get('/cetak-laporan-petugas/{id}', [PemriksaanKendaraanController::class, 'cetakLaporanPetugas'])->name('cetak-laporan-petugas.cetak');

    // Route::get('pemeriksaan-kendaraan/create/{id_kendaraan}', [PemriksaanKendaraanController::class, 'create'])->name('pemeriksaan.create');


});

Route::get('logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');
