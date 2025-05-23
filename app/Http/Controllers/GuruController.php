<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Exports\GuruExport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $query = Guru::query();

        $columns = ['nama', 'status', 'jabatan', 'nik', 'pendidikan', 'mata_pelajaran', 'jenis_kelamin', 'agama', 'tempat_lahir','tanggal_lahir', 'alamat'];

        if ($request->filled('cari')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $request->cari . '%');
                }
            });
        }

        if($request->filled('jabatan')){
            $query->where('jabatan', $request->jabatan);
        }

        if($request->filled('status')){
            $query->where('status', $request->status);
        }

        if($request->filled('agama')){
            $query->where('agama', $request->agama);
        }

        $firstDate = Guru::orderBy('created_at')->value('created_at');
        $gurus = $query->paginate(5)->appends($request->all());
        return view('.manajement.guru.index',compact('gurus','firstDate'));
    }

    public function create()
    {
        return view('.manajement.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'status' => 'required|in:Aktif,Tidak Aktif,Magang,Cuti,Pensiun,Keluar,Dikeluarkan',
            'jabatan' => 'required|in:Guru,Staff,Kepala Sekolah,Yayasan,Ketua Yayasan',
            'nik' => 'nullable|unique:gurus,nik',
            'pendidikan' =>'required',
            'mata_pelajaran' => 'nullable',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'email' => 'nullable|email',
            'no_telepon' => 'nullable|unique:gurus,no_telepon',
            'img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $path = $file->store('foto-guru', 'public');
        }        

        Guru::create([
            'nama' => $request->nama,
            'status' => $request->status,
            'jabatan' => $request->jabatan,
            'nik' => $request->nik,
            'pendidikan' => $request->pendidikan,
            'mata_pelajaran' => $request->mata_pelajaran,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'img' => $path ?? null,
        ]);

        return redirect()->route('guru.index')->with('success','Berhasil Tambah Data');
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('.manajement.guru.edit',compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $guru = Guru::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'status' => 'required|in:Aktif,Tidak Aktif,Magang,Cuti,Pensiun,Keluar,Dikeluarkan',
            'jabatan' => 'required|in:Guru,Staff,Kepala Sekolah,Yayasan,Ketua Yayasan',
            'nik' => 'nullable|unique:gurus,nik,' . $id,
            'pendidikan' =>'required',
            'mata_pelajaran' => 'nullable',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required',
            'email' => 'nullable|email',
            'no_telepon' => ['nullable',Rule::unique('gurus', 'no_telepon')->ignore($id),],
        ]);

        if ($request->hasFile('img')) {
            // Hapus foto lama jika ada
            if ($guru->img && \Storage::disk('public')->exists($guru->img)) {
                Storage::disk('public')->delete($guru->img);
            }
        
            $file = $request->file('img');
            $path = $file->store('foto-guru', 'public');
            $guru->img = $path;
        }        

        $guru->update([
            'nama' => $request->nama,
            'status' => $request->status,
            'jabatan' => $request->jabatan,
            'nik' => $request->nik,
            'pendidikan' => $request->pendidikan,
            'mata_pelajaran' => $request->mata_pelajaran,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'img' => $path ?? null,
        ]);

        $guru->save();
        return redirect()->route('guru.index')->with('success','Berhasil Edit Data');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);
        $guru->delete();
        return back()->with('success','Berhasil Hapus Data');
    }

    public function export()
    {
        return Excel::download(new GuruExport, 'Guru.xlsx');
    }
    
    public function kontakGuru()
    {
        $gurus = Guru::orderBy('id', 'asc')->get();
        return view('kontak-guru.index', compact('gurus'));
    }
}
