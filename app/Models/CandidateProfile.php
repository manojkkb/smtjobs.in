<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class CandidateProfile extends Model
{
    protected $fillable = [
        'candidate_id',
        'first_name',
        'last_name',
        'date_of_birth',
        'gender',
        'phone',
        'alternate_phone',
        'headline',
        'summary',
        'profile_photo',
        'resume_path',
        'is_profile_complete',
        'profile_completed_at',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_profile_complete' => 'boolean',
        'profile_completed_at' => 'datetime',
    ];

    public function candidate(): BelongsTo
    {
        return $this->belongsTo(Candidate::class);
    }

    /**
     * Get the full URL for the profile photo
     */
    public function getProfilePhotoUrlAttribute(): ?string
    {
        if (!$this->profile_photo) {
            return null;
        }

        // If it's already a full URL, return it
        if (str_starts_with($this->profile_photo, 'http')) {
            return $this->profile_photo;
        }

        // Otherwise, construct the S3 URL
        $bucket = config('filesystems.disks.s3.bucket');
        $region = config('filesystems.disks.s3.region');
        return "https://{$bucket}.s3.{$region}.amazonaws.com/{$this->profile_photo}";
    }
}
