<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Kendaraan;
use App\Models\Komponen;
use App\Models\Pemeriksaan;
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
        $pemeriksaan = Pemeriksaan::with('kendaraan')->latest()->paginate(5);
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
            'model' => new Pemeriksaan(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'Simpan',
            'title' => 'Kendaraan',
            'kendaraan' => Kendaraan::pluck('jenis_kendaraan'),
            'kegiatan' => Kegiatan::all(), // Menambahkan data kegiatan ke dalam array $data
        ];

        return view('petugas.' . $this->viewCreate, $data);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_operator' => 'required|string|max:255',
            'plat' => 'required|string|max:255',
            'kendaraan' => 'required|string|max:255',
            'waktu' => 'required|date_format:H:i',
            'tanggal' => 'required|date',
            'mengetahui' => 'required|string|max:255',
            'komponen' => 'required|array',
            'komponen.*.checklist' => 'nullable|boolean',
        ]);


        // Buat objek pemeriksaan baru
        $pemeriksaan = new Pemeriksaan();
        $pemeriksaan->nama_operator = $request->nama_operator;
        $pemeriksaan->plat = $request->plat;
        $pemeriksaan->jenis_kendaraan = $request->kendaraan;
        $pemeriksaan->waktu_pemeriksaan = $request->waktu;
        $pemeriksaan->tanggal = $request->tanggal;
        $pemeriksaan->mengetahui = $request->mengetahui;
        dd($pemeriksaan);
        $pemeriksaan->save();



        // Simpan detail checklist
        foreach ($request->komponen as $kegiatan_id => $detail) {
            $pemeriksaan->komponen()->attach($kegiatan_id, ['checklist' => $detail['checklist'] ?? false]);
        }

        // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
        return redirect()->route('pemeriksaan.index')->with('success', 'Data pemeriksaan berhasil disimpan.');
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
