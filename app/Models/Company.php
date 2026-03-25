<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'industry_id',
        'company_type_id',
        'company_size_id',
        'city_id',
        'is_verified',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
    ];

    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }

    public function companyType(): BelongsTo
    {
        return $this->belongsTo(CompanyType::class);
    }

    public function companySize(): BelongsTo
    {
        return $this->belongsTo(CompanySize::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function jobPosts(): HasMany
    {
        return $this->hasMany(JobPost::class);
    }
    
    public function profile(): HasOne
    {
        return $this->hasOne(CompanyProfile::class);
    }
    
    public function followers(): HasMany
    {
        return $this->hasMany(CompanyFollower::class);
    }
    
    public function reviews(): HasMany
    {
        return $this->hasMany(CompanyReview::class);
    }
    
    public function isFollowedBy($userId)
    {
        if (!$userId) return false;
        return $this->followers()->where('user_id', $userId)->exists();
    }
}
