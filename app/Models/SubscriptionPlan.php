<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'job_credits',
        'database_credits',
        'ai_agent_credits',
        'validity_days',
        'price',
        'is_active',
    ];

    protected $casts = [
        'job_credits' => 'integer',
        'database_credits' => 'integer',
        'ai_agent_credits' => 'integer',
        'validity_days' => 'integer',
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];
}