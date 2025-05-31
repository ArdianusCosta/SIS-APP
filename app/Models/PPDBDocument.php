<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PPDBDocument extends Model
{
    use HasFactory;

    protected $fillable = ['registrasi_id','tipe','file_path'];

    protected $table = 'ppdb_documents';

    public function registrasi()
    {
        return $this->belongsTo(PPDBRegistrasi::class,'registrasi_id');
    }
}
