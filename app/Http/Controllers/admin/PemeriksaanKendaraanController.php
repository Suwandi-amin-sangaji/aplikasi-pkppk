<?php

namespace App\Http\Controllers\admin;

use App\Models\Kegiatan;
// use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PemeriksaanKendaraan;
use Carbon\Carbon;

class PemeriksaanKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    private $viewIndex = 'pemeriksaan.pemeriksaanKendaraan_index';
    private $viewCreate = 'pemeriksaan.pemeriksaanKendaraan_form';
    private $viewedit = 'pemeriksaan.pemeriksaanKendaraan_form';
    private $viewShow = 'pemeriksaan.pemeriksaanKendaraan_show';
    private $routePrefix = 'pemeriksaan';
    private $routeCetakKendaraan = 'cetak-laporan-kendaraan';


    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = PemeriksaanKendaraan::with('kendaraan')->where('nama_operator', 'like', "%$search%");

        if ($request->has('start_date') && $request->has('end_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $format = $request->input('format');
        if ($format == 'pdf') {
            $data = $query->get();
            $pdf = PDF::loadView('admin.your_pdf_view', compact('data'));
            return $pdf->download('pemeriksaan_kendaraan.pdf');
        } elseif ($format == 'excel') {
            // return Excel::download(new PemeriksaanKendaraanExport($query->get()), 'pemeriksaan_kendaraan.xlsx');
        }

        $pemeriksaan = $query->latest()->paginate(10);

        if ($request->ajax()) {
            return view('admin.partials.results', compact('pemeriksaan'))->render();
        }

        return view('admin.' . $this->viewIndex, [
            'pemeriksaan' => $pemeriksaan,
            'routeCetakKendaraan' => $this->routeCetakKendaraan,
            'title' => 'Pemeriksaan kendaraan Oleh Petugas'
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
        // Fetch the PemeriksaanKendaraan model with related data
        $model = PemeriksaanKendaraan::with(['baSet1', 'baSet2'])->findOrFail($id);

        // Get the jenis kendaraan
        $kendaraan = Kendaraan::pluck('jenis', 'id');

        // Fetch the related hasilPemeriksaan records keyed by id_kegiatan
        $hasilPemeriksaan = $model->hasilPemeriksaan()->get()->keyBy('id_kegiatan');

        // Fetch kegiatan related to the specific kendaraan type
        $kegiatan = Kegiatan::where('id_kendaraan', $model->id_kendaraan)->get();

        return view('admin.' . $this->viewShow, [
            'title' => 'Detail Pemeriksaan Kendaraan',
            'model' => $model,
            'kendaraan' => $kendaraan,
            'hasilPemeriksaan' => $hasilPemeriksaan,
            'kegiatan' => $kegiatan,
            'baSet1' => $model->baSet1,
            'baSet2' => $model->baSet2,
        ]);
    }

    // public function show(string $id)
    // {
    //     // Fetch the PemeriksaanKendaraan model with related data
    //     $model = PemeriksaanKendaraan::with(['baSet1', 'baSet2'])->findOrFail($id);

    //     // Get the jenis kendaraan
    //     $kendaraan = Kendaraan::pluck('jenis', 'id');

    //     // Fetch the related hasilPemeriksaan records keyed by id_kegiatan
    //     $hasilPemeriksaan = $model->hasilPemeriksaan()->get()->keyBy('id_kegiatan');

    //     // Fetch kegiatan related to the specific kendaraan type
    //     $kegiatan = Kegiatan::where('id_kendaraan', $model->id_kendaraan)->get();

    //     return view('admin.' . $this->viewShow, [
    //         'title' => 'Detail Pemeriksaan Kendaraan',
    //         'model' => $model,
    //         'kendaraan' => $kendaraan,
    //         'hasilPemeriksaan' => $hasilPemeriksaan,
    //         'kegiatan' => $kegiatan,
    //         'baSet1' => $model->baSet1,
    //         'baSet2' => $model->baSet2,
    //     ]);
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $model = PemeriksaanKendaraan::with(['baSet1', 'baSet2'])->findOrFail($id);
        $kendaraan = Kendaraan::pluck('jenis', 'id');
        $hasilPemeriksaan = $model->hasilPemeriksaan()->get()->keyBy('id_kegiatan');

        return view('admin.' . $this->viewShow, [
            'title' => 'Detail Pemeriksaan Kendaraan',
            'model' => $model,
            'kendaraan' => $kendaraan,
            'hasilPemeriksaan' => $hasilPemeriksaan,
            'kegiatan' => Kegiatan::all(),
            'baSet1' => $model->baSet1,
            'baSet2' => $model->baSet2,
        ]);
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
        $model = PemeriksaanKendaraan::findOrFail($id);
        if ($model->status == 'Verifikasi') {
            flash()->addWarning('Data Tidak Dapat Dihapus Jika Sudah Di verifikasi Oleh Pimpinan');
            return back();
        }
        $model->delete();
        flash()->addSuccess('Data Perlatan Berhasil Dihapus');
        return back();
    }

    public function verifikasi($id)
    {
        $pemeriksaan = PemeriksaanKendaraan::with('kendaraan')->findOrFail($id);
        $pemeriksaan->status = 'Verifikasi';
        $pemeriksaan->save();
        // Redirect dengan pesan sukses
        return redirect()->route('pemeriksaan-kendaraan-admin.index')->with('success', 'Data berhasil diverifikasi');
    }


    public function laporanAllKendaraan()
    {
        $kendaraan = PemeriksaanKendaraan::with('kendaraan')->get();
        $pdf = Pdf::loadView('admin.laporan.cetakLaporanKendaraan', ['kendaraan' => $kendaraan]);
        return $pdf->stream('kendaraan.pdf');
    }
}
