<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratIzinKeluarKelas extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal_surat','kepada_yth','nama','kelas_id','jam_ke','pesan_keluar_kelas','status'];

    public function Kelas()
    {
        return $this->belongsTo(Kelas::class,'kelas_id');
    }
}
