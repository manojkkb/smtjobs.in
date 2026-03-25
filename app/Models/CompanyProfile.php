<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $fillable = [
        'company_id',
        'description',
        'website',
        'cover_image',
        'email',
        'phone',
        'founded_year',
        'headquarters',
        'employee_count',
        'average_rating',
        'review_count',
        'followers_count',
        'job_post_count',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
