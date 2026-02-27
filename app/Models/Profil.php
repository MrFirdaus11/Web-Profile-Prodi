<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profil extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function getValue($key, $default = '')
    {
        $profil = self::where('key', $key)->first();
        return $profil ? $profil->value : $default;
    }

    public static function setValue($key, $value)
    {
        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}
