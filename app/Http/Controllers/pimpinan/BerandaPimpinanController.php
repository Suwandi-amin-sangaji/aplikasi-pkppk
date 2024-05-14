<?php

namespace App\Http\Controllers\pimpinan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BerandaPimpinanController extends Controller
{
    public function index()
    {
        return view("pimpinan.beranda_index");
    }
}
