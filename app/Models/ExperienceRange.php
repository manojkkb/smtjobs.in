<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceRange extends Model
{
    use HasFactory;

    protected $fillable = [
        'min_years',
        'max_years',
        'label',
        'priority',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

}
