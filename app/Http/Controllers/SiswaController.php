<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\OrangTua;
use App\Models\Siswa;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query();

        $columns = ['nama','kelas_id','wali_kelas_id','tempat_lahir','tanggal_lahir','jenis_kelamin','nis','agama','jumlah_saudara','email','no_telepon','qrcode','alamat'];

        if ($request->filled('cari')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $request->cari . '%');
                }
        
                $q->orWhereHas('kelas', function ($kelasQuery) use ($request) {
                    $kelasQuery->where('kelas', 'like', '%' . $request->cari . '%')
                               ->orWhere('jurusan', 'like', '%' . $request->cari . '%');
                });
        
                $q->orWhereHas('waliKelas', function ($guruQuery) use ($request) {
                    $guruQuery->where('nama', 'like', '%' . $request->cari . '%');
                });
            });
        }
        

        $siswas = Siswa::with(['kelas','waliKelas']);
        $siswas = $query->paginate(5)->appends($request->all());
        return view ('.manajement.siswa.index', compact('siswas'));
    }

    public function create()
    {
        $kelas = Kelas::all();
        $gurus = Guru::all();
        $siswas = Siswa::all();
        return view('.manajement.siswa.create',compact('kelas','gurus','siswas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'wali_kelas_id' => 'required|exists:gurus,id',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nis' => 'required|unique:siswas,nis',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'jumlah_saudara' => 'nullable',
            'email' => 'nullable|email',
            'no_telepon' => 'nullable|unique:siswas,no_telepon',
            'qrcode' => 'nullable',
            'alamat' => 'required',
        ]);
        Siswa::create([
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id,
            'wali_kelas_id' => $request->wali_kelas_id,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nis' => $request->nis,
            'agama' => $request->agama,
            'jumlah_saudara' => $request->jumlah_saudara,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'qrcode' => $request->qrcode,
            'alamat' => $request->alamat,
        ]);
        return redirect()->route('siswa.index')->with('success','Berhasil Tambah Data');
    }

    public function edit($id)
    {
        $siswas = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        $gurus = Guru::all();
        return view('.manajement.siswa.edit', compact('siswas','kelas','gurus'));
    }

    public function update(Request $request, $id)
    {
        $siswas = Siswa::findOrFail($id);
        $kelas = Kelas::all();
        $gurus = Guru::all();

        $request->validate([
            'nama' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
            'wali_kelas_id' => 'required|exists:gurus,id',
            'tempat_lahir' => 'nullable',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'nis' => 'required|unique:siswas,nis,' . $id,
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'jumlah_saudara' => 'nullable',
            'email' => 'nullable|email',
            'no_telepon' => ['nullable',Rule::unique('siswas', 'no_telepon')->ignore($id),],
            'qrcode' => 'nullable',
            'alamat' => 'required',
        ]);
        $siswas->update([
            'nama' => $request->nama,
            'kelas_id' => $request->kelas_id,
            'wali_kelas_id' => $request->wali_kelas_id,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'nis' => $request->nis,
            'agama' => $request->agama,
            'jumlah_saudara' => $request->jumlah_saudara,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'qrcode' => $request->qrcode,
            'alamat' => $request->alamat,
        ]);
        $siswas->save();
        return redirect()->route('siswa.index')->with('success','Berhasil Edit Data');
    }

    public function destroy($id)
    {
        $siswas = Siswa::findOrFail($id);
        $siswas->delete();
        return back()->with('success','Berhasil Hapus Data');
    }
}
