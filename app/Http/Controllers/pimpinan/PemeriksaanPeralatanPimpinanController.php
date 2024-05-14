<?php

namespace App\Http\Controllers\pimpinan;

use App\Http\Controllers\Controller;
use App\Models\PemeriksaanPeralatan;
use Illuminate\Http\Request;

class PemeriksaanPeralatanPimpinanController extends Controller
{
    private $viewIndex = 'pemeriksaanPeralatan_index';
    private $viewCreate = 'pemeriksaanPeralatan_form';
    // private $viewedit = 'PeralatanPeralatan_form';
    private $viewShow = 'pemeriksaanPeralatan_show';
    private $routePrefix = 'pimpinan';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemeriksaan = PemeriksaanPeralatan::with('peralatan')
            ->latest()
            ->paginate(10);
        return view('pimpinan.' . $this->viewIndex, [
            'pemeriksaan' => $pemeriksaan,
            'routePrefix' => $this->routePrefix,
            'title' => 'Pemeriksaan kendaraan Oleh Putugas'
        ]);
    }
}
