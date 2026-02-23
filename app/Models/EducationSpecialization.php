<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EducationSpecialization extends Model
{
    use HasFactory;

    protected $fillable = [
        'education_degree_id',
        'slug',
        'label',
        'sort_order',
    ];

    public function degree()
    {
        return $this->belongsTo(EducationDegree::class, 'education_degree_id');
    }
}
