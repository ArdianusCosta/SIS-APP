<?php

namespace App\Models;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuratIzinKeluarSekolah extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal_surat','kepada_yth','nama','kelas_id','jam_ke','pesan_keluar_sekolah','status'];

    public function Kelas()
    {
        return $this->belongsTo(Kelas::class,'kelas_id');
    }
}
