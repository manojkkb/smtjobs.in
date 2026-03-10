@extends('candidate.layouts.app')

@section('title', 'Saved Jobs · SMTJobs')

@section('content')
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8 pt-24">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Saved Jobs</h1>
            <p class="text-slate-600 mt-2">Jobs you've bookmarked for later</p>
        </div>

        @if($savedJobs->isEmpty())
            <div class="rounded-2xl border border-slate-200 bg-white p-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
                <h3 class="text-xl font-semibold text-slate-900 mb-2">No saved jobs yet</h3>
                <p class="text-slate-600 mb-6">Start saving jobs that interest you</p>
                <a href="{{ route('jobs') }}" class="inline-flex items-center gap-2 rounded-xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-black">
                    Browse Jobs
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>
        @else
            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                @foreach($savedJobs as $saved)
                    @php
                        $job = $saved->jobPost;
                    @endphp
                    <div class="rounded-2xl border border-slate-200 bg-white p-6 transition hover:shadow-lg">
                        <div class="mb-4">
                            <h3 class="text-lg font-semibold text-slate-900 mb-1">
                                {{ $job->title }}
                            </h3>
                            <p class="text-sm text-slate-600">{{ $job->company->name }}</p>
                        </div>
                        <div class="space-y-2 text-sm text-slate-600 mb-4">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ $job->city->name ?? 'Remote' }}
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Saved {{ $saved->created_at->diffForHumans() }}
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('job.show', ['city' => $job->city_slug, 'slug' => $job->slug]) }}" class="flex-1 rounded-xl bg-slate-900 px-4 py-2 text-center text-sm font-semibold text-white transition hover:bg-black">
                                View Job
                            </a>
                            <form action="{{ route('candidate.job.toggle-save', $job->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="rounded-xl border-2 border-slate-200 px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-slate-100">
                                    Remove
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            @if($savedJobs->hasPages())
                <div class="mt-8">
                    {{ $savedJobs->links() }}
                </div>
            @endif
        @endif
    </div>
@endsection