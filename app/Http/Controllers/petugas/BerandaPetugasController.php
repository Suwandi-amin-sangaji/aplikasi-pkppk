<?php

namespace App\Http\Controllers\petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerandaPetugasController extends Controller
{
    public function index()
    {
        return view("petugas.beranda_index");
    }
}
