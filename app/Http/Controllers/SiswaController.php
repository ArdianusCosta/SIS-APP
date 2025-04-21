<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        return view('.manajement.siswa.index');
    }

    public function create()
    {
        return view('.manajement.siswa.create');
    }
}
