<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteContent extends Model
{
    protected $fillable = ['key', 'label', 'section', 'type', 'value', 'placeholder'];

    public static function get(string $key, string $default = ''): string
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function allKeyed(): array
    {
        return static::all()->pluck('value', 'key')->toArray();
    }
}
