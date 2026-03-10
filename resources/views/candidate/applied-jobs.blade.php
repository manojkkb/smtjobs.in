@extends('candidate.layouts.app')

@section('title', 'Applied Jobs · SMTJobs')

@section('content')
    <div class="mx-auto max-w-7xl px-3 sm:px-4 md:px-6 lg:px-8 pt-4 md:pt-20 lg:pt-24 pb-20 md:pb-8">
        <div class="mb-4 sm:mb-6 md:mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-900">Applied Jobs</h1>
            <p class="text-slate-600 mt-1 sm:mt-2 text-sm sm:text-base">Track your job applications and their status</p>
        </div>

        @if($applications->isEmpty())
            <div class="rounded-xl sm:rounded-2xl border border-slate-200 bg-white p-8 sm:p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 sm:h-16 sm:w-16 mx-auto text-slate-300 mb-3 sm:mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <h3 class="text-lg sm:text-xl font-semibold text-slate-900 mb-1 sm:mb-2">No applications yet</h3>
                <p class="text-slate-600 mb-4 sm:mb-6 text-sm sm:text-base">Start applying to jobs to see them here</p>
                <a href="{{ route('jobs') }}" class="inline-flex items-center gap-2 rounded-lg sm:rounded-xl bg-slate-900 px-4 sm:px-6 py-2 sm:py-3 text-xs sm:text-sm font-semibold text-white transition hover:bg-black">
                    Browse Jobs
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        @else
            <div class="space-y-3 sm:space-y-4">
                @foreach($applications as $application)
                    <div class="rounded-xl sm:rounded-2xl border border-slate-200 bg-white p-4 sm:p-6 transition hover:shadow-lg">
                        <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 sm:gap-4">
                            <div class="flex-1">
                                <div class="flex flex-col sm:flex-row sm:items-center gap-2 sm:gap-3 mb-2">
                                    <h3 class="text-lg sm:text-xl font-semibold text-slate-900">
                                        {{ $application->jobPost->title }}
                                    </h3>
                                    <span class="inline-flex items-center rounded-full px-2.5 sm:px-3 py-1 text-[10px] sm:text-xs font-semibold w-fit
                                        {{ $application->applicationStatus->slug === 'pending' ? 'bg-slate-100 text-slate-800' : '' }}
                                        {{ $application->applicationStatus->slug === 'reviewing' ? 'bg-slate-100 text-slate-800' : '' }}
                                        {{ $application->applicationStatus->slug === 'shortlisted' ? 'bg-slate-100 text-slate-800' : '' }}
                                        {{ $application->applicationStatus->slug === 'interviewed' ? 'bg-slate-100 text-slate-800' : '' }}
                                        {{ $application->applicationStatus->slug === 'rejected' ? 'bg-slate-100 text-slate-800' : '' }}
                                        {{ $application->applicationStatus->slug === 'hired' ? 'bg-slate-900 text-white' : '' }}">
                                        {{ $application->applicationStatus->label }}
                                    </span>
                                </div>
                                <p class="text-slate-600 mb-2 sm:mb-3 text-sm sm:text-base">
                                    {{ $application->jobPost->company->name }} • 
                                    {{ $application->jobPost->city->name ?? 'Remote' }}
                                </p>
                                <div class="flex items-center gap-3 sm:gap-4 text-xs sm:text-sm text-slate-500">
                                    <span class="flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Applied {{ $application->created_at->diffForHumans() }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex flex-col sm:flex-row gap-2">
                                <a href="{{ route('candidate.conversation.start', $application->id) }}" class="inline-flex items-center justify-center gap-2 rounded-lg sm:rounded-xl bg-slate-100 px-3 sm:px-4 py-2 text-xs sm:text-sm font-semibold text-slate-900 transition hover:bg-slate-200">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 sm:h-4 sm:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                    Chat
                                </a>
                                <a href="{{ route('job.show', ['city' => $application->jobPost->city_slug, 'slug' => $application->jobPost->slug]) }}" class="inline-flex items-center justify-center rounded-lg sm:rounded-xl bg-slate-900 px-3 sm:px-4 py-2 text-xs sm:text-sm font-semibold text-white transition hover:bg-black">
                                    View Job
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($applications->hasPages())
                <div class="mt-6 sm:mt-8">
                    {{ $applications->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection
