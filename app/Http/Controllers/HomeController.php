<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Skill;
use App\Models\JobRole;
use App\Models\JobPost;
use App\Models\Company;

class HomeController extends Controller
{
    public function index()
    {
        // Get cities with job counts
        $cities = City::where('is_active', true)
            ->withCount(['jobPosts' => function($query) {
                $query->where('is_active', true)
                    ->where('job_status_id', 1); // Published status
            }])
            ->whereHas('jobPosts', function($query) {
                $query->where('is_active', true)
                    ->where('job_status_id', 1);
            })
            ->orderBy('job_posts_count', 'desc')
            ->take(20)
            ->get(['id', 'name', 'slug']);

        // Get popular skills for keyword suggestions
        $skills = Skill::where('is_active', true)
            ->orderBy('sort_order')
            ->take(50)
            ->get(['id', 'label', 'slug']);

        // Get job roles for keyword suggestions
        $jobRoles = JobRole::where('is_active', true)
            ->orderBy('sort_order')
            ->take(50)
            ->get(['id', 'label', 'slug']);

        // Get statistics
        $stats = [
            'total_jobs' => JobPost::where('is_active', true)
                ->where('job_status_id', 1)
                ->count(),
            'total_companies' => Company::where('is_active', true)->count(),
            'total_cities' => City::where('is_active', true)
                ->whereHas('jobPosts', function($query) {
                    $query->where('is_active', true);
                })
                ->count(),
        ];

        // Get trending/featured jobs
        $trendingJobs = JobPost::with([
            'company:id,name,slug',
            'city:id,name',
            'employmentType:id,label',
            'detail:job_post_id,description'
        ])
        ->where('is_active', true)
        ->where('job_status_id', 1)
        ->where(function($query) {
            $query->where('is_featured', true)
                ->orWhere('published_at', '>=', now()->subDays(7));
        })
        ->orderByDesc('is_featured')
        ->orderByDesc('published_at')
        ->take(4)
        ->get();

        // Get top cities with job counts
        $topCities = City::where('is_active', true)
            ->withCount(['jobPosts' => function($query) {
                $query->where('is_active', true)
                    ->where('job_status_id', 1);
            }])
            ->whereHas('jobPosts', function($query) {
                $query->where('is_active', true)
                    ->where('job_status_id', 1);
            })
            ->orderBy('job_posts_count', 'desc')
            ->take(4)
            ->get(['id', 'name', 'slug']);

        // Quick filters
        $quickFilters = [
            ['label' => 'Remote-first', 'value' => 'remote', 'count' => JobPost::where('is_remote', true)->where('is_active', true)->where('job_status_id', 1)->count()],
            ['label' => 'Full-time', 'value' => 'fulltime', 'count' => JobPost::whereHas('employmentType', fn($q) => $q->where('label', 'Full Time'))->where('is_active', true)->where('job_status_id', 1)->count()],
            ['label' => 'Part-time', 'value' => 'parttime', 'count' => JobPost::whereHas('employmentType', fn($q) => $q->where('label', 'Part Time'))->where('is_active', true)->where('job_status_id', 1)->count()],
            ['label' => 'Flexible hours', 'value' => 'flexible', 'count' => JobPost::whereHas('employmentType', fn($q) => $q->where('label', 'Flexible Shift'))->where('is_active', true)->where('job_status_id', 1)->count()],
        ];

        return view('website.home', compact(
            'cities',
            'skills',
            'jobRoles',
            'stats',
            'trendingJobs',
            'topCities',
            'quickFilters'
        ));
    }
}
