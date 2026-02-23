<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CandidateLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'language_id',
        'proficiency',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function language()
    {
        return $this->belongsTo(Language::class);
    }
}
