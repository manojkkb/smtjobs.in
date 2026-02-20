<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\EmploymentType;
use App\Models\ExperienceRange;
use App\Models\Industry;
use App\Models\JobPostProfile;
use App\Models\Recruiter;

class JobPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'company_id',
        'recruiter_id',
        'industry_id',
        'category_id',
        'city_id',
        'employment_type_id',
        'experience_range_id',
        'min_salary',
        'max_salary',
        'is_remote',
        'is_featured',
        'is_active',
        'published_at',
        'expires_at',
    ];

    protected $casts = [
        'is_remote' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
        'min_salary' => 'integer',
        'max_salary' => 'integer',
    ];

    public function recruiter(): BelongsTo
    {
        return $this->belongsTo(Recruiter::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function employmentType(): BelongsTo
    {
        return $this->belongsTo(EmploymentType::class);
    }

    public function experienceRange(): BelongsTo
    {
        return $this->belongsTo(ExperienceRange::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(JobPostProfile::class);
    }
}
