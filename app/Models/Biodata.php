<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biodata extends Model
{
    protected $fillable = [
        'nama',
        'kelas',
        'nim',
        'jenis_kelamin',
        'device',
        'agent_info',
    ];
}
