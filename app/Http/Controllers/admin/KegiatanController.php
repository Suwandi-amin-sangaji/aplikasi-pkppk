<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
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
        return view('admin.' . $this->viewIndex, [
            'kegiatan' => Kegiatan::latest()->paginate(10),
            'routePrefix' => $this->routePrefix,
            'title' => 'Komponen Kegiatan'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'model' => new Kegiatan(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'Simpan',
            'title' => 'Komponen Kegiatan'
        ];

        return view('admin.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requesData = $request->validate([
            'name' => 'required'
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
        $data = [
            'model' => Kegiatan::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'Update',
            'title' => 'Komponen Kegiatan'

        ];

        return view('admin.' . $this->viewedit, $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requesData = $request->validate([
            'name' => 'required',
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
