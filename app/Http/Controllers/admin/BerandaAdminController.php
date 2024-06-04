<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\PemeriksaanKendaraan;
use App\Models\PemeriksaanPeralatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaAdminController extends Controller
{
    public function index()
    {
        // Jumlah User
        $jmlKendaraan = Kendaraan::count();
        $jmlPemeriksaanKendaraan = PemeriksaanKendaraan::count();
        $jmlPemeriksaanPeralatan = PemeriksaanPeralatan::count();

        return view("admin.beranda_index", compact('jmlPemeriksaanKendaraan', 'jmlPemeriksaanPeralatan', 'jmlKendaraan'));
    }
}
