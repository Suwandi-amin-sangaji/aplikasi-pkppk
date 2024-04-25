<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Kendaraan;
use App\Models\PemeriksaanKendaraan;
use Illuminate\Http\Request;

class PemeriksaanKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $viewIndex = 'pemeriksaan.pemeriksaanKendaraan_index';
    private $viewCreate = 'pemeriksaan.pemeriksaanKendaraan_form';
    // private $viewedit = 'pemeriksaan.kendaraanKendaraan_form';
    private $viewShow = 'pemeriksaan.pemeriksaanKendaraan_show';
    private $routePrefix = 'pemeriksaan';
    public function index()
    {
        $pemeriksaan = PemeriksaanKendaraan::with('kendaraan')
            ->latest()
            ->paginate(10);
        return view('admin.' . $this->viewIndex, [
            'pemeriksaan' => $pemeriksaan,
            'routePrefix' => $this->routePrefix,
            'title' => 'Pemeriksaan kendaraan Oleh Putugas'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = PemeriksaanKendaraan::with(['baSet1', 'baSet2'])->findOrFail($id);
        $kendaraan = Kendaraan::pluck('jenis', 'id');
        $hasilPemeriksaan = $model->hasilPemeriksaan()->get()->keyBy('id_kegiatan');

        return view('admin.' . $this->viewShow, [
            'title' => 'Detail Pemeriksaan Kendaraan',
            'model' => $model,
            'kendaraan' => $kendaraan,
            'hasilPemeriksaan' => $hasilPemeriksaan,
            'kegiatan' => Kegiatan::all(),
            'baSet1' => $model->baSet1,
            'baSet2' => $model->baSet2,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
