<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Sop;
use Illuminate\Http\Request;

class SopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $viewIndex = 'sop.sop_index';
    private $viewCreate = 'sop.sop_form';
    private $viewedit = 'sop.sop_form';
    private $viewShow = 'sop.sop_show';
    private $routePrefix = 'sop';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.' . $this->viewIndex, [
            'sop' => Sop::orderBy('title')->paginate(5), // Mengurutkan berdasarkan nama
            'routePrefix' => $this->routePrefix,
            'title' => 'Data sop'
        ]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'model' => new Sop(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'Simpan',
            'title' => 'SOP'
        ];

        return view('admin.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Handle the file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            // Store the file path and name in the database
            $data = [
                'title' => $request->input('title'),
                'file' => '/storage/' . $filePath,
            ];

            // Save the data to the database (assuming you have a Model called MyModel)
            Sop::create($data);
            flash()->addSuccess('Data SOP Berhasil Di Tambahkan');

            // Redirect with a success message
            return redirect()->route('sop.index');
        }

        // Handle the case where the file is not provided
        return redirect()->back()->withErrors(['file' => 'File is required.']);
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sop = Sop::findOrFail($id);
        return view('admin.' . $this->viewShow, [
            'model' => new Sop(),
            'title' => 'Detail SOP',
            'routePrefix' => $this->routePrefix,
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sop = Sop::findOrFail($id);
        $data = [
            'model' => $sop,
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'Update',
            'title' => 'Edit SOP'
        ];

        return view('admin.' . $this->viewedit, $data);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'nullable|file|mimes:pdf|max:2048',
        ]);

        $sop = Sop::findOrFail($id);

        // Handle the file upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->storeAs('uploads', $fileName, 'public');

            // Update the file path in the database
            $sop->file = '/storage/' . $filePath;
        }

        // Update the title
        $sop->title = $request->input('title');
        $sop->save();

        flash()->addSuccess('Data SOP Berhasil Di Update');
        return redirect()->route('sop.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sop = Sop::findOrFail($id);

        // Optionally, you can delete the file from storage
        // Storage::delete('public/uploads/' . basename($sop->file));

        $sop->delete();

        flash()->addSuccess('Data SOP Berhasil Di Hapus');
        return redirect()->route('sop.index');
    }
}
