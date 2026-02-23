<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\Recruiter;
use App\Models\ApplicationStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // Overall Statistics
        $totalCandidates = Candidate::count();
        $totalCompanies = Company::count();
        $totalRecruiters = Recruiter::count();
        $totalJobPosts = JobPost::count();
        $activeJobPosts = JobPost::where('job_status_id', function($query) {
            $query->select('id')
                ->from('job_statuses')
                ->where('slug', 'active')
                ->limit(1);
        })->count();
        $totalApplications = JobApplication::count();
        
        // Applications by Status
        $applicationsByStatus = JobApplication::select('application_statuses.label', 
            DB::raw('count(*) as count'))
            ->join('application_statuses', 'job_applications.application_status_id', '=', 'application_statuses.id')
            ->groupBy('application_statuses.id', 'application_statuses.label')
            ->orderBy('count', 'desc')
            ->get();
        
        // Recent Applications (last 10)
        $recentApplications = JobApplication::with([
            'candidate.user',
            'jobPost',
            'applicationStatus'
        ])
            ->latest()
            ->limit(10)
            ->get();
        
        // Recent Job Posts (last 10)
        $recentJobPosts = JobPost::with([
            'recruiter.user',
            'status'
        ])
            ->latest()
            ->limit(10)
            ->get();
        
        // Top Companies by Job Posts
        $topCompanies = Company::withCount('jobPosts')
            ->whereHas('jobPosts')
            ->orderBy('job_posts_count', 'desc')
            ->limit(5)
            ->get();
        
        // New Registrations (last 30 days)
        $newCandidatesThisMonth = Candidate::where('created_at', '>=', now()->subDays(30))->count();
        $newCompaniesThisMonth = Company::where('created_at', '>=', now()->subDays(30))->count();
        $newApplicationsThisMonth = JobApplication::where('created_at', '>=', now()->subDays(30))->count();
        
        return view('admin.dashboard.index', compact(
            'totalCandidates',
            'totalCompanies',
            'totalRecruiters',
            'totalJobPosts',
            'activeJobPosts',
            'totalApplications',
            'applicationsByStatus',
            'recentApplications',
            'recentJobPosts',
            'topCompanies',
            'newCandidatesThisMonth',
            'newCompaniesThisMonth',
            'newApplicationsThisMonth'
        ));
    }
}
