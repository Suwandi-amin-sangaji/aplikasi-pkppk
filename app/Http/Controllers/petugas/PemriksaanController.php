<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Models\BaSet1;
use App\Models\BaSet2;
use App\Models\HasilPemeriksaan;
use App\Models\Kegiatan;
use App\Models\Kendaraan;
use App\Models\PemeriksaanKendaraan;
use Illuminate\Http\Request;

class PemriksaanController extends Controller
{
    private $viewIndex = 'kendaraan.pemeriksaan_index';
    private $viewCreate = 'kendaraan.pemeriksaan_form';
    // private $viewedit = 'kendaraan.kendaraan_form';
    private $viewShow = 'kendaraan.pemeriksaan_show';
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
            'kendaraan' => Kendaraan::pluck('jenis', 'id'),
            'beset' => BaSet1::first(),
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
            'catatan' => 'nullable|string|max:255',

            // Validation rules for other fields...
            'no_back_plate_1' => 'nullable|string|max:255',
            'no_cylinder_1' => 'nullable|string|max:255',
            'visual_1' => 'nullable|string|max:255',
            'fungsi_1' => 'nullable|string|max:255',
            'tekanan_1' => 'nullable|string|max:255',
            'operator_1' => 'nullable|string|max:255',
            // Add validation rules for other fields as needed

            // Validation rules for other fields...
            'no_back_plate_2' => 'nullable|string|max:255',
            'no_cylinder_2' => 'nullable|string|max:255',
            'visual_2' => 'nullable|string|max:255',
            'fungsi_2' => 'nullable|string|max:255',
            'tekanan_2' => 'nullable|string|max:255',
            'operator_2' => 'nullable|string|max:255',
            // Add validation rules for other fields as needed
        ]);

        // Simpan data BA SET
        $baSet1 = BaSet1::create([
            'no_back_plate1' => $validatedData['no_back_plate_1'],
            'no_cylinder1' => $validatedData['no_cylinder_1'],
            'visual1' => $validatedData['visual_1'],
            'fungsi1' => $validatedData['fungsi_1'],
            'tekanan1' => $validatedData['tekanan_1'],
            'operator1' => $validatedData['operator_1'],
        ]);

        $baSet2 = BaSet2::create([
            'no_back_plate2' => $validatedData['no_back_plate_2'],
            'no_cylinder2' => $validatedData['no_cylinder_2'],
            'visual2' => $validatedData['visual_2'],
            'fungsi2' => $validatedData['fungsi_2'],
            'tekanan2' => $validatedData['tekanan_2'],
            'operator2' => $validatedData['operator_2'],
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
            'catatan' => $validatedData['catatan'],
            'id_baset_1' => $baSet1->id,
            'id_baset_2' => $baSet2->id,
        ]);

        // Simpan hasil pemeriksaan ke dalam tabel hasil_pemeriksaan
        foreach ($request->except('_token', 'nama_operator', 'nama_asisten', 'id_kendaraan', 'waktu', 'tanggal', 'mengetahui', 'status', 'catatan', 'no_back_plate_1', 'no_cylinder_1', 'visual_1', 'fungsi_1', 'tekanan_1', 'operator_1', 'no_back_plate_2', 'no_cylinder_2', 'visual_2', 'fungsi_2', 'tekanan_2', 'operator_2') as $kegiatan_id => $hasil) {
            HasilPemeriksaan::create([
                'id_pemeriksaan' => $pemeriksaan->id,
                'id_kegiatan' => $kegiatan_id,
                'hasil' => $hasil
            ]); // Pastikan hasil tidak null
        }
        flash()->addSuccess('Berhasil Menambah Data');
        return redirect()->route('pemeriksaan.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            "pemeriksaan" => PemeriksaanKendaraan::findOrFail($id),
        ];
        return view('petugas.' . $this->viewShow);
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
