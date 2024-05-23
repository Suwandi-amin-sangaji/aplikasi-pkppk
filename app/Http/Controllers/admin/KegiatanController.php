<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    private $viewIndex = 'kegiatan.kegiatan_index';
    private $viewCreate = 'kegiatan.kegiatan_form';
    private $viewedit = 'kegiatan.kegiatan_form';
    private $viewShow = 'kegiatan.kegiatan_show';
    private $routePrefix = 'kegiatan';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data kegiatan beserta relasi kendaraan
        $kegiatan = Kegiatan::with('kendaraan')->paginate(10);

        return view('admin.' . $this->viewIndex, [
            'kegiatan' => $kegiatan,
            'routePrefix' => $this->routePrefix,
            'title' => 'Komponen Kegiatan',
            // 'kendaraan' => $kendaraan
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kendaraan = Kendaraan::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->plat . ' - ' . $item->jenis];
        });


        $data = [
            'model' => new Kegiatan(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'Simpan',
            'title' => 'Komponen Kegiatan',
            'kendaraan' => $kendaraan
        ];

        return view('admin.' . $this->viewCreate, $data);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requesData = $request->validate([
            'nama' => 'required',
            'id_kendaraan' => 'required'
        ]);
        Kegiatan::create($requesData);
        flash()->addSuccess('Data Komponen Kegiatan Berhasil DiTambahkan');
        return redirect()->route('kegiatan.index');
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
        $kendaraan = Kendaraan::all()->mapWithKeys(function ($item) {
            return [$item->id => $item->plat . ' - ' . $item->jenis];
        });


        $data = [
            'model' => Kegiatan::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'Update',
            'title' => 'Komponen Kegiatan',
            'kendaraan' => $kendaraan

        ];

        return view('admin.' . $this->viewedit, $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requesData = $request->validate([
            'nama' => 'required',
            'id_kendaraan' => 'required'
        ]);
        $users = Kegiatan::findOrFail($id);
        $users->fill($requesData)->save();
        flash()->addSuccess('Data Komponen Kegiatan Berhasil Dirubah');
        return redirect()->route('kegiatan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Kegiatan::findOrFail($id);
        $model->delete();
        flash()->addSuccess('Data Petugas Berhasil Dihapus');
        return back();
    }
}
