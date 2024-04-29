<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Models\HasilPeralatan;
use App\Models\PemeriksaanPeralatan;
use App\Models\Peralatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemeriksaanPeralatanController extends Controller
{
    private $viewIndex = 'peralatan.pemeriksaan_peralatan_index';
    private $viewCreate = 'peralatan.pemeriksaan_peralatan_form';
    // private $viewedit = 'peralatan.kendaraan_form';
    private $viewShow = 'peralatan.pemeriksaan_peralatan_show';
    private $routePrefix = 'pemeriksaan-peralatan';
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Mengambil ID user yang sedang login
        $userId = Auth::id();
        $peralatan = PemeriksaanPeralatan::with('peralatan')
            ->where('id_user', $userId) // Filter berdasarkan user_id
            ->latest()
            ->paginate(10);
        return view('petugas.' . $this->viewIndex, [
            'peralatan' => $peralatan,
            'routePrefix' => $this->routePrefix,
            'title' => 'Pemeriksaan Peralatan'
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $peralatan = Peralatan::with('compartment')->get()->groupBy('compartment.name');

        $data = [
            'model' => new PemeriksaanPeralatan(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'Simpan',
            'title' => 'Peralatan',
            'peralatan' => $peralatan,
        ];

        return view('petugas.' . $this->viewCreate, $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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

        // Simpan hasil pemeriksaan peralatan ke dalam tabel hasil_pemeriksaan_peralatan
        foreach ($request->except('_token', 'nama_operator', 'nama_asisten', 'jenis_peralatan', 'waktu', 'tanggal', 'mengetahui', 'catatan') as $peralatan_id => $hasil) {
            if ($hasil) {
                HasilPeralatan::create([
                    'id_pemeriksaan' => $pemeriksaanPeralatan->id,
                    'id_peralatan' => $peralatan_id,
                    'hasil' => $hasil
                ]);
            }
        }

        flash()->addSuccess('Berhasil Menambah Data');
        return redirect()->route('pemeriksaan-peralatan.index');
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
        return view('petugas.' . $this->viewShow, [
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
        //
    }
}
