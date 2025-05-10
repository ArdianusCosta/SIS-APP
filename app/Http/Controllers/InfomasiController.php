<?php

namespace App\Http\Controllers;

use App\Models\Informasi;
use Illuminate\Http\Request;

class InfomasiController extends Controller
{
    public function index()
    {
        $informasis = Informasi::paginate(5);
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
            'tanggal' => 'required|date',
            'lampiran' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,ppt,pptx,zip|max:5120',
        ]);

        $lampiranPath = null;
        if($request->hasFile('lampiran')){
            $lampiranPath = $request->file('lampiran')->store('informasi-berita', 'public');
        }
        
        Informasi::create([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'isi' => $request->isi,
            'tanggal' => $request->tanggal,
            'lampiran' => $lampiranPath,
        ]);
        return redirect()->route('informasi.index')->with('success','Berhasil buat Informasi/Berita');
    }
}
