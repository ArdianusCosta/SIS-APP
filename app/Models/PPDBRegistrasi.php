<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPDBRegistrasi extends Model
{
    use HasFactory;

    protected $fillable = ['nama','foto_pendaftar','email','no_telp','tgl_lahir','jenis_kelamin','alamat','asal_sekolah_sebelumnya','tgl_pendaftaran','status'];

    protected $table = 'ppdb_registrasi';
}
