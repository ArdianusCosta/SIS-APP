<?php

namespace App\Http\Controllers;

use App\Models\PPDBRegistrasi;
use Illuminate\Http\Request;

class PPDBController extends Controller
{
    public function index()
    {
        return view('PPDB.online.index');
    }

    public function create()
    {
        return view('PPDB.online.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto_pendaftar' => 'required|img|mimes:png,jgp,jpeg,svg|max:1048',
            'email' => 'nullable|email',
            'no_telp' => 'nullable|integer',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable',
            'asal_sekolah_sebelumnya' => 'required',
            'tgl_pendaftaran' => 'required|date',
            'status' => 'required|in:Ditolak,Tertunda,Disetujui'
        ]);

        $fotoPath = null;
        if($request->hasFile('foto_pendaftar')){
            $fotoPath = $request->file('foto_pendaftar')->store('PPDB-Online','public');
        }

        PPDBRegistrasi::create([
            'nama' => $request->nama,
            'foto_pendaftar' => $fotoPath,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'asal_sekolah_sebelumnya' => $request->asal_sekolah_sebelumnya,
            'status' => $request->status,
        ]);

        return redirect()->route('PPDBonline.index')->with('success','Berhasil Daftar');
    }

    public function edit($id)
    {
        return view('PPDBonline.edit');
    }
}
