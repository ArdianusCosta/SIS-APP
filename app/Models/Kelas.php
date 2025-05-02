<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['kelas','jurusan','wali_kelas_id'];

    public function waliKelas()
    {
        return $this->belongsTo(Guru::class,'wali_kelas_id');
    }

    public function absensi(){
        return $this->hasMany(Absensi::class);
    }
}
