<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Models\HasilPeralatan;
use App\Models\PemeriksaanPeralatan;
use App\Models\Peralatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemeriksaanPeralatanController extends Controller
{
    private $viewIndex = 'peralatan.pemeriksaan_peralatan_index';
    private $viewCreate = 'peralatan.pemeriksaan_peralatan_form';
    // private $viewedit = 'peralatan.kendaraan_form';
    private $viewShow = 'kendaraan.pemeriksaan_show';
    private $routePrefix = 'pemeriksaan-peralatan';
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Mengambil ID user yang sedang login
        $userId = Auth::id();
        // $pemeriksaan = PemeriksaanPeralatan::with('peralatan')
        //     ->where('id_user', $userId) // Filter berdasarkan user_id
        //     ->latest()
        //     ->paginate(10);
        return view('petugas.' . $this->viewIndex, [
            // 'pemeriksaan' => $pemeriksaan,
            'routePrefix' => $this->routePrefix,
            'title' => 'Pemeriksaan kendaraan'
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
        $validatedData = $request->validate([
            'nama_operator' => 'required|string',
            'nama_asisten' => 'nullable|string',
            'jenis_peralatan' => 'required|string',
            'waktu' => 'required|date_format:H:i',
            'tanggal' => 'required|string',
            'mengetahui' => 'nullable|string',
            'catatan' => 'nullable|string',
            'peralatan.*.id' => 'required', // Validate the presence of peralatan IDs
            'peralatan.*.hasil' => 'required', // Validate the presence of peralatan hasil
        ]);

        $validatedData['id_user'] = Auth()->id();

        $pemeriksaan = PemeriksaanPeralatan::create([
            'jenis_peralatan' => $validatedData['jenis_peralatan'],
            'id_user' => $validatedData['id_user'],
            'nama_operator' => $validatedData['nama_operator'],
            'nama_asisten' => $validatedData['nama_asisten'],
            'waktu' => $validatedData['waktu'],
            'tanggal' => $validatedData['tanggal'],
            'mengetahui' => $validatedData['mengetahui'],
            'status' => 'baru',
            'catatan' => $validatedData['catatan'],
        ]);

        foreach ($request->peralatan as $peralatan) {
            $hasil = new HasilPeralatan();
            $hasil->id_pemeriksaan = $pemeriksaan->id;
            $hasil->id_peralatan = $peralatan['id'];
            $hasil->hasil = $peralatan['hasil'];
            $hasil->save();
        }

        flash()->addSuccess('Berhasil Menyimpan Data');

        return redirect()->route('peralatan.pemeriksaan_peralatan_index');
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
