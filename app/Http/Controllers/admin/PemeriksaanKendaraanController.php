<?php

namespace App\Http\Controllers\admin;

use App\Models\Kegiatan;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PemeriksaanKendaraan;

class PemeriksaanKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $viewIndex = 'pemeriksaan.pemeriksaanKendaraan_index';
    private $viewCreate = 'pemeriksaan.pemeriksaanKendaraan_form';
    private $viewedit = 'pemeriksaan.pemeriksaanKendaraan_form';
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

        return view('admin.' . $this->viewedit, [
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
        $model = PemeriksaanKendaraan::findOrFail($id);
        if ($model->status == 'Verifikasi') {
            flash()->addWarning('Data Tidak Dapat Dihapus Jika Sudah Di verifikasi Oleh Pimpinan');
            return back();
        }
        $model->delete();
        flash()->addSuccess('Data Perlatan Berhasil Dihapus');
        return back();
    }

    public function verifikasi($id)
    {
        $pemeriksaan = PemeriksaanKendaraan::with('kendaraan')->findOrFail($id);
        $pemeriksaan->status = 'Verifikasi';
        $pemeriksaan->save();
        // Redirect dengan pesan sukses
        return redirect()->route('pemeriksaan-kendaraan-admin.index')->with('success', 'Data berhasil diverifikasi');
    }


    // public function generatePDF()
    // {
    //     $data = ['title' => 'domPDF Sample', 'date' => date('m/d/Y')];
    //     $pdf = Pdf::loadView('admin.laporan.pdf.document', $data)->setOptions(['defaultFont' => 'sans-serif']);
    //     return $pdf->download('document.pdf');
    // }
}
