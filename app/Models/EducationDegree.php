<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducationDegree extends Model
{
    use HasFactory;
     protected $fillable = [
        'education_level_id',
        'slug',
        'label',
        'sort_order',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // Degree belongs to Education Level
    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }

    // Degree has many specializations
    public function specializations()
    {
        return $this->hasMany(EducationSpecialization::class);
    }

    // Degree used in candidate education
    public function candidateEducations()
    {
        return $this->hasMany(CandidateEducation::class);
    }
}
