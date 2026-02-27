<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $primaryKey = 'id_admin';
    
    protected $fillable = [
        'username',
        'password',
        'nama_lengkap',
        'last_login',
    ];

    protected $hidden = [
        'password',
    ];

    protected function casts(): array
    {
        return [
            'last_login' => 'datetime',
        ];
    }
}
