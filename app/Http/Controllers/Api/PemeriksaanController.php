<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BaSet1;
use App\Models\BaSet2;
use App\Models\HasilPemeriksaan;
use App\Models\HasilPeralatan;
use App\Models\Kegiatan;
use App\Models\Kendaraan;
use App\Models\PemeriksaanKendaraan;
use App\Models\PemeriksaanPeralatan;
use App\Models\Peralatan;
use Illuminate\Support\Facades\Auth;

class PemeriksaanController extends Controller
{
    public function pemriksaanKendaraan()
    {
        // $pemeriksaan = PemeriksaanKendaraan::with('hasilPemeriksaan')->get();
        // if($pemeriksaan->isEmpty()){
        //     return $this->sendError('Data tidak ditemukan', [], 404);
        // }
        // return $this->sendResponse($pemeriksaan, 'Berhasil mendapatkan data');

        $data = [
            'kendaraan' => Kendaraan::pluck('jenis', 'id'),
            'kegiatan' => Kegiatan::all(),
        ];

        return $this->sendResponse($data, 'Berhasil mendapatkan data');
    }

    public function addPemeriksaanKendaraan(Request $request)
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

        // Memperoleh ID pengguna yang terautentikasi
        $id_user = Auth::id();


        // Simpan data pemeriksaan ke dalam tabel pemeriksaan_kendaraans
        $pemeriksaan = PemeriksaanKendaraan::create([
            'id_kendaraan' => $validatedData['id_kendaraan'],
            'id_user' => $id_user, // Berikan nilai untuk kolom "id_user"
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

        foreach ($request->except('_token', 'nama_operator', 'nama_asisten', 'id_kendaraan', 'waktu', 'tanggal', 'mengetahui', 'status', 'catatan', 'no_back_plate', 'no_cylinder', 'visual', 'fungsi', 'tekanan', 'operator') as $kegiatan_id => $hasil) {
            if (!is_null($hasil)) {
                $hasilPemeriksaan = HasilPemeriksaan::create([
                    'id_pemeriksaan' => $pemeriksaan->id,
                    'id_kegiatan' => $kegiatan_id,
                    'hasil' => $hasil
                ]);

                if (!$hasilPemeriksaan) {
                    return $this->sendError('Gagal menambahkan data', [], 500);
                }
            }
        }

        return $this->sendResponse($pemeriksaan, 'Berhasil menambahkan data');
    }

    public function pemriksaanPeralatan()
    {
        $pemeriksaan = Peralatan::with('compartment')->get()->groupBy('compartment.name');
        // $pemeriksaan = PemeriksaanPeralatan::with('hasilPeralatan')->get();
        if ($pemeriksaan->isEmpty()) {
            return $this->sendError('Data tidak ditemukan', [], 404);
        }
        return $this->sendResponse($pemeriksaan, 'Berhasil mendapatkan data');
    }
    public function storePemeriksaanPeralatan(Request $request)
    {
    }

    public function addPemeriksaanPeralatan(Request $request)
    {
        // Validasi data dari request
        $validatedData = $request->validate([
            'nama_operator' => 'required|string|max:255',
            'nama_asisten' => 'nullable|string|max:255',
            'jenis_peralatan' => 'required|string|max:255',
            'waktu' => 'required|date_format:H:i',
            'tanggal' => 'required',
            'mengetahui' => 'nullable|string|max:255',
            'catatan' => 'nullable|string|max:255',
        ]);

        // Tambahkan ID pengguna yang sedang masuk
        $validatedData['id_user'] = Auth()->id();

        // Simpan data pemeriksaan ke dalam tabel pemeriksaan_peralatan
        $pemeriksaanPeralatan = PemeriksaanPeralatan::create($validatedData);

        foreach ($request->peralatan as $peralatan_id => $hasil) {
            if ($hasil) {
                $hasilPemeriksaan = HasilPeralatan::create([
                    'id_pemeriksaan' => $pemeriksaanPeralatan->id,
                    'id_peralatan' => $peralatan_id,
                    'hasil' => $hasil
                ]);

                if(!$hasilPemeriksaan){
                    return $this->sendError('Gagal menambahkan data', [], 500);
                }

            }
        }

        return $this->sendResponse($pemeriksaanPeralatan, 'Berhasil Menambah Data Peralatan');
    }
}
