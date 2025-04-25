<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $fillable = ['nama','kelas_id','wali_kelas_id','tempat_lahir','tanggal_lahir','jenis_kelamin','nis','agama','jumlah_saudara','email','no_telepon','qrcode','alamat'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function waliKelas()
    {
        return $this->belongsTo(Guru::class,'wali_kelas_id');
    }
}
