<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceRange extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'min_years',
        'max_years',
        'label',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }
    public function jobs()
    {
        return $this->hasMany(JobPost::class);
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

}
