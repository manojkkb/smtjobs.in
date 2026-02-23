<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CandidateEducation extends Model
{
    use HasFactory;
    protected $fillable = [
        'candidate_id',
        'education_level_id',
        'education_degree_id',
        'education_specialization_id',
        'institute_name',
        'board_university',
        'passing_year',
        'percentage',
        'cgpa',
        'cgpa_scale',
        'is_current',
    ];

    protected $casts = [
        'is_current' => 'boolean',
        'passing_year' => 'integer',
        'percentage' => 'float',
        'cgpa' => 'float',
        'cgpa_scale' => 'float',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function level()
    {
        return $this->belongsTo(EducationLevel::class, 'education_level_id');
    }

    public function degree()
    {
        return $this->belongsTo(EducationDegree::class, 'education_degree_id');
    }

    public function specialization()
    {
        return $this->belongsTo(EducationSpecialization::class, 'education_specialization_id');
    }

}
