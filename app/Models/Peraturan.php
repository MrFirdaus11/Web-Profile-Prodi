<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peraturan extends Model
{
    protected $fillable = [
        'judul',
        'kategori',
        'file',
        'deskripsi',
        'download_count',
    ];

    public function incrementDownload()
    {
        $this->increment('download_count');
    }

    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }
}
