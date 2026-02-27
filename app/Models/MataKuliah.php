<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataKuliah extends Model
{
    use HasFactory;

    protected $fillable = [
        'semester',
        'kode',
        'nama',
        'sks',
        'file_rps',
        'urutan',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }

    public function scopeBySemester($query, $semester)
    {
        return $query->where('semester', $semester);
    }
}
