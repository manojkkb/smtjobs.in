<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\ApplicationStatus;
use App\Models\JobApplication;
use App\Models\JobPost;
use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $recruiter = $this->currentRecruiter();
        
        // Get job post statistics
        $totalJobPosts = JobPost::where('recruiter_id', $recruiter->id)->count();
        $activeJobPosts = JobPost::where('recruiter_id', $recruiter->id)
            ->where('is_active', true)
            ->count();
        $inactiveJobPosts = $totalJobPosts - $activeJobPosts;
        
        // Get application statistics
        $totalApplications = JobApplication::whereHas('jobPost', function($q) use ($recruiter) {
            $q->where('recruiter_id', $recruiter->id);
        })->count();
        
        $newApplications = JobApplication::whereHas('jobPost', function($q) use ($recruiter) {
            $q->where('recruiter_id', $recruiter->id);
        })->where('created_at', '>=', now()->subDays(7))->count();
        
        // Application breakdown by status
        $applicationsByStatus = JobApplication::select('application_status_id', DB::raw('count(*) as count'))
            ->whereHas('jobPost', function($q) use ($recruiter) {
                $q->where('recruiter_id', $recruiter->id);
            })
            ->groupBy('application_status_id')
            ->with('applicationStatus')
            ->get()
            ->mapWithKeys(function($item) {
                return [$item->applicationStatus->slug => $item->count];
            });
        
        // Recent applications (last 5)
        $recentApplications = JobApplication::with([
            'candidate.user',
            'jobPost',
            'applicationStatus'
        ])
        ->whereHas('jobPost', function($q) use ($recruiter) {
            $q->where('recruiter_id', $recruiter->id);
        })
        ->orderByDesc('created_at')
        ->limit(5)
        ->get();
        
        // Recent job posts (last 5)
        $recentJobPosts = JobPost::with(['category', 'city', 'employmentType'])
            ->where('recruiter_id', $recruiter->id)
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();
        
        // Top performing jobs (by application count)
        $topJobs = JobPost::withCount('applications')
            ->where('recruiter_id', $recruiter->id)
            ->where('is_active', true)
            ->orderByDesc('applications_count')
            ->limit(5)
            ->get();
        
        return view('recruiter.dashboard.index', compact(
            'totalJobPosts',
            'activeJobPosts',
            'inactiveJobPosts',
            'totalApplications',
            'newApplications',
            'applicationsByStatus',
            'recentApplications',
            'recentJobPosts',
            'topJobs'
        ));
    }
    
    protected function currentRecruiter(): Recruiter
    {
        $recruiter = Recruiter::where('user_id', Auth::id())->first();
        
        if (!$recruiter) {
            abort(403, 'You need to complete your recruiter profile first.');
        }
        
        return $recruiter;
    }
}
