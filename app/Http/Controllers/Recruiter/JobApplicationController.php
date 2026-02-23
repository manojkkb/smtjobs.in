<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobApplicationController extends Controller
{
    public function index(Request $request)
    {
        $perPage = 20;
        $search = trim($request->input('search', ''));
        $statusFilter = $request->input('status');
        
        // Get the authenticated recruiter's ID
        $recruiterId = Auth::user()->recruiter->id;
        
        // Query job applications for the recruiter's job posts
        $query = JobApplication::with([
            'candidate.user',
            'jobPost',
            'applicationStatus'
        ])
        ->whereHas('jobPost', function($q) use ($recruiterId) {
            $q->where('recruiter_id', $recruiterId);
        })
        ->when($search !== '', function($q) use ($search) {
            $pattern = '%' . strtolower($search) . '%';
            return $q->where(function($sub) use ($pattern) {
                $sub->whereHas('candidate.user', function($userQuery) use ($pattern) {
                    $userQuery->whereRaw('LOWER(name) LIKE ?', [$pattern])
                             ->orWhereRaw('LOWER(email) LIKE ?', [$pattern]);
                })
                ->orWhereHas('jobPost', function($jobQuery) use ($pattern) {
                    $jobQuery->whereRaw('LOWER(title) LIKE ?', [$pattern]);
                });
            });
        })
        ->when($statusFilter, function($q) use ($statusFilter) {
            return $q->whereHas('applicationStatus', function($statusQuery) use ($statusFilter) {
                $statusQuery->where('slug', $statusFilter);
            });
        })
        ->orderByDesc('applied_at');
        
        $applications = $query->paginate($perPage)->withQueryString();
        
        // Get all application statuses for filter dropdown
        $statuses = \App\Models\ApplicationStatus::where('is_active', true)
            ->orderBy('sort_order')
            ->get();
        
        return view('recruiter.job-applications.index', compact('applications', 'statuses'));
    }
}
