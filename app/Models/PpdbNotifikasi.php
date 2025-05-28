<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PpdbNotifikasi extends Model
{
    use HasFactory;

    protected $fillable = ['ppdb_id','message','is_read'];

    protected $table = 'ppdb_notifications';

    public function ppdb() :BelongsTo
    {
        return $this->belongsTo(PPDBRegistrasi::class);
    }
}
