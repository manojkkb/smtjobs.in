<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobRole extends Model
{
     use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // JobRole belongs to Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Through category → industry access
    public function industry()
    {
        return $this->hasOneThrough(
            Industry::class,
            Category::class,
            'id',          // Foreign key on categories
            'id',          // Foreign key on industries
            'category_id', // Local key on job_roles
            'industry_id'  // Local key on categories
        );
    }

    // Job posts using this role
    public function jobPosts()
    {
        return $this->hasMany(JobPost::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Query Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeSorted($query)
    {
        return $query->orderBy('sort_order');
    }
}
