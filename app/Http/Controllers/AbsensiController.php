<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function list()
    {
        return view('absensi.list');
    }

    public function create(Request $request)
    {
        return view('absensi.input.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kelas' => 'required',
        ]);
    }
}
