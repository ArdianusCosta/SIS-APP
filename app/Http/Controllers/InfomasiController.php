<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InfomasiController extends Controller
{
    public function index()
    {
        $informasis = Informasi::all();
        return view('informasi.index', compact('informasis'));
    }

    public function create()
    {
        return view('informasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'kategori' => 'required|in:Pengumuman,Jadwal Acara,Kegiatan Akademik,Ekstrakurikuler,Organisasi Sekolah,Pelayanan',
            'isi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,svg',
            'tanggal' => 'required|date',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,ppt,pptx,zip|max:10240',
        ]);
        
        $fotoPath = null;
        $lampiranPath = null;
        
        if($request->hasFile('foto')){
            $fotoPath = $request->file('foto')->store('informasi-foto', 'public');
        }
        
        if($request->hasFile('lampiran')){
            $lampiranPath = $request->file('lampiran')->store('informasi-berita', 'public');
        }
        
        Informasi::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'foto' => $fotoPath,
            'lampiran' => $lampiranPath,
        ]);        
        return redirect()->route('informasi.index')->with('success','Berhasil buat Pengumuman');
    }
}
