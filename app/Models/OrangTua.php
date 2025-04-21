<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

    protected $fillable = ['nama_ayah','tempat_lahir_ayah','tanggal_lahir_ayah','agama_ayah','jenis_kelamin_ayah','pendidikan_terakhir_ayah','pekerjaan_ayah','nomor_telepon_ayah','email','alamat_ayah',
                            'nama_ibu','tempat_lahir_ibu','tanggal_lahir_ibu','agama_ibu','jenis_kelamin_ibu','pendidikan_terakhir_ibu','pekerjaan_ibu','nomor_telepon_ibu','email1','alamat_ibu'];
}
