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
                <a href="{{ route('recruiter.job-posts.create') }}" class="inline-flex w-full sm:w-auto items-center justify-center gap-2 rounded-lg sm:rounded-xl bg-slate-900 px-4 sm:px-6 py-2.5 sm:py-3 text-sm font-semibold text-white hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-700 focus:ring-offset-2 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Create New Job Post
                </a>
            </div>
        </div>

        {{-- Dynamic Statistics Cards - Livewire Component --}}
        <div wire:loading.remove wire:target="$refresh">
            <livewire:recruiter.dashboard-stats />
        </div>
        
        {{-- Shimmer Loader for Stats --}}
        <div wire:loading wire:target="$refresh" class="grid grid-cols-1 gap-4 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @for ($i = 0; $i < 4; $i++)
                <div class="rounded-xl sm:rounded-2xl border border-slate-200 bg-white p-4 sm:p-6 shadow-sm overflow-hidden relative">
                    <div class="flex items-start justify-between">
                        <div class="flex-1 space-y-3">
                            <div class="h-4 bg-slate-200 rounded w-24 relative overflow-hidden">
                                <div class="absolute inset-0 shimmer"></div>
                            </div>
                            <div class="h-8 bg-slate-200 rounded w-16 relative overflow-hidden">
                                <div class="absolute inset-0 shimmer"></div>
                            </div>
                            <div class="h-3 bg-slate-200 rounded w-20 relative overflow-hidden">
                                <div class="absolute inset-0 shimmer"></div>
                            </div>
                        </div>
                        <div class="h-10 w-10 sm:h-12 sm:w-12 bg-slate-200 rounded-full relative overflow-hidden">
                            <div class="absolute inset-0 shimmer"></div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>

        {{-- Two Column Layout --}}
        <div class="grid gap-4 sm:gap-6 grid-cols-1 lg:grid-cols-2">
            {{-- Recent Applications - Livewire Component --}}
            <div>
                <div wire:loading.remove wire:target="$refresh">
                    <livewire:recruiter.recent-applications />
                </div>
                
                {{-- Shimmer Loader for Applications --}}
                <div wire:loading wire:target="$refresh" class="rounded-xl sm:rounded-2xl bg-white overflow-hidden">
                    <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-slate-100">
                        <div class="h-5 bg-slate-200 rounded w-40 relative overflow-hidden">
                            <div class="absolute inset-0 shimmer"></div>
                        </div>
                        <div class="h-3 bg-slate-200 rounded w-32 mt-2 relative overflow-hidden">
                            <div class="absolute inset-0 shimmer"></div>
                        </div>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @for ($i = 0; $i < 5; $i++)
                            <div class="px-4 sm:px-6 py-3 sm:py-4">
                                <div class="flex items-start gap-3">
                                    <div class="h-10 w-10 bg-slate-200 rounded-full relative overflow-hidden">
                                        <div class="absolute inset-0 shimmer"></div>
                                    </div>
                                    <div class="flex-1 space-y-2">
                                        <div class="h-4 bg-slate-200 rounded w-32 relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                        <div class="h-3 bg-slate-200 rounded w-48 relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                        <div class="h-3 bg-slate-200 rounded w-24 relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            {{-- Recent Job Posts - Livewire Component --}}
            <div>
                <div wire:loading.remove wire:target="$refresh">
                    <livewire:recruiter.recent-job-posts />
                </div>
                
                {{-- Shimmer Loader for Job Posts --}}
                <div wire:loading wire:target="$refresh" class="rounded-xl sm:rounded-2xl bg-white overflow-hidden">
                    <div class="px-4 sm:px-6 py-3 sm:py-4 border-b border-slate-100">
                        <div class="h-5 bg-slate-200 rounded w-40 relative overflow-hidden">
                            <div class="absolute inset-0 shimmer"></div>
                        </div>
                        <div class="h-3 bg-slate-200 rounded w-28 mt-2 relative overflow-hidden">
                            <div class="absolute inset-0 shimmer"></div>
                        </div>
                    </div>
                    <div class="divide-y divide-slate-100">
                        @for ($i = 0; $i < 5; $i++)
                            <div class="px-4 sm:px-6 py-3 sm:py-4">
                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex-1 space-y-2">
                                        <div class="h-4 bg-slate-200 rounded w-48 relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                        <div class="h-3 bg-slate-200 rounded w-64 relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                        <div class="h-3 bg-slate-200 rounded w-32 relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
