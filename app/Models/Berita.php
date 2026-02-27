<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    protected $fillable = [
        'judul',
        'slug',
        'isi_berita',
        'gambar',
        'tanggal',
        'status',
        'kategori',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
        ];
    }

    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($berita) {
            if (empty($berita->slug)) {
                $berita->slug = Str::slug($berita->judul) . '-' . time();
            }
        });
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'Published');
    }

    public function scopeLatest($query)
    {
        return $query->orderBy('tanggal', 'desc');
    }
}
