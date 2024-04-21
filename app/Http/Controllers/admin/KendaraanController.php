<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\User;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $viewIndex = 'kendaraan.kendaraan_index';
    private $viewCreate = 'kendaraan.kendaraan_form';
    private $viewedit = 'kendaraan.kendaraan_form';
    private $viewShow = 'kendaraan.kendaraan_show';
    private $routePrefix = 'kendaraan';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.' . $this->viewIndex, [
            'kendaraan' => Kendaraan::latest()->paginate(5),
            'routePrefix' => $this->routePrefix,
            'title' => 'Data kendaraan'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'model' => new User(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'Simpan',
            'title' => 'Kendaraan'
        ];

        return view('admin.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requesData = $request->validate([
            'jenis' => 'required',
            'plat' => 'required',
            'merk' => 'required',
            'jumlah' => 'required',
        ]);
        Kendaraan::create($requesData);
        flash()->addSuccess('Data Knedaraan Berhasil DiTambahkan');
        return redirect()->route('kendaraan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $model = User::findOrFail($id);
        // return view('admin.' . $this->viewShow, compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'model' => Kendaraan::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'Update',
            'title' => 'Kendaraan'

        ];

        return view('admin.' . $this->viewedit, $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requesData = $request->validate([
            'jenis' => 'required',
            'plat' => 'required',
            'merk' => 'required',
            'jumlah' => 'required',
        ]);
        $users = Kendaraan::findOrFail($id);
        $users->fill($requesData)->save();
        flash()->addSuccess('Data Petugas Berhasil Dirubah');
        return redirect()->route('kendaraan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Kendaraan::findOrFail($id);
        $model->delete();
        flash()->addSuccess('Data Petugas Berhasil Dihapus');
        return back();
    }
}
