<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\JobPost;

class JobPostDetail extends Model
{
    protected $fillable = [
        'job_post_id',        
        'description',
        'requirements',
        'responsibilities',
    ];

    public function jobPost(): BelongsTo
    {
        return $this->belongsTo(JobPost::class);
    }
}
