<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InfomasiController extends Controller
{
    public function index()
    {
        return view('informasi.index');
    }

    public function create()
    {
        return view('informasi.create');
    }
}
