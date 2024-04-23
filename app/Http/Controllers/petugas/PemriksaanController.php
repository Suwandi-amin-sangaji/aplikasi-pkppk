<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Models\BaSet1;
use App\Models\BaSet2;
use App\Models\HasilPemeriksaan;
use App\Models\Kegiatan;
use App\Models\Kendaraan;
use App\Models\PemeriksaanKendaraan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        // Mengambil ID user yang sedang login
        $userId = Auth::id(); // Menggunakan Auth::id() untuk mendapatkan ID user yang sedang login
        $pemeriksaan = PemeriksaanKendaraan::with('kendaraan')
            ->where('id_user', $userId) // Filter berdasarkan user_id
            ->latest()
            ->paginate(10);
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
            'no_back_plate' => 'nullable|string|max:255',
            'no_cylinder' => 'nullable|string|max:255',
            'visual' => 'nullable|string|max:255',
            'fungsi' => 'nullable|string|max:255',
            'tekanan' => 'nullable|string|max:255',
            'operator' => 'nullable|string|max:255',
        ]);

        $validatedData['id_user'] = Auth()->id();
        // Simpan data BA SET
        $baSet1 = BaSet1::create([
            'no_back_plate1' => $validatedData['no_back_plate'],
            'no_cylinder1' => $validatedData['no_cylinder'],
            'visual1' => $validatedData['visual'],
            'fungsi1' => $validatedData['fungsi'],
            'tekanan1' => $validatedData['tekanan'],
            'operator1' => $validatedData['operator'],
        ]);

        $baSet2 = BaSet2::create([
            'no_back_plate2' => $validatedData['no_back_plate'],
            'no_cylinder2' => $validatedData['no_cylinder'],
            'visual2' => $validatedData['visual'],
            'fungsi2' => $validatedData['fungsi'],
            'tekanan2' => $validatedData['tekanan'],
            'operator2' => $validatedData['operator'],
        ]);

        // Simpan data pemeriksaan ke dalam tabel pemeriksaan_kendaraans
        $pemeriksaan = PemeriksaanKendaraan::create([
            'id_kendaraan' => $validatedData['id_kendaraan'],
            'id_user' => $validatedData['id_user'],
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
        foreach ($request->except('_token', 'nama_operator', 'nama_asisten', 'id_kendaraan', 'waktu', 'tanggal', 'mengetahui', 'status', 'catatan', 'no_back_plate', 'no_cylinder', 'visual', 'fungsi', 'tekanan', 'operator', 'no_back_plate', 'no_cylinder', 'visual', 'fungsi', 'tekanan', 'operator') as $kegiatan_id => $hasil) {
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
        $model = PemeriksaanKendaraan::with(['baSet1', 'baSet2'])->findOrFail($id);
        $kendaraan = Kendaraan::pluck('jenis', 'id');
        $hasilPemeriksaan = $model->hasilPemeriksaan()->get()->keyBy('id_kegiatan'); // Asumsi ada relasi hasilPemeriksaan yang mengembalikan semua hasil terkait

        return view('petugas.' . $this->viewShow, [
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
