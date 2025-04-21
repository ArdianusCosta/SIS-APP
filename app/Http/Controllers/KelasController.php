<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::with('waliKelas')->paginate(5);
        $gurus = Guru::paginate(5);
        return view('.manajement.kelas.index', compact('kelas','gurus'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $gurus = Guru::all();
        return view('.manajement.kelas.create', compact('kelas','gurus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kelas' => 'required|in:X,XI,XII',
            'jurusan' => 'required|in:RPL,DKV,KULINER,TP,TKP',
            'wali_kelas_id' => 'required|exists:gurus,id',
        ]);

        Kelas::create([
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'wali_kelas_id' => $request->wali_kelas_id,
        ]);

        return redirect()->route('kelas.index')->with('success','Berhasil Tambah Data');
    }
}
