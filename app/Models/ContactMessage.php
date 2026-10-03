<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'subject',
        'topic',
        'message',
        'additional_data',
        'is_read',
    ];

    protected function casts(): array
    {
        return [
            'additional_data' => 'array',
            'is_read' => 'boolean',
        ];
    }
}
