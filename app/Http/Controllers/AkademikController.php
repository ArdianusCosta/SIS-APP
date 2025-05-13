<?php

namespace App\Http\Controllers;

use App\Models\Akademik;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class AkademikController extends Controller
{
    public function index()
    {
        return view('akademik.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:Lakik,Cewek',
            'foto' => 'required|img|mimes:jpg,pgn,svg,jgeg',
        ]);

        $fotoPath = null;
        if($request->hasFile('foto')){
            $fotoPath = $request->file('foto')->store('foto-test','public');
        }

        Akademik::create([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('akademik.index')->with('success','Berhasil tambah data');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'jenis_kelamin' => 'required|in:Lakik,Cewek',
            'foto' => 'required|img|mimes:jpg,pgn,svg,jgeg',
        ]);

        $fotoPath = null;
        if($request->hasFile('foto')){
            $fotoPath = $request->file('foto')->store('foto-test','public');
        }

        Akademik::create([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $fotoPath,
        ]);

        $akademik->save();

        return redirect()->route('akademik.index')->with('success','Berhasil edit data');
    }

    public function destroy($id)
    {
        $akademik = Akademik::findOrFail($id);
        $akademik->delete();
        return back()->with('success','Berhasil hapus data');
    }
}
