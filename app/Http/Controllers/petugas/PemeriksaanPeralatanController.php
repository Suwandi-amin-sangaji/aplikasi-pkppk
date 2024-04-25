<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use App\Models\PemeriksaanPeralatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemeriksaanPeralatanController extends Controller
{
    private $viewIndex = 'peralatan.pemeriksaan_index';
    private $viewCreate = 'peralatan.pemeriksaan_form';
    // private $viewedit = 'peralatan.kendaraan_form';
    private $viewShow = 'kendaraan.pemeriksaan_show';
    private $routePrefix = 'peralatan';
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Mengambil ID user yang sedang login
        $userId = Auth::id();
        $pemeriksaan = PemeriksaanPeralatan::with('kendaraan')
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
        //
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
