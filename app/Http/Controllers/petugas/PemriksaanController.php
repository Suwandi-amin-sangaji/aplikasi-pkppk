<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Models\admin\Kendaraan;
use App\Models\petugas\Pemeriksaan;
use Illuminate\Http\Request;

class PemriksaanController extends Controller
{
    private $viewIndex = 'kendaraan.pemeriksaan_index';
    private $viewCreate = 'kendaraan.pemeriksaan_form';
    private $viewedit = 'kendaraan.kendaraan_form';
    private $viewShow = 'kendaraan.kendaraan_show';
    private $routePrefix = 'kendaraan';
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('petugas.' . $this->viewIndex, [
            'kendaraan' => Pemeriksaan::latest()->paginate(5),
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
            'model' => new Kendaraan(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'Simpan',
            'title' => 'Kendaraan'
        ];

        return view('petugas.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
