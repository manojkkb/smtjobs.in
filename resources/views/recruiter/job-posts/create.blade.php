@extends('recruiter.layouts.app')

@section('title', 'Create New Job Post')

@section('content')
    <div class="space-y-5">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-slate-400">New Listing</p>
                <h1 class="text-2xl font-semibold text-slate-900">Create New Job Post</h1>
                <p class="text-sm text-slate-500">Complete the step-by-step form to publish your job opportunity</p>
            </div>
            <a
                href="{{ route('recruiter.job-posts.index') }}"
                class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
                Back to jobs
            </a>
        </div>

        <livewire:recruiter.create-job-post />
    </div>
@endsection
