@extends('recruiter.layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-4 sm:space-y-6">
        {{-- Header --}}
        <div class="px-1">
            <h1 class="text-xl sm:text-2xl font-semibold text-slate-900">Dashboard</h1>
            <p class="mt-1 sm:mt-2 text-xs sm:text-sm text-slate-600">Welcome back! Here's what's happening with your job postings.</p>
        </div>

        {{-- Quick Actions --}}
        <div class="rounded-xl sm:rounded-2xl bg-gradient-to-r from-blue-50 to-cyan-50 p-4 sm:p-6">
            <div class="flex flex-col gap-3 sm:gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex-1">
                    <h3 class="text-base sm:text-lg font-semibold text-slate-900">Ready to hire?</h3>
                    <p class="mt-1 text-xs sm:text-sm text-slate-600">Post a new job and start receiving applications from qualified candidates.</p>
                </div>
                <a href="{{ route('recruiter.job-posts.create') }}" class="inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-lg sm:rounded-xl bg-slate-900 px-4 sm:px-6 py-2.5 sm:py-3 text-sm font-semibold text-white hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-700 focus:ring-offset-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Create New Job Post
                </a>
            </div>
        </div>

        {{-- Statistics Cards --}}
        <div class="grid gap-4 sm:gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-4">
            {{-- Total Job Posts --}}
            <div class="rounded-xl sm:rounded-2xl bg-white p-4 sm:p-6">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="text-xs sm:text-sm font-medium text-slate-600">Total Job Posts</p>
                        <p class="mt-1 sm:mt-2 text-2xl sm:text-3xl font-bold text-slate-900">{{ $totalJobPosts }}</p>
                        <p class="mt-1 sm:mt-2 text-xs text-slate-500">
                            <span class="text-emerald-600 font-semibold">{{ $activeJobPosts }}</span> active
                            <span class="mx-1">•</span>
                            <span class="text-slate-400">{{ $inactiveJobPosts }}</span> inactive
                        </p>
                    </div>
                    <div class="flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-full bg-blue-100 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Total Applications --}}
            <div class="rounded-xl sm:rounded-2xl bg-white p-4 sm:p-6">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="text-xs sm:text-sm font-medium text-slate-600">Total Applications</p>
                        <p class="mt-1 sm:mt-2 text-2xl sm:text-3xl font-bold text-slate-900">{{ $totalApplications }}</p>
                        <p class="mt-1 sm:mt-2 text-xs text-emerald-600 font-semibold">
                            +{{ $newApplications }} this week
                        </p>
                    </div>
                    <div class="flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-full bg-emerald-100 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Pending Applications --}}
            <div class="rounded-xl sm:rounded-2xl bg-white p-4 sm:p-6">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="text-xs sm:text-sm font-medium text-slate-600">Pending Review</p>
                        <p class="mt-1 sm:mt-2 text-2xl sm:text-3xl font-bold text-slate-900">{{ $applicationsByStatus['pending'] ?? 0 }}</p>
                        <p class="mt-1 sm:mt-2 text-xs text-slate-500">
                            Need your attention
                        </p>
                    </div>
                    <div class="flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-full bg-yellow-100 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Shortlisted --}}
            <div class="rounded-xl sm:rounded-2xl bg-white p-4 sm:p-6">
                <div class="flex items-center justify-between">
                    <div class="flex-1">
                        <p class="text-xs sm:text-sm font-medium text-slate-600">Shortlisted</p>
                        <p class="mt-1 sm:mt-2 text-2xl sm:text-3xl font-bold text-slate-900">{{ $applicationsByStatus['shortlisted'] ?? 0 }}</p>
                        <p class="mt-1 sm:mt-2 text-xs text-slate-500">
                            Top candidates
                        </p>
                    </div>
                    <div class="flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-full bg-purple-100 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Two Column Layout --}}
        <div class="grid gap-4 sm:gap-6 grid-cols-1 lg:grid-cols-2">
            {{-- Recent Applications --}}
            <div class="rounded-xl sm:rounded-2xl bg-white">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 px-4 sm:px-6 py-3 sm:py-4">
                    <div>
                        <h2 class="text-base sm:text-lg font-semibold text-slate-900">Recent Applications</h2>
                        <p class="text-xs sm:text-sm text-slate-600">Latest candidates who applied</p>
                    </div>
                    <a href="{{ route('recruiter.job-applications') }}" class="text-xs sm:text-sm font-semibold text-blue-600 hover:text-blue-700 whitespace-nowrap">
                        View all →
                    </a>
                </div>
                <div class="">
                    @forelse($recentApplications as $application)
                        <div class="px-4 sm:px-6 py-3 sm:py-4 hover:bg-slate-50 transition-colors">
                            <div class="flex items-start gap-2 sm:gap-3">
                                <div class="flex-shrink-0">
                                    <div class="flex h-8 w-8 sm:h-10 sm:w-10 items-center justify-center rounded-full bg-slate-200 text-slate-600 text-xs sm:text-sm font-semibold">
                                        {{ strtoupper(substr($application->candidate->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-1 sm:gap-2">
                                        <p class="text-xs sm:text-sm font-semibold text-slate-900 truncate">
                                            {{ $application->candidate->user->name ?? 'Unknown' }}
                                        </p>
                                        <span class="inline-flex items-center rounded-full px-1.5 sm:px-2 py-0.5 text-xs font-medium
                                            @if($application->applicationStatus->slug === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($application->applicationStatus->slug === 'reviewing') bg-blue-100 text-blue-800
                                            @elseif($application->applicationStatus->slug === 'shortlisted') bg-green-100 text-green-800
                                            @elseif($application->applicationStatus->slug === 'rejected') bg-red-100 text-red-800
                                            @else bg-slate-100 text-slate-800
                                            @endif">
                                            {{ ucfirst($application->applicationStatus->slug) }}
                                        </span>
                                    </div>
                                    <p class="mt-0.5 sm:mt-1 text-xs text-slate-600 truncate">
                                        {{ $application->jobPost->title }}
                                    </p>
                                    <p class="mt-0.5 sm:mt-1 text-xs text-slate-500">
                                        {{ $application->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="px-4 sm:px-6 py-6 sm:py-8 text-center text-xs sm:text-sm text-slate-500">
                            No applications yet
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Recent Job Posts --}}
            <div class="rounded-xl sm:rounded-2xl bg-white">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 px-4 sm:px-6 py-3 sm:py-4">
                    <div>
                        <h2 class="text-base sm:text-lg font-semibold text-slate-900">Recent Job Posts</h2>
                        <p class="text-xs sm:text-sm text-slate-600">Your latest openings</p>
                    </div>
                    <a href="{{ route('recruiter.job-posts.index') }}" class="text-xs sm:text-sm font-semibold text-blue-600 hover:text-blue-700 whitespace-nowrap">
                        View all →
                    </a>
                </div>
                <div class="">
                    @forelse($recentJobPosts as $job)
                        <div class="px-4 sm:px-6 py-3 sm:py-4 hover:bg-slate-50 transition-colors">
                            <div class="flex items-start justify-between gap-2 sm:gap-3">
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-1 sm:gap-2">
                                        <p class="text-xs sm:text-sm font-semibold text-slate-900 truncate">
                                            {{ $job->title }}
                                        </p>
                                        <span class="inline-flex items-center rounded-full px-1.5 sm:px-2 py-0.5 text-xs font-medium {{ $job->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-500' }}">
                                            {{ $job->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                    <p class="mt-0.5 sm:mt-1 text-xs text-slate-600 truncate">
                                        {{ optional($job->category)->label ?? 'General' }} • 
                                        {{ optional($job->city)->name ?? 'Remote' }} • 
                                        {{ optional($job->employmentType)->label ?? 'N/A' }}
                                    </p>
                                    <p class="mt-0.5 sm:mt-1 text-xs text-slate-500">
                                        Posted {{ $job->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <a href="{{ route('recruiter.job-posts.show', $job) }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700 flex-shrink-0">
                                    View
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="px-4 sm:px-6 py-6 sm:py-8 text-center text-xs sm:text-sm text-slate-500">
                            No job posts yet
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Top Performing Jobs --}}
        @if($topJobs->isNotEmpty())
            <div class="rounded-xl sm:rounded-2xl bg-white">
                <div class="px-4 sm:px-6 py-3 sm:py-4">
                    <h2 class="text-base sm:text-lg font-semibold text-slate-900">Top Performing Jobs</h2>
                    <p class="text-xs sm:text-sm text-slate-600">Jobs with most applications</p>
                </div>
                
                {{-- Mobile Card View --}}
                <div class="lg:hidden">
                    @foreach($topJobs as $job)
                        <div class="px-4 py-3 hover:bg-slate-50 transition-colors">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <p class="text-sm font-semibold text-slate-900">{{ $job->title }}</p>
                                        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-medium {{ $job->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-500' }}">
                                            {{ $job->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </div>
                                    <p class="mt-1 text-xs text-slate-500">{{ optional($job->category)->label ?? 'General' }}</p>
                                    <div class="mt-2 flex items-center gap-4 text-xs text-slate-600">
                                        <span>📍 {{ optional($job->city)->name ?? 'Remote' }}</span>
                                        <span class="font-semibold text-slate-900">{{ $job->applications_count }} candidates</span>
                                    </div>
                                </div>
                                <a href="{{ route('recruiter.job-posts.show', $job) }}" class="text-xs font-semibold text-blue-600 hover:text-blue-700 flex-shrink-0">
                                    View
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Desktop Table View --}}
                <div class="hidden lg:block overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Job Title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Location</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Applications</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-slate-500">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white">
                            @foreach($topJobs as $job)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-semibold text-slate-900">{{ $job->title }}</div>
                                        <div class="text-xs text-slate-500">{{ optional($job->category)->label ?? 'General' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-slate-900">{{ optional($job->city)->name ?? 'Remote' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <span class="text-sm font-semibold text-slate-900">{{ $job->applications_count }}</span>
                                            <span class="ml-2 text-xs text-slate-500">candidates</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium {{ $job->is_active ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-500' }}">
                                            {{ $job->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <a href="{{ route('recruiter.job-posts.show', $job) }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
@endsection