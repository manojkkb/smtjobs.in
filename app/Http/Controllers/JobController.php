<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\EmploymentType;
use App\Models\ExperienceRange;
use App\Models\Industry;
use App\Models\JobPost;
use App\Models\JobPostDetail;
use App\Models\Skill;
use App\Models\JobRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $perPage = min(max(6, (int) $request->input('per_page', 12)), 36);
        $keyword = trim((string) $request->input('keyword', ''));

        $query = JobPost::with([
            'company',
            'detail',
            'city',
            'category',
            'industry',
            'employmentType',
            'experienceRange',
        ])
            ->where('is_active', true)
            ->where('job_status_id', 1)
            ->when($keyword !== '', function ($q) use ($keyword) {
                $pattern = '%' . Str::lower($keyword) . '%';
                return $q->where(function ($sub) use ($pattern) {
                    $sub->whereRaw('LOWER(title) LIKE ?', [$pattern])
                    ->orWhereHas('detail', function ($detailQuery) use ($pattern) {
                        $detailQuery->whereRaw('LOWER(description) LIKE ?', [$pattern]);
                    })
                    ->orWhereHas('company', function ($companyQuery) use ($pattern) {
                        $companyQuery->whereRaw('LOWER(name) LIKE ?', [$pattern]);
                    });
                });
            })
            ->when($request->filled('location'), function ($q) use ($request) {
                $location = $request->input('location');
                $pattern = '%' . Str::lower($location) . '%';
                return $q->whereHas('city', function ($cityQuery) use ($pattern) {
                    $cityQuery->whereRaw('LOWER(name) LIKE ?', [$pattern]);
                });
            })
            ->when($request->filled('city_id'), function ($q) use ($request) {
                return $q->where('city_id', $request->input('city_id'));
            })
            ->when($industryIds = array_filter((array) $request->input('industry_id')), function ($q, $industryIds) {
                return $q->whereIn('industry_id', $industryIds);
            })
            ->when($categoryIds = array_filter((array) $request->input('category_id')), function ($q, $categoryIds) {
                return $q->whereIn('category_id', $categoryIds);
            })
            ->when($employmentTypeIds = array_filter((array) $request->input('employment_type_id')), function ($q, $employmentTypeIds) {
                return $q->whereIn('employment_type_id', $employmentTypeIds);
            })
            ->when($experienceRangeIds = array_filter((array) $request->input('experience_range_id')), function ($q, $experienceRangeIds) {
                return $q->whereIn('experience_range_id', $experienceRangeIds);
            })
            ->when($request->boolean('remote'), function ($q) {
                return $q->where('is_remote', true);
            })
            ->when($filter = $request->input('filter'), function ($q) use ($filter) {
                return match ($filter) {
                    'remote' => $q->where('is_remote', true),
                    'fulltime' => $q->whereHas('employmentType', fn($query) => $query->where('label', 'Full Time')),
                    'parttime' => $q->whereHas('employmentType', fn($query) => $query->where('label', 'Part Time')),
                    'flexible' => $q->whereHas('employmentType', fn($query) => $query->where('label', 'Flexible Shift')),
                    default => $q,
                };
            })
            ->orderByDesc('published_at');

        $jobPosts = $query
            ->paginate($perPage)
            ->withQueryString();

        // Get cities with job counts
        $cities = City::where('is_active', true)
            ->withCount(['jobPosts' => function($query) {
                $query->where('is_active', true)
                    ->where('job_status_id', 1);
            }])
            ->whereHas('jobPosts', function($query) {
                $query->where('is_active', true)
                    ->where('job_status_id', 1);
            })
            ->orderBy('job_posts_count', 'desc')
            ->get(['id', 'name', 'slug']);

        // Get skills for keyword suggestions
        $skills = Skill::where('is_active', true)
            ->orderBy('sort_order')
            ->take(50)
            ->get(['id', 'label', 'slug']);

        // Get job roles for keyword suggestions
        $jobRoles = JobRole::where('is_active', true)
            ->orderBy('sort_order')
            ->take(50)
            ->get(['id', 'label', 'slug']);

        $filterOptions = [
            'industries' => Industry::orderBy('label')->get(),
            'categories' => Category::orderBy('label')->get(),
            'employmentTypes' => EmploymentType::orderBy('label')->get(),
            'experienceRanges' => ExperienceRange::orderBy('label')->get(),
        ];

        return view('website.jobs', array_merge(
            compact('jobPosts', 'cities', 'skills', 'jobRoles'),
            $filterOptions
        ));
    }

    public function show($id)
    {
        $jobPost = JobPost::with([
            'company',
            'profile',
            'city',
            'category',
            'industry',
            'employmentType',
            'experienceRange',
        ])->findOrFail($id);

        return view('website.job-details', ['jobPost' => $jobPost]);
    }

    public function suggestions(Request $request)
    {
        $type = $request->query('type');
        $term = trim($request->query('q', ''));

        $results = [];

        if ($type === 'keyword') {
            $pattern = '%' . Str::lower($term) . '%';
            $limit = 10;
            
            // Get job titles
            $jobTitles = JobPost::query()
                ->whereNotNull('title')
                ->where('title', '<>', '');
            
            if ($term !== '') {
                $jobTitles->whereRaw('LOWER(title) LIKE ?', [$pattern]);
            }
            
            $jobTitles = $jobTitles
                ->select('title as name')
                ->distinct()
                ->limit($limit)
                ->pluck('name')
                ->toArray();
            
            // Get skills
            $skills = [];
            if ($term !== '') {
                $skills = Skill::where('is_active', true)
                    ->whereRaw('LOWER(label) LIKE ?', [$pattern])
                    ->orderBy('sort_order')
                    ->limit($limit)
                    ->pluck('label')
                    ->toArray();
            }
            
            // Get job roles
            $jobRoles = [];
            if ($term !== '') {
                $jobRoles = JobRole::where('is_active', true)
                    ->whereRaw('LOWER(label) LIKE ?', [$pattern])
                    ->orderBy('sort_order')
                    ->limit($limit)
                    ->pluck('label')
                    ->toArray();
            }
            
            // Get company names
            $companies = [];
            if ($term !== '') {
                $companies = Company::where('is_active', true)
                    ->whereRaw('LOWER(name) LIKE ?', [$pattern])
                    ->limit($limit)
                    ->pluck('name')
                    ->toArray();
            }
            
            // Merge all results
            $allResults = array_merge($jobTitles, $skills, $jobRoles, $companies);
            
            // Remove duplicates and limit
            $results = array_values(array_unique($allResults));
            $results = array_slice($results, 0, $limit);
            
        } elseif ($type === 'location') {
            $pattern = '%' . Str::lower($term) . '%';
            
            // Get cities with job counts - prioritize cities with jobs
            $citiesWithJobs = City::where('is_active', true)
                ->when($term !== '', function($query) use ($pattern) {
                    $query->whereRaw('LOWER(name) LIKE ?', [$pattern]);
                })
                ->withCount(['jobPosts' => function($query) {
                    $query->where('is_active', true)
                        ->where('job_status_id', 1);
                }])               
                ->orderBy('job_posts_count', 'desc')
                ->limit(10)
                ->get(['id', 'name', 'job_posts_count']);
            
            // Format results with job counts
            $results = $citiesWithJobs->map(function($city) {
                if ($city->job_posts_count > 0) {
                    return $city->name . ' (' . $city->job_posts_count . ' jobs)';
                }
                return $city->name;
            })->toArray();
        }

        return Response::json(['suggestions' => $results]);
    }
}
