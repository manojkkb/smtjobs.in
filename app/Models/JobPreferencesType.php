<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPreferencesType extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'label',
        'input_type',
        'is_multiple',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_multiple' => 'boolean',
    ];

}
