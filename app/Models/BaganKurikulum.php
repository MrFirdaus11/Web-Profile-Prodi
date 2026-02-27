<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaganKurikulum extends Model
{
    use HasFactory;

    protected $fillable = [
        'angkatan',
        'link_bagan',
        'link_matkul',
        'urutan',
    ];

    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }
}
