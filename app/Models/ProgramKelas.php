<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramKelas extends Model
{
    protected $table = 'program_kelas';
    
    protected $fillable = [
        'nama',
        'icon',
        'deskripsi',
        'jadwal',
        'fitur',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'fitur' => 'array',
        'aktif' => 'boolean',
    ];

    public function scopeAktif($query)
    {
        return $query->where('aktif', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}
