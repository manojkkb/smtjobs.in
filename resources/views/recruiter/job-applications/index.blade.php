@extends('recruiter.layouts.app')

@section('title', 'Job Applications')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Job Applications</h1>
        <p class="mt-2 text-sm text-slate-600">Review and manage applications from candidates</p>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 px-6 py-4">
            <form method="GET" action="{{ route('recruiter.job-applications') }}">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div class="flex items-center gap-3">
                        <input
                            type="text"
                            name="search"
                            placeholder="Search applications..."
                            value="{{ request('search') }}"
                            class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none sm:w-64"
                        />
                    </div>
                    <div class="flex gap-3">
                        <select name="status" class="rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none" onchange="this.form.submit()">
                            <option value="">All Status</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->slug }}" {{ request('status') === $status->slug ? 'selected' : '' }}>
                                    {{ ucfirst($status->slug) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse($applications as $application)
                <div class="px-6 py-4 hover:bg-slate-50 transition-colors">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex-1">
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-slate-200 text-slate-600 font-semibold text-lg">
                                        {{ strtoupper(substr($application->candidate->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center gap-2">
                                        <h3 class="text-base font-semibold text-slate-900 truncate">
                                            {{ $application->candidate->user->name ?? 'Unknown' }}
                                        </h3>
                                        <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium
                                            @if($application->applicationStatus->slug === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($application->applicationStatus->slug === 'reviewing') bg-blue-100 text-blue-800
                                            @elseif($application->applicationStatus->slug === 'shortlisted') bg-green-100 text-green-800
                                            @elseif($application->applicationStatus->slug === 'rejected') bg-red-100 text-red-800
                                            @else bg-slate-100 text-slate-800
                                            @endif">
                                            {{ ucfirst($application->applicationStatus->slug) }}
                                        </span>
                                    </div>
                                    <p class="mt-1 text-sm text-slate-600">
                                        Applied for: <span class="font-medium">{{ $application->jobPost->title }}</span>
                                    </p>
                                    <p class="mt-1 text-xs text-slate-500">
                                        {{ $application->candidate->user->email ?? 'No email' }} • 
                                        Applied {{ $application->applied_at?->diffForHumans() ?? $application->created_at->diffForHumans() }}
                                    </p>
                                    @if($application->cover_letter)
                                        <p class="mt-2 text-sm text-slate-600 line-clamp-2">
                                            {{ Str::limit($application->cover_letter, 150) }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-2 flex-shrink-0">
                            <a href="#" class="inline-flex items-center justify-center rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-4 text-sm font-semibold text-slate-900">No applications found</h3>
                    <p class="mt-2 text-sm text-slate-500">
                        @if(request('search') || request('status'))
                            Try adjusting your search or filter criteria.
                        @else
                            Applications will appear here once candidates start applying to your job posts.
                        @endif
                    </p>
                    @if(request('search') || request('status'))
                        <a href="{{ route('recruiter.job-applications') }}" class="mt-4 inline-flex items-center text-sm font-medium text-slate-600 hover:text-slate-900">
                            Clear filters
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        @if($applications->hasPages())
            <div class="border-t border-slate-200 px-6 py-4">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
@endsection
