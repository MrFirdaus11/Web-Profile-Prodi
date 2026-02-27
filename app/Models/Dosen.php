<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = [
        'nama',
        'nidn',
        'jabatan',
        'bidang_keahlian',
        'pendidikan',
        'foto',
        'email',
        'urutan',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}
