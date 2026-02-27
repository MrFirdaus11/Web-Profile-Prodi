<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = [
        'nama_dokumen',
        'url',
        'kategori',
        'tgl_upload',
    ];

    protected function casts(): array
    {
        return [
            'tgl_upload' => 'date',
        ];
    }
}
