<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class AbsensiController extends Controller
{
    public function list()
    {
        return view('absensi.list');
    }

    public function cariSiswa(Request $request)
    {
        $cari = $request->get('query');
        $siswa = Siswa::where('nama', 'LIKE', "%{$cari}%")->get(['id','nama']);
        return response()->json($siswa);
    }

    public function create(Request $request)
    {
        $kelas = Kelas::all();
        $absensis = Absensi::all();
        return view('absensi.input.create',compact('kelas','absensis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'kelas_id' => 'required|exists:kelas,id',
            'tanggal_waktu' => 'required',
            'status_kehadiran' => 'required|in:Hadir,Sakit,Izin,Alpha',
            'keterangan' => 'nullable',
        ]);

        Absensi::create([
            'siswa_id' => $request->siswa_id,
            'kelas_id' => $request->kelas_id,
            'tanggal_waktu' => $request->tanggal_waktu,
            'status_kehadiran' => $request->status_kehadiran,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success','Hadir');
    }
}
