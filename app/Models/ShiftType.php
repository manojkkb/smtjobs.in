<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftType extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'label',
        'start_time',
        'end_time',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

}
