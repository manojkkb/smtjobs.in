<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyReview extends Model
{
    // Status constants
    const STATUS_PENDING = 0;
    const STATUS_APPROVED = 1;
    const STATUS_REJECTED = 2;
    
    protected $fillable = [
        'company_id',
        'user_id',
        'rating',
        'interview_process_rating',
        'communication_rating',
        'salary_rating',
        'work_culture_rating',
        'pros',
        'cons',
        'review',
        'is_anonymous',
        'status',
    ];
    
    protected $casts = [
        'is_anonymous' => 'boolean',
    ];
    
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
