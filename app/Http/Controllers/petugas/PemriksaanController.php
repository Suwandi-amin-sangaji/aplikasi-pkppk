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
            'kendaraan' => Kendaraan::pluck('jenis', 'id'), // Mengambil nama dan id kendaraan
            'kegiatan' => Kegiatan::all(),
        ];

        return view('petugas.' . $this->viewCreate, $data);
    }




    public function store(Request $request)
    {
        // Validasi data dari request
        $validatedData = $request->validate([
            'nama_operator' => 'required|string|max:255',
            'nama_asisten' => 'nullable|string|max:255',
            'id_kendaraan' => 'required|exists:kendaraans,id',
            'waktu' => 'required|date_format:H:i',
            'tanggal' => 'required|date',
            'mengetahui' => 'nullable|string|max:255',
        ]);

        // Simpan data pemeriksaan ke dalam tabel pemeriksaan_kendaraans
        $pemeriksaan = PemeriksaanKendaraan::create([
            'id_kendaraan' => $validatedData['id_kendaraan'],
            'nama_operator' => $validatedData['nama_operator'],
            'nama_asisten' => $validatedData['nama_asisten'],
            'waktu' => $validatedData['waktu'],
            'tanggal' => $validatedData['tanggal'],
            'mengetahui' => $validatedData['mengetahui'],
            'status' => 'baru',
        ]);

        // Simpan hasil pemeriksaan ke dalam tabel hasil_pemeriksaan
        foreach ($request->except('_token', 'nama_operator', 'nama_asisten', 'id_kendaraan', 'waktu', 'tanggal', 'mengetahui') as $kegiatan_id => $hasil) {
            HasilPemeriksaan::create([
                'id_pemeriksaan' => $pemeriksaan->id,
                'id_kegiatan' => $kegiatan_id,
                'hasil' => $hasil
            ]);
        }

        flash()->addSuccess('Berhasil Menambah Data');
        return redirect()->route('pemeriksaan.index');
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
