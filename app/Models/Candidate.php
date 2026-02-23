<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'city_id',
        'experience_range_id',
        'notice_period_id',
        'total_experience_years',
        'expected_salary',
        'open_to_work',
        'last_active_at',
    ];

    protected $casts = [
        'open_to_work' => 'boolean',
        'last_active_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function experienceRange(): BelongsTo
    {
        return $this->belongsTo(ExperienceRange::class);
    }

    public function noticePeriod(): BelongsTo
    {
        return $this->belongsTo(NoticePeriod::class);
    }

    public function profile()
    {
        return $this->hasOne(CandidateProfile::class);
    }

    public function education()
    {
        return $this->hasMany(CandidateEducation::class);
    }

    public function experiences()
    {
        return $this->hasMany(CandidateExperience::class);
    }

    public function skills()
    {
        return $this->hasMany(CandidateSkill::class);
    }

    public function languages()
    {
        return $this->hasMany(CandidateLanguage::class);
    }

    public function certifications()
    {
        return $this->hasMany(CandidateCertification::class);
    }
}