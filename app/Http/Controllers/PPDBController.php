<?php

namespace App\Http\Controllers;

use App\Models\PPDBRegistrasi;
use Illuminate\Http\Request;

class PPDBController extends Controller
{
    public function index()
    {
        $ppdbs = PPDBRegistrasi::whereIn('status',['Disetujui','Ditolak'])->paginate(5);
        return view('PPDB.online.index',compact('ppdbs'));
    }

    public function create()
    {
        return view('PPDB.online.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'foto_pendaftar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            'email' => 'nullable|email',
            'no_telp' => 'nullable|string|max:20',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat' => 'nullable',
            'asal_sekolah_sebelumnya' => 'required',
            'tgl_pendaftaran' => 'required|date',
            'status' => 'Tertunda',
        ]);
        $fotoPath = null;
        if($request->hasFile('foto_pendaftar')){
            $fotoPath = $request->file('foto_pendaftar')->store('PPDB-Online','public');
        };
        PPDBRegistrasi::create([
            'nama' => $request->nama,
            'foto_pendaftar' => $fotoPath,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'tgl_lahir' => $request->tgl_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'asal_sekolah_sebelumnya' => $request->asal_sekolah_sebelumnya,
            'tgl_pendaftaran' => $request->tgl_pendaftaran,
            'status' => $request->status,
        ]);
        return redirect()->route('PPDBonline.index')->with('success','Berhasil Daftar Silankan tunggu informasi lewat status yang akan diupdate disini');
    }

    public function destroy($id)
    {
        $ppdbs = PPDBRegistrasi::findOrFail($id);
        $ppdbs->delete();
        return back()->with('success','Berhasil hapus data');
    }

    public function adminIndex()
    {
        $ppdbs = PPDBRegistrasi::paginate(5); 
        return view('PPDB.status.index-admin', compact('ppdbs'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Ditolak,Tertunda,Disetujui',
        ]);

        $ppdb = PPDBRegistrasi::findOrFail($id);
        $ppdb->status = $request->status;
        $ppdb->save();

        return redirect()->back()->with('success', 'Status berhasil diperbarui data akan diupdate di PPDB Online');
    }

}
