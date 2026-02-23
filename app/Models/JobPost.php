<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\EmploymentType;
use App\Models\ExperienceRange;
use App\Models\Industry;
use App\Models\JobPostProfile;
use App\Models\JobStatus;
use App\Models\Recruiter;
use Illuminate\Support\Facades\DB;

class JobPost extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "title",
        'company_id',
        'recruiter_id',
        'industry_id',
        'category_id',
        'city_id',
        'employment_type_id',
        'experience_range_id',
        'min_salary',
        'max_salary',
        'is_remote',
        'is_featured',
        'is_active',
        'job_status_id',
        'published_at',
        'expires_at',
    ];

    protected $casts = [
        'is_remote' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
        'min_salary' => 'integer',
        'max_salary' => 'integer',
    ];

    public function recruiter(): BelongsTo
    {
        return $this->belongsTo(Recruiter::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function employmentType(): BelongsTo
    {
        return $this->belongsTo(EmploymentType::class);
    }

    public function experienceRange(): BelongsTo
    {
        return $this->belongsTo(ExperienceRange::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(JobStatus::class, 'job_status_id');
    }

    public function detail(): HasOne
    {
        return $this->hasOne(JobPostDetail::class);
    }

    public function profile(): HasOne
    {
        return $this->hasOne(JobPostDetail::class);
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class);
    }
    public function activeApplications()
    {
        return $this->applications()->whereHas('applicationStatus', function($q) {
            $q->where('slug', '!=', 'rejected');
        }); 
    }
    public function rejectedApplications()
    {
        return $this->applications()->whereHas('applicationStatus', function($q) {
            $q->where('slug', 'rejected');
        }); 
    }
    public function pendingApplications()
    {
        return $this->applications()->whereHas('applicationStatus', function($q) {
            $q->where('slug', 'pending');
        }); 
    }
    public function shortlistedApplications()
    {
        return $this->applications()->whereHas('applicationStatus', function($q) {
            $q->where('slug', 'shortlisted');
        }); 
    }
    public function hiredApplications()
    {
        return $this->applications()->whereHas('applicationStatus', function($q) {
            $q->where('slug', 'hired');     
        });
    }
    public function cancelledApplications()
    {
        return $this->applications()->whereHas('applicationStatus', function($q) {
            $q->where('slug', 'cancelled');     
        });
    }
    public function rejectedApplicationsCount()
    {
        return $this->rejectedApplications()->count();
    }
    public function pendingApplicationsCount()
    {        return $this->pendingApplications()->count();
    }
    public function shortlistedApplicationsCount()
    {        return $this->shortlistedApplications()->count();
    }
    public function hiredApplicationsCount()        
    {        return $this->hiredApplications()->count();
    }
    public function cancelledApplicationsCount()
    {        return $this->cancelledApplications()->count();
    }   
    public function activeApplicationsCount()
    {        return $this->activeApplications()->count();
    }   
    public function totalApplicationsCount()
    {        return $this->applications()->count(); 
    }
    public function applicationStatusBreakdown()
    {
        return $this->applications()
            ->select('application_status_id', DB::raw('count(*) as count'))
            ->groupBy('application_status_id')
            ->with('applicationStatus')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item->applicationStatus->slug => $item->count];
            });
    }
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }
    public function scopeNotExpired($query)
    {
        return $query->where(function($q) {
            $q->whereNull('expires_at')
              ->orWhere('expires_at', '>', now());
        });
    }
    public function scopeVisible($query)
    {
        return $query->active()->published()->notExpired();
    }
    public function scopeFilter($query, $filters)
    {
        return $query->when($filters['search'] ?? null, function($q) use ($filters) {
            $pattern = '%' . strtolower($filters['search']) . '%';
            $q->whereRaw('LOWER(title) LIKE ?', [$pattern])
              ->orWhereHas('company', function($companyQuery) use ($pattern) {
                  $companyQuery->whereRaw('LOWER(name) LIKE ?', [$pattern]);
              })
              ->orWhereHas('recruiter.user', function($userQuery) use ($pattern) {
                  $userQuery->whereRaw('LOWER(name) LIKE ?', [$pattern])
                            ->orWhereRaw('LOWER(email) LIKE ?', [$pattern]);
              });
        })
        ->when($filters['industry_id'] ?? null, function($q) use ($filters) {
            $q->where('industry_id', $filters['industry_id']);
        })
        ->when($filters['category_id'] ?? null, function($q) use ($filters) {
            $q->where('category_id', $filters['category_id']);      
        })
        ->when($filters['city_id'] ?? null, function($q) use ($filters) {
            $q->where('city_id', $filters['city_id']);
        })
        ->when($filters['employment_type_id'] ?? null, function($q) use ($filters) {
            $q->where('employment_type_id', $filters['employment_type_id']);
        })
        ->when($filters['experience_range_id'] ?? null, function($q) use ($filters) {
            $q->where('experience_range_id', $filters['experience_range_id']);
        })      
        ->when(isset($filters['remote']), function($q) use ($filters) {
            if ($filters['remote']) {
                $q->where('is_remote', true);
            }
        }); 



    }

}
