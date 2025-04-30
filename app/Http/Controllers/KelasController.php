<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KelasController extends Controller
{

    public function index(Request $request)
    {
        $query = Kelas::query();

        if ($request->filled('date_start') && $request->filled('date_end')) {
            $query->whereBetween('created_at', [$request->date_start, $request->date_end]);
        }

        if ($request->filled('kelas')) {
            $query->where('kelas', $request->kelas);
        }

        if ($request->filled('jurusan')) {
            $query->where('jurusan', $request->jurusan);
        }

        if ($request->filled('cari')) {
            $columns = ['kelas', 'jurusan', 'wali_kelas_id'];
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $request->cari . '%');
                }
            })
            ->orWhereHas('waliKelas', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->cari . '%');
            }); 
        }

        $kelas = $query->with('waliKelas')->paginate(5)->appends($request->all());
        $gurus = Guru::paginate(5);

        return view('manajement.kelas.index', compact('kelas', 'gurus'));
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

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $gurus = Guru::all();
        return view('.manajement.kelas.edit',compact('kelas','gurus'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);
        
        $request->validate([
            'kelas' => 'required|in:X,XI,XII',
            'jurusan' => 'required|in:RPL,DKV,KULINER,TP,TKP',
            'wali_kelas_id' => 'required|exists:gurus,id',
        ]);
        $kelas->update([
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'wali_kelas_id' => $request->wali_kelas_id,
        ]);
        $kelas->save();
        return redirect()->route('kelas.index')->with('success','Berhasil Edit Data');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $gurus = Guru::all();
        $kelas->delete();
        return back()->with('success','Berhasil Hapus Data');
    }

    public function show()
    {
        
    }
}
