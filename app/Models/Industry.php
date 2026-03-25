<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'label',
        'icon',
        'description',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function jobPosts()
    {
        return $this->hasMany(\App\Models\JobPost::class);
    }

    public function companies()
    {
        return $this->hasMany(\App\Models\Company::class);
    }

}
