<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    use HasFactory;

    protected $fillable = ['nama','status','jabatan','nik','pendidikan','mata_pelajaran','jenis_kelamin','agama','tempat_lahir','tanggal_lahir','alamat'];
}
