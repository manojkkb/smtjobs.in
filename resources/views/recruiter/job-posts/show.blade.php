@extends('recruiter.layouts.app')

@section('title', optional($jobPost->profile)->title ?? 'Job details')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Details</p>
                <h1 class="text-2xl font-semibold text-slate-900">{{ optional($jobPost->profile)->title ?? 'Job post' }}</h1>
                <p class="text-sm text-slate-500">{{ optional($jobPost->category)->name ?? 'General' }} • {{ optional($jobPost->city)->name ?? 'Location pending' }}</p>
            </div>
            <div class="flex gap-2">
                <a
                    href="{{ route('recruiter.job-posts.edit', $jobPost) }}"
                    class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300"
                >
                    Edit
                </a>
                <a
                    href="{{ route('recruiter.job-posts.index') }}"
                    class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300"
                >
                    Back
                </a>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Status</p>
                <p class="text-sm font-semibold text-slate-900">{{ $jobPost->is_active ? 'Active' : 'Paused' }}</p>
                <p class="text-xs text-slate-500">Published {{ optional($jobPost->published_at)->diffForHumans() ?? 'draft' }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Schedule</p>
                <p class="text-sm font-semibold text-slate-900">{{ optional($jobPost->expires_at)->format('M j, Y g:ia') ?? 'No expiration' }}</p>
                <p class="text-xs text-slate-500">{{ $jobPost->is_remote ? 'Remote friendly' : 'On-site' }}</p>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Remuneration</p>
                @if ($jobPost->min_salary || $jobPost->max_salary)
                    <p class="text-sm font-semibold text-slate-900">
                        {{ $jobPost->min_salary ? number_format($jobPost->min_salary) : '—' }} — {{ $jobPost->max_salary ? number_format($jobPost->max_salary) : '—' }}
                    </p>
                    <p class="text-xs text-slate-500">Monthly</p>
                @else
                    <p class="text-sm text-slate-500">Not shared</p>
                @endif
            </div>
        </div>

        <div class="space-y-5">
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="px-6 py-5 border-b border-slate-100">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Description</p>
                </div>
                <div class="px-6 py-6 text-sm text-slate-700">
                    <p>{!! nl2br(e(optional($jobPost->profile)->description ?? 'No description provided.')) !!}</p>
                </div>
            </section>

            @if(optional($jobPost->profile)->requirements)
                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="px-6 py-5 border-b border-slate-100">
                        <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Requirements</p>
                    </div>
                    <div class="px-6 py-6 text-sm text-slate-700">
                        <p>{!! nl2br(e(optional($jobPost->profile)->requirements)) !!}</p>
                    </div>
                </section>
            @endif

            @if(optional($jobPost->profile)->responsibilities)
                <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="px-6 py-5 border-b border-slate-100">
                        <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Responsibilities</p>
                    </div>
                    <div class="px-6 py-6 text-sm text-slate-700">
                        <p>{!! nl2br(e(optional($jobPost->profile)->responsibilities)) !!}</p>
                    </div>
                </section>
            @endif
        </div>
    </div>
@endsection
