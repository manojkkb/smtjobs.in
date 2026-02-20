@extends('recruiter.layouts.app')

@section('title', 'Edit job post')

@section('content')
    <div class="space-y-5">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Manage listing</p>
                <h1 class="text-2xl font-semibold text-slate-900">Edit {{ optional($jobPost->profile)->title ?? 'job post' }}</h1>
                <p class="text-sm text-slate-500">Adjust the description or circulation dates for this opening.</p>
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

        <form action="{{ route('recruiter.job-posts.update', $jobPost) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            @include('recruiter.job-posts.partials.form')
            <div class="flex justify-end gap-3">
                <a
                    href="{{ route('recruiter.job-posts.index') }}"
                    class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-300"
                >
                    Cancel
                </a>
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-2xl border border-transparent bg-cyan-600 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-cyan-500"
                >
                    Save changes
                </button>
            </div>
        </form>
    </div>
@endsection
