<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use Illuminate\Http\Request;

class OrangTuaController extends Controller
{
    public function index(Request $request)
    {
        $query = OrangTua::query();

        $columns = ['nama_ayah','tempat_lahir_ayah','tanggal_lahir_ayah','agama_ayah','jenis_kelamin_ayah','pendidikan_terakhir_ayah','pekerjaan_ayah','nomor_telepon_ayah','email','alamat_ayah',
                    'nama_ibu','tempat_lahir_ibu','tanggal_lahir_ibu','agama_ibu','jenis_kelamin_ibu','pendidikan_terakhir_ibu','pekerjaan_ibu','nomor_telepon_ibu','email1','alamat_ibu'];

        if($request->filled('cari')){
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'like', '%' . $request->cari . '%');
                }
            });
        }

        $orang_tuas = $query->paginate(5)->appends($request->all());
        return view('.manajement.ortu.index',compact('orang_tuas'));
    }

    public function create()
    {
        return view('.manajement.ortu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_ayah' => 'required',
            'tempat_lahir_ayah' => 'nullable',
            'tanggal_lahir_ayah' => 'required',
            'agama_ayah' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'jenis_kelamin_ayah' => 'required|in:Laki-laki',
            'pendidikan_terakhir_ayah' => 'required|in:SD,SMP,SMA,SMK,D1,D2,D3,D4,S1,S2,S3',
            'pekerjaan_ayah' => 'required',
            'nomor_telepon_ayah' => 'nullable|unique:orang_tuas,nomor_telepon_ayah',
            'email' => 'nullable|email',
            'alamat_ayah' => 'required',

            'nama_ibu' => 'required',
            'tempat_lahir_ibu' => 'nullable',
            'tanggal_lahir_ibu' => 'required',
            'agama_ibu' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'jenis_kelamin_ibu' => 'required|in:Perempuan',
            'pendidikan_terakhir_ibu' => 'required|in:SD,SMP,SMA,SMK,D1,D2,D3,D4,S1,S2,S3',
            'pekerjaan_ibu' => 'required',
            'nomor_telepon_ibu' => 'nullable|unique:orang_tuas,nomor_telepon_ibu',
            'email1' => 'nullable|email',
            'alamat_ibu' => 'required',
        ]);
        OrangTua::create([
            'nama_ayah' => $request->nama_ayah,
            'tempat_lahir_ayah' => $request->tempat_lahir_ayah,
            'tanggal_lahir_ayah' => $request->tanggal_lahir_ayah,
            'agama_ayah' => $request->agama_ayah,
            'jenis_kelamin_ayah' => $request->jenis_kelamin_ayah,
            'pendidikan_terakhir_ayah' => $request->pendidikan_terakhir_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nomor_telepon_ayah' => $request->nomor_telepon_ayah,
            'email' => $request->email,
            'alamat_ayah' => $request->alamat_ayah,

            'nama_ibu' => $request->nama_ibu,
            'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
            'tanggal_lahir_ibu' => $request->tanggal_lahir_ibu,
            'agama_ibu' => $request->agama_ibu,
            'jenis_kelamin_ibu' => $request->jenis_kelamin_ibu,
            'pendidikan_terakhir_ibu' => $request->pendidikan_terakhir_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'nomor_telepon_ibu' => $request->nomor_telepon_ibu,
            'email1' => $request->email1,
            'alamat_ibu' => $request->alamat_ibu,
        ]);
        return redirect()->route('ortu.index')->with('success','Berhasil Tambah Data');
    }

    public function edit($id)
    {
        $orang_tua = OrangTua::findOrFail($id);
        return view('.manajement.ortu.edit',compact('orang_tua'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_ayah' => 'required',
            'tempat_lahir_ayah' => 'nullable',
            'tanggal_lahir_ayah' => 'required',
            'agama_ayah' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'jenis_kelamin_ayah' => 'required|in:Laki-laki',
            'pendidikan_terakhir_ayah' => 'required|in:SD,SMP,SMA,SMK,D1,D2,D3,D4,S1,S2,S3',
            'pekerjaan_ayah' => 'required',
            'nomor_telepon_ayah' => 'nullable|unique:orang_tuas,nomor_telepon_ayah,' .$id,
            'email' => 'nullable|email',
            'alamat_ayah' => 'required',

            'nama_ibu' => 'required',
            'tempat_lahir_ibu' => 'nullable',
            'tanggal_lahir_ibu' => 'required',
            'agama_ibu' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'jenis_kelamin_ibu' => 'required|in:Perempuan',
            'pendidikan_terakhir_ibu' => 'required|in:SD,SMP,SMA,SMK,D1,D2,D3,D4,S1,S2,S3',
            'pekerjaan_ibu' => 'required',
            'nomor_telepon_ibu' => 'nullable|unique:orang_tuas,nomor_telepon_ibu,' .$id,
            'email1' => 'nullable|email',
            'alamat_ibu' => 'required',
        ]);
        $orang_tua = OrangTua::findOrFail($id);
        $orang_tua->update([
            'nama_ayah' => $request->nama_ayah,
            'tempat_lahir_ayah' => $request->tempat_lahir_ayah,
            'tanggal_lahir_ayah' => $request->tanggal_lahir_ayah,
            'agama_ayah' => $request->agama_ayah,
            'jenis_kelamin_ayah' => $request->jenis_kelamin_ayah,
            'pendidikan_terakhir_ayah' => $request->pendidikan_terakhir_ayah,
            'pekerjaan_ayah' => $request->pekerjaan_ayah,
            'nomor_telepon_ayah' => $request->nomor_telepon_ayah,
            'email' => $request->email,
            'alamat_ayah' => $request->alamat_ayah,

            'nama_ibu' => $request->nama_ibu,
            'tempat_lahir_ibu' => $request->tempat_lahir_ibu,
            'tanggal_lahir_ibu' => $request->tanggal_lahir_ibu,
            'agama_ibu' => $request->agama_ibu,
            'jenis_kelamin_ibu' => $request->jenis_kelamin_ibu,
            'pendidikan_terakhir_ibu' => $request->pendidikan_terakhir_ibu,
            'pekerjaan_ibu' => $request->pekerjaan_ibu,
            'nomor_telepon_ibu' => $request->nomor_telepon_ibu,
            'email1' => $request->email1,
            'alamat_ibu' => $request->alamat_ibu,
        ]);
        return redirect()->route('ortu.index')->with('success','Berhasil Edit Data');
    }

    public function destroy($id)
    {
        $orang_tua = OrangTua::findOrFail($id);
        $orang_tua->delete();
        return back()->with('success','Berhasil Hapus Data');
    }
}
