<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SuratIzinKeLab extends Model
{
    use HasFactory;

    protected $fillable = ['nama_penanggung_jawab','tanggal_izin','tanggal_selesai','kepada_yth','nama','kelas_id','jam_ke','sampai_jam','pesan_keluar_kelas'];

    public function Kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class,'kelas_id');
    }
}
