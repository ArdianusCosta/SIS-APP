<?php

namespace App\Models;

use App\Models\PPDB\PPDBDocument;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPDBRegistrasi extends Model
{
    use HasFactory;

    protected $fillable = ['nama','nisn','nik','foto_pendaftar','email','no_telp','tempat_lahir','tgl_lahir','jenis_kelamin','alamat','asal_sekolah_sebelumnya','nama_ayah','nama_ibu','tgl_pendaftaran','status'];

    protected $table = 'ppdb_registrasi';

    public function document()
    {
        return $this->hasMany(PPDBDocument::class,'registrasi_id');
    }
}
