<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactCosta extends Model
{
    use HasFactory;

    protected $fillable = ['nama','phone','email','phone','pesan_to_costa'];
}
