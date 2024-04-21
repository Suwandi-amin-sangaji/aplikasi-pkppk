<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Models\HasilPemeriksaan;
use App\Models\Kegiatan;
use App\Models\Kendaraan;
use App\Models\Komponen;
use App\Models\PemeriksaanKendaraan;
use Illuminate\Http\Request;

class PemriksaanController extends Controller
{
    private $viewIndex = 'kendaraan.pemeriksaan_index';
    private $viewCreate = 'kendaraan.pemeriksaan_form';
    private $viewedit = 'kendaraan.kendaraan_form';
    private $viewShow = 'kendaraan.kendaraan_show';
    private $routePrefix = 'pemeriksaan';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pemeriksaan = PemeriksaanKendaraan::with('kendaraan')->latest()->paginate(5);
        return view('petugas.' . $this->viewIndex, [
            'pemeriksaan' => $pemeriksaan,
            'routePrefix' => $this->routePrefix,
            'title' => 'Pemeriksaan kendaraan'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'model' => new PemeriksaanKendaraan(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'Simpan',
            'title' => 'Kendaraan',
            'kendaraan' => Kendaraan::pluck('jenis'),
            'kegiatan' => Kegiatan::all(), // Menambahkan data kegiatan ke dalam array $data
        ];

        return view('petugas.' . $this->viewCreate, $data);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            // Add your validation rules here
        ]);

        // Find the inspection by its ID
        $pemeriksaan = PemeriksaanKendaraan::find($request->id_pemeriksaan);

        if (!$pemeriksaan) {
            return back()->withErrors(['message' => 'Pemeriksaan tidak ditemukan']);
        }

        // Iterate through each inspection to get its ID
        foreach ($pemeriksaan as $item) {
            $pemeriksaanId = $item->id;
        }

        // Find the activity by its ID
        $kegiatan = Kegiatan::find($request->id_kegiatan);

        if (!$kegiatan) {
            return back()->withErrors(['message' => 'Kegiatan tidak ditemukan']);
        }

        // Create a new instance of HasilPemeriksaan
        $hasilPemeriksaan = new HasilPemeriksaan();
        $hasilPemeriksaan->nama_operator = $pemeriksaan->nama_operator;
        $hasilPemeriksaan->nama_asisten = $pemeriksaan->nama_asisten;
        $hasilPemeriksaan->waktu = $pemeriksaan->waktu;
        $hasilPemeriksaan->tanggal = $pemeriksaan->tanggal;
        $hasilPemeriksaan->id_pemeriksaan = $pemeriksaanId;
        $hasilPemeriksaan->id_kegiatan = $kegiatan->id;
        $hasilPemeriksaan->checklist = $request->checklist; // Assuming you have a single checklist result for each inspection

        // Save the HasilPemeriksaan instance
        $hasilPemeriksaan->save();

        // flash()->addSuccess('Berhasil menyimpan Data');
        // return redirect()->route('pemeriksaan.index');
    }





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
