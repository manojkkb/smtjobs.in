<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'label',
        'channel',
        'is_system',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_system' => 'boolean',
    ];

}
