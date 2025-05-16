<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{

    protected $fillable = [
        'nim',
        'nama',
        'email',
        'jurusan',
        'created_at',
        'updated_at',
    ];
    protected $table = 'mahasiswa';
}
