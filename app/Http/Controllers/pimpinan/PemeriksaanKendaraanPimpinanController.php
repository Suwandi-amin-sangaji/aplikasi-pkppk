<?php

namespace App\Http\Controllers\pimpinan;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Kendaraan;
use App\Models\PemeriksaanKendaraan;
use Illuminate\Http\Request;

class PemeriksaanKendaraanPimpinanController extends Controller
{
    private $viewIndex = 'pemeriksaanKendaraan_index';
    private $viewCreate = 'pemeriksaanKendaraan_form';
    private $viewedit = 'kendaraanKendaraan_form';
    private $viewShow = 'pemeriksaanKendaraan_show';
    private $routePrefix = 'pimpinan';


    public function index()
    {
        $pemeriksaan = PemeriksaanKendaraan::with('kendaraan')
            ->latest()
            ->paginate(10);
        return view('pimpinan.' . $this->viewIndex, [
            'pemeriksaan' => $pemeriksaan,
            'routePrefix' => $this->routePrefix,
            'title' => 'Pemeriksaan kendaraan Oleh Putugas'
        ]);
    }

    public function show(string $id)
    {
        $model = PemeriksaanKendaraan::with(['baSet1', 'baSet2'])->findOrFail($id);
        $kendaraan = Kendaraan::pluck('jenis', 'id');
        $hasilPemeriksaan = $model->hasilPemeriksaan()->get()->keyBy('id_kegiatan');

        return view('pimpinan.' . $this->viewShow, [
            'title' => 'Detail Pemeriksaan Kendaraan',
            'model' => $model,
            'kendaraan' => $kendaraan,
            'hasilPemeriksaan' => $hasilPemeriksaan,
            'kegiatan' => Kegiatan::all(),
            'baSet1' => $model->baSet1,
            'baSet2' => $model->baSet2,
        ]);
    }


    public function verifikasi($id)
    {
        $pemeriksaan = PemeriksaanKendaraan::with('kendaraan')->findOrFail($id);
        $pemeriksaan->status = 'Verifikasi';
        $pemeriksaan->save();
        // Redirect dengan pesan sukses
        return redirect()->route('pemeriksaan-kendaraan-pimpinan.index')->with('success', 'Data berhasil diverifikasi');
    }
}
