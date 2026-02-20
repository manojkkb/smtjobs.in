<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalaryRange extends Model
{
    use HasFactory;

    protected $fillable = [
        'min_salary',
        'max_salary',
        'label',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

}
