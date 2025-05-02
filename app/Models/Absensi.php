<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = ['siswa_id','kelas_id','tanggal_waktu','status_kehadiran','keterangan'];

    public function siswa(){
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function kelas(){
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
