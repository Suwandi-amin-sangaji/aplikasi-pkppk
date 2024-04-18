<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $viewIndex = 'petugas.petugas_index';
    private $viewCreate = 'petugas.petugas_form';
    private $viewedit = 'petugas.petugas_form';
    private $viewShow = 'petugas.petugas_show';
    private $routePrefix = 'petugas';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.' . $this->viewIndex, [
            'petugas' => User::latest()->paginate(5),
            'routePrefix' => $this->routePrefix,
            'title' => 'Data Petugas'
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
            'title' => 'Petugas'
        ];

        return view('admin.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $requesData = $request->validate([
            'name' => 'required',
            'email' => 'required | unique:users',
            'phone' => 'required | unique:users',
            'akses' => 'required | in:admin,petugas,pimpinan',
            'password' => 'required | min:8',
        ]);
        $requesData['password'] = bcrypt($requesData['password']);
        User::create($requesData);
        flash()->addSuccess('Data Petugas Berhasil DiTambahkan');
        return redirect()->route('petugas.index');
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
            'model' => User::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'Update',

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
            'email' => 'required|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'akses' => 'required|in:admin,petugas,pimpinan',
            'password' => 'nullable | min:8',
        ]);
        $users = User::findOrFail($id);
        if (isset($requesData['password']) == "") {
            unset($requesData['password']);
        } else {
            $requesData['password'] = bcrypt($requesData['password']);
        }
        $users->fill($requesData)->save();
        flash()->addSuccess('Data Petugas Berhasil Dirubah');
        return redirect()->route('petugas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = User::findOrFail($id);
        if ($model->email == 'admin@gmail.com') {
            flash()->addFlash('error', 'Data Admin Tidak dapat Dihapus');
            return back();
        }

        $model->delete();
        flash()->addSuccess('Data Petugas Berhasil Dihapus');
        return back();
    }
}
