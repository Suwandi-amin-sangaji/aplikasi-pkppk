<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HasilPeralatan;
use App\Models\PemeriksaanPeralatan;
use App\Models\Peralatan;
use Illuminate\Http\Request;

class PemeriksaanPeralatanController extends Controller
{

    private $viewIndex = 'pemeriksaan.pemeriksaanPeralatan_index';
    private $viewCreate = 'pemeriksaan.pemeriksaanPeralatan_form';
    // private $viewedit = 'pemeriksaan.PeralatanPeralatan_form';
    private $viewShow = 'pemeriksaan.pemeriksaanPeralatan_show';
    private $routePrefix = 'pemeriksaan';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemeriksaan = PemeriksaanPeralatan::with('peralatan')
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
        // Mengambil data pemeriksaan peralatan berdasarkan ID
        // $model = PemeriksaanPeralatan::findOrFail($id);
        $model = PemeriksaanPeralatan::with('compartment', 'peralatan')->find($id);
        //ngambil hasil pemeriksaan peralatan terkait
        $hasilPeralatan = $model->hasilPeralatan()->get()->keyBy('id_peralatan');
        // Mengambil detail peralatan yang diperiksa
        $peralatan = Peralatan::with('compartment')->get()->groupBy('compartment.name');
        return view('admin.' . $this->viewShow, [
            'title' => 'Detail Pemeriksaan Peralatan',
            'model' => $model,
            'hasilPeralatan' => $hasilPeralatan,
            'peralatan' => $peralatan,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
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
        // Menghapus data pemeriksaan peralatan
        $model = PemeriksaanPeralatan::findOrFail($id);
        $model->delete();
        // Menghapus data hasil peralatan yang terkait
        HasilPeralatan::where('id_pemeriksaan', $id)->delete();
        flash()->addSuccess('Data Perlatan Berhasil Dihapus');
        return back();
    }
}
