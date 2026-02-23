@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <header>
        <p class="text-xs uppercase tracking-[0.5em] text-slate-500">Admin</p>
        <h1 class="text-2xl font-semibold text-slate-900">Dashboard</h1>
        <p class="text-sm text-slate-500">Overview of your recruitment platform statistics and activity</p>
    </header>

    <!-- Main Statistics Cards -->
    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
        <!-- Total Candidates -->
        <div class="rounded-2xl bg-white p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase tracking-wider text-slate-400">Total Candidates</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($totalCandidates) }}</p>
                    <p class="mt-1 text-xs text-slate-500">+{{ number_format($newCandidatesThisMonth) }} this month</p>
                </div>
                <div class="rounded-xl bg-blue-50 p-3">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Companies -->
        <div class="rounded-2xl bg-white p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase tracking-wider text-slate-400">Total Companies</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($totalCompanies) }}</p>
                    <p class="mt-1 text-xs text-slate-500">+{{ number_format($newCompaniesThisMonth) }} this month</p>
                </div>
                <div class="rounded-xl bg-purple-50 p-3">
                    <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Recruiters -->
        <div class="rounded-2xl bg-white p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase tracking-wider text-slate-400">Total Recruiters</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($totalRecruiters) }}</p>
                    <p class="mt-1 text-xs text-slate-500">Active accounts</p>
                </div>
                <div class="rounded-xl bg-green-50 p-3">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Job Posts -->
        <div class="rounded-2xl bg-white p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase tracking-wider text-slate-400">Total Job Posts</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($totalJobPosts) }}</p>
                    <p class="mt-1 text-xs text-slate-500">{{ number_format($activeJobPosts) }} active</p>
                </div>
                <div class="rounded-xl bg-orange-50 p-3">
                    <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Applications -->
        <div class="rounded-2xl bg-white p-6">
            <div class="flex items-start justify-between">
                <div>
                    <p class="text-xs uppercase tracking-wider text-slate-400">Total Applications</p>
                    <p class="mt-2 text-3xl font-bold text-slate-900">{{ number_format($totalApplications) }}</p>
                    <p class="mt-1 text-xs text-slate-500">+{{ number_format($newApplicationsThisMonth) }} this month</p>
                </div>
                <div class="rounded-xl bg-rose-50 p-3">
                    <svg class="h-6 w-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Applications by Status Overview -->
        <div class="rounded-2xl bg-white p-6">
            <div>
                <p class="text-xs uppercase tracking-wider text-slate-400">Application Status</p>
                @if($applicationsByStatus->isNotEmpty())
                    <div class="mt-3 space-y-2">
                        @foreach($applicationsByStatus->take(3) as $status)
                            <div class="flex items-center justify-between">
                                <span class="text-xs text-slate-600">{{ $status->label }}</span>
                                <span class="text-sm font-semibold text-slate-900">{{ number_format($status->count) }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="mt-2 text-sm text-slate-500">No applications yet</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Two Column Layout -->
    <div class="grid gap-6 lg:grid-cols-2">
        <!-- Recent Applications -->
        <section class="rounded-2xl bg-white p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Recent Applications</h2>
                <a href="{{ route('admin.candidates.index') }}" class="text-xs font-medium text-slate-600 hover:text-slate-900">View All →</a>
            </div>

            <div class="space-y-3">
                @forelse($recentApplications as $application)
                    <div class="flex items-start justify-between rounded-xl bg-slate-50 p-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-900 truncate">
                                {{ $application->candidate->user->name ?? 'N/A' }}
                            </p>
                            <p class="text-xs text-slate-600 truncate">
                                {{ $application->jobPost->title ?? 'N/A' }}
                            </p>
                            <p class="text-xs text-slate-400 mt-1">
                                {{ $application->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <span class="ml-2 rounded-full px-2 py-1 text-xs font-medium whitespace-nowrap
                            {{ optional($application->applicationStatus)->slug === 'pending' ? 'bg-yellow-100 text-yellow-700' : '' }}
                            {{ optional($application->applicationStatus)->slug === 'shortlisted' ? 'bg-blue-100 text-blue-700' : '' }}
                            {{ optional($application->applicationStatus)->slug === 'hired' ? 'bg-green-100 text-green-700' : '' }}
                            {{ optional($application->applicationStatus)->slug === 'rejected' ? 'bg-red-100 text-red-700' : '' }}
                            {{ !in_array(optional($application->applicationStatus)->slug, ['pending', 'shortlisted', 'hired', 'rejected']) ? 'bg-slate-100 text-slate-700' : '' }}">
                            {{ optional($application->applicationStatus)->label ?? 'N/A' }}
                        </span>
                    </div>
                @empty
                    <p class="text-center text-sm text-slate-500 py-8">No applications yet</p>
                @endforelse
            </div>
        </section>

        <!-- Recent Job Posts -->
        <section class="rounded-2xl bg-white p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg font-semibold text-slate-900">Recent Job Posts</h2>
                <a href="{{ route('admin.candidates.index') }}" class="text-xs font-medium text-slate-600 hover:text-slate-900">View All →</a>
            </div>

            <div class="space-y-3">
                @forelse($recentJobPosts as $jobPost)
                    <div class="flex items-start justify-between rounded-xl bg-slate-50 p-3">
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-slate-900 truncate">
                                {{ $jobPost->title }}
                            </p>
                            <p class="text-xs text-slate-600 truncate">
                                {{ $jobPost->recruiter->user->name ?? 'N/A' }}
                            </p>
                            <p class="text-xs text-slate-400 mt-1">
                                {{ $jobPost->created_at->diffForHumans() }}
                            </p>
                        </div>
                        <span class="ml-2 rounded-full px-2 py-1 text-xs font-medium whitespace-nowrap
                            {{ optional($jobPost->status)->slug === 'active' ? 'bg-green-100 text-green-700' : '' }}
                            {{ optional($jobPost->status)->slug === 'closed' ? 'bg-red-100 text-red-700' : '' }}
                            {{ optional($jobPost->status)->slug === 'draft' ? 'bg-slate-100 text-slate-700' : '' }}
                            {{ !in_array(optional($jobPost->status)->slug, ['active', 'closed', 'draft']) ? 'bg-slate-100 text-slate-700' : '' }}">
                            {{ optional($jobPost->status)->label ?? 'N/A' }}
                        </span>
                    </div>
                @empty
                    <p class="text-center text-sm text-slate-500 py-8">No job posts yet</p>
                @endforelse
            </div>
        </section>
    </div>

    <!-- Top Companies Table -->
    @if($topCompanies->isNotEmpty())
    <section class="rounded-2xl bg-white p-6">
        <h2 class="mb-4 text-lg font-semibold text-slate-900">Top Companies by Job Posts</h2>
        
        <!-- Desktop Table -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="pb-3 text-left text-xs uppercase tracking-wider text-slate-400">Company</th>
                        <th class="pb-3 text-center text-xs uppercase tracking-wider text-slate-400">Job Posts</th>
                        <th class="pb-3 text-right text-xs uppercase tracking-wider text-slate-400">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($topCompanies as $company)
                        <tr>
                            <td class="py-3 text-sm font-medium text-slate-900">{{ $company->name }}</td>
                            <td class="py-3 text-center text-sm font-semibold text-slate-900">{{ $company->job_posts_count }}</td>
                            <td class="py-3 text-right">
                                <a href="{{ route('admin.companies.show', $company) }}" class="text-xs font-medium text-slate-600 hover:text-slate-900">View →</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="sm:hidden space-y-3">
            @foreach($topCompanies as $company)
                <div class="rounded-xl bg-slate-50 p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-slate-900">{{ $company->name }}</p>
                            <p class="text-xs text-slate-600 mt-1">{{ $company->job_posts_count }} job posts</p>
                        </div>
                        <a href="{{ route('admin.companies.show', $company) }}" class="text-xs font-medium text-slate-600 hover:text-slate-900">View →</a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
