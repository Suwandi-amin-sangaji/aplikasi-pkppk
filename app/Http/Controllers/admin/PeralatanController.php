<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Compartment;
use App\Models\Peralatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeralatanController extends Controller
{

    private $viewIndex = 'peralatan.peralatan_index';
    private $viewCreate = 'peralatan.peralatan_form';
    private $viewedit = 'peralatan.peralatan_form';
    private $viewShow = 'peralatan.peralatan_show';
    private $routePrefix = 'peralatan';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Peralatan::with('compartment')
            ->join('compartments', 'peralatans.id_compartment', '=', 'compartments.id')
            ->orderBy('compartments.name')
            ->select('peralatans.*');

        // Apply search filter if search query exists
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('peralatans.item', 'like', "%$search%")
                    ->orWhere('compartments.name', 'like', "%$search%");
            });
        }

        // Paginate the results
        $peralatan = $query->latest()->paginate(10);

        return view('admin.' . $this->viewIndex, [
            'peralatan' => $peralatan,
            'routePrefix' => $this->routePrefix,
            'title' => 'Komponen Peralatan'
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'model' => new Peralatan(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'Simpan',
            'title' => 'Tambah Komponen Peralatan',
            "compartment" => Compartment::pluck('name', 'id'),
        ];

        return view('admin.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'id_compartment' => 'required',
            'item' => 'required',
            'description' => 'required',
            'jumlah' => 'required|numeric',
        ]);

        try {
            // Menggunakan transaksi database untuk menangani kemungkinan kesalahan
            DB::beginTransaction();

            // Buat instance Peralatan dengan data yang valid
            Peralatan::create([
                'id_compartment' => $validatedData['id_compartment'],
                'item' => $validatedData['item'],
                'description' => $validatedData['description'],
                'jumlah' => $validatedData['jumlah']
            ]);

            // Commit transaksi jika tidak ada kesalahan
            DB::commit();

            // Redirect dengan pesan sukses
            return redirect()->route('peralatan.index')->with('success', 'Data Berhasil Disimpan');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Redirect dengan pesan kesalahan
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            'model' => new Peralatan(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'Simpan',
            'title' => 'Komponen Kegiatan'
        ];

        return view('admin.' . $this->viewCreate, $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'model' => Peralatan::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'Update',
            'title' => 'Edit Komponan Peralatan',
            "compartment" => Compartment::pluck('name', 'id'),

        ];

        return view('admin.' . $this->viewedit, $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $requesData = $request->validate([
            'id_compartment' => 'required',
            'item' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'jumlah' => 'required|integer|min:1',
        ]);
        $users = Peralatan::findOrFail($id);
        $users->fill($requesData)->save();
        flash()->addSuccess('Data Perlatan Berhasil Dirubah');
        return redirect()->route('peralatan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $model = Peralatan::findOrFail($id);
        $model->delete();
        flash()->addSuccess('Data Perlatan Berhasil Dihapus');
        return back();
    }
}
