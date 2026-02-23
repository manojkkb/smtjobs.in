<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CandidateCertification extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'certificate_id',
        'issued_at',
        'expires_at',
    ];

    protected $casts = [
        'issued_at' => 'date',
        'expires_at' => 'date',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }

    public function certificate()
    {
        return $this->belongsTo(Certificate::class);
    }
}
