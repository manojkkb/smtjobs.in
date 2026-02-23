<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\City;
use App\Models\EmploymentType;
use App\Models\ExperienceRange;
use App\Models\Industry;
use App\Models\JobPost;
use App\Models\JobPostDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $perPage = min(max(6, (int) $request->input('per_page', 12)), 36);
        $keyword = trim((string) $request->input('keyword', ''));
        $location = trim((string) $request->input('location', ''));

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
            ->when($location !== '', function ($q) use ($location) {
                $pattern = '%' . Str::lower($location) . '%';
                return $q->where(function ($sub) use ($pattern) {
                    $sub->whereHas('city', function ($cityQuery) use ($pattern) {
                        $cityQuery->whereRaw('LOWER(name) LIKE ?', [$pattern]);
                    })
                    ->orWhereHas('company', function ($companyQuery) use ($pattern) {
                        $companyQuery->whereHas('city', function ($cityQuery) use ($pattern) {
                            $cityQuery->whereRaw('LOWER(name) LIKE ?', [$pattern]);
                        });
                    });
                });
            })
            ->when($industryIds = array_filter((array) $request->input('industry_id')), function ($q, $industryIds) {
                return $q->whereIn('industry_id', $industryIds);
            })
            ->when($categoryIds = array_filter((array) $request->input('category_id')), function ($q, $categoryIds) {
                return $q->whereIn('category_id', $categoryIds);
            })
            ->when($cityIds = array_filter((array) $request->input('city_id')), function ($q, $cityIds) {
                return $q->whereIn('city_id', $cityIds);
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
            ->orderByDesc('published_at');

        $jobPosts = $query
            ->paginate($perPage)
            ->withQueryString();

        $filterOptions = [
            'industries' => \App\Models\Industry::orderBy('label')->get(),
            'categories' => \App\Models\Category::orderBy('label')->get(),
            'cities' => \App\Models\City::orderBy('name')->get(),
            'employmentTypes' => \App\Models\EmploymentType::orderBy('label')->get(),
            'experienceRanges' => \App\Models\ExperienceRange::orderBy('label')->get(),
        ];

        $keywordOptions = JobPost::query()
            ->whereNotNull('title')
            ->where('title', '<>', '')
            ->select('title')
            ->distinct()
            ->orderBy('title')
            ->limit(50)
            ->pluck('title');

        $locationOptions = City::query()
            ->orderBy('name')
            ->pluck('name');

        return view('website.jobs', array_merge(
            compact('jobPosts'),
            $filterOptions,
            [
                'keywordOptions' => $keywordOptions,
                'locationOptions' => $locationOptions,
            ]
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
            $query = JobPost::query()
                ->whereNotNull('title')
                ->where('title', '<>', '');

            if ($term !== '') {
                $pattern = '%' . Str::lower($term) . '%';
                $query->whereRaw('LOWER(title) LIKE ?', [$pattern]);
            }

            $results = $query
                ->select('title')
                ->distinct()
                ->orderBy('title')
                ->limit(10)
                ->pluck('title')
                ->toArray();
        } elseif ($type === 'location') {
            $query = City::query();

            if ($term !== '') {
                $pattern = '%' . Str::lower($term) . '%';
                $query->whereRaw('LOWER(name) LIKE ?', [$pattern]);
            }

            $results = $query
                ->orderBy('name')
                ->limit(10)
                ->pluck('name')
                ->toArray();
        }

        return Response::json(['suggestions' => $results]);
    }
}
