<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'native_name',
        'iso_code',
        'is_rtl',
        'is_default',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_rtl' => 'boolean',
        'is_default' => 'boolean',
    ];

}
