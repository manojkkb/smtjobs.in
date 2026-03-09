@extends('recruiter.layouts.app')

@section('title', 'Job posts')

@section('content')
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-slate-900">Job posts</h1>
            <p class="text-sm text-slate-500">Manage your live and paused roles from one place.</p>
        </div>
        <div class="flex gap-2">
            <a
                href="{{ route('recruiter.job-posts.create') }}"
                class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300"
            >
                <span>New job post</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-6 py-4 text-sm font-semibold text-emerald-600">
            {{ session('success') }}
        </div>
    @endif

    {{-- Dynamic Job Posts List - Livewire Component --}}
    <livewire:recruiter.job-posts-list />
@endsection
