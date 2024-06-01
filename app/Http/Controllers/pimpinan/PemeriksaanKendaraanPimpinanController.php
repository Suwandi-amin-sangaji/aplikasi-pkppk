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
        // Fetch the PemeriksaanKendaraan model with related data
        $model = PemeriksaanKendaraan::with(['baSet1', 'baSet2'])->findOrFail($id);

        // Get the jenis kendaraan
        $kendaraan = Kendaraan::pluck('jenis', 'id');

        // Fetch the related hasilPemeriksaan records keyed by id_kegiatan
        $hasilPemeriksaan = $model->hasilPemeriksaan()->get()->keyBy('id_kegiatan');

        // Fetch kegiatan related to the specific kendaraan type
        $kegiatan = Kegiatan::where('id_kendaraan', $model->id_kendaraan)->get();

        return view('pimpinan.' . $this->viewShow, [
            'title' => 'Detail Pemeriksaan Kendaraan',
            'model' => $model,
            'kendaraan' => $kendaraan,
            'hasilPemeriksaan' => $hasilPemeriksaan,
            'kegiatan' => $kegiatan,
            'baSet1' => $model->baSet1,
            'baSet2' => $model->baSet2,
        ]);
    }

    public function sign(Request $request, $id)
    {
        $request->validate([
            'signature' => 'required|mimes:jpg,jpeg,png|max:5048',
        ]);

        $pemeriksaan = PemeriksaanKendaraan::with('kendaraan')->findOrFail($id);

        if ($request->hasFile('signature')) {
            $signaturePath = $request->file('signature')->store('signatures', 'public');
            $pemeriksaan->signature = $signaturePath;
            $pemeriksaan->status = 'ditandatangani';
            $pemeriksaan->save();
        }

        return redirect()->route('pemeriksaan-kendaraan-pimpinan.index')->with('success', 'Tanda tangan berhasil disimpan.');
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
