<?php

use Livewire\Component;
use App\Models\JobPost;
use App\Models\JobApplication;

new class extends Component
{
    public function refresh()
    {
        $this->dispatch('stats-refreshed');
    }
};
?>

@php
    $recruiterId = auth()->user()->company->id ?? null;
    
    $stats = [
        'total_jobs' => 0,
        'active_jobs' => 0,
        'total_applications' => 0,
        'pending_applications' => 0,
    ];
    
    if ($recruiterId) {
        $stats['total_jobs'] = App\Models\JobPost::where('company_id', $recruiterId)->count();
        $stats['active_jobs'] = App\Models\JobPost::where('company_id', $recruiterId)
            ->where('is_active', true)
            ->count();
        $stats['total_applications'] = App\Models\JobApplication::whereHas('jobPost', function($q) use ($recruiterId) {
            $q->where('company_id', $recruiterId);
        })->count();
        $stats['pending_applications'] = App\Models\JobApplication::whereHas('jobPost', function($q) use ($recruiterId) {
            $q->where('company_id', $recruiterId);
        })->whereHas('applicationStatus', function($q) {
            $q->where('slug', 'pending');
        })->count();
    }
@endphp

<div 
    x-data="{ 
        isRefreshing: false,
        lastUpdate: new Date().toLocaleTimeString()
    }"
    class="grid grid-cols-1 gap-4 sm:gap-6 sm:grid-cols-2 lg:grid-cols-4"
>
    {{-- Total Jobs --}}
    <div 
        class="rounded-xl sm:rounded-2xl border border-slate-200 bg-white p-4 sm:p-6 shadow-sm transition hover:shadow-md"
    >
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <p class="text-xs sm:text-sm font-medium text-slate-600">Total Job Posts</p>
                <p class="mt-1 sm:mt-2 text-2xl sm:text-3xl font-bold text-slate-900">{{ $stats['total_jobs'] }}</p>
                <p class="mt-1 sm:mt-2 text-xs text-slate-500">
                    <span class="text-emerald-600 font-semibold">{{ $stats['active_jobs'] }}</span> active
                </p>
            </div>
            <div class="flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-full bg-blue-100 flex-shrink-0">
                <svg class="h-5 w-5 sm:h-6 sm:w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Active Jobs --}}
    <div 
        class="rounded-xl sm:rounded-2xl border border-slate-200 bg-white p-4 sm:p-6 shadow-sm transition hover:shadow-md"
    >
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <p class="text-xs sm:text-sm font-medium text-slate-600">Active Jobs</p>
                <p class="mt-1 sm:mt-2 text-2xl sm:text-3xl font-bold text-emerald-600">{{ $stats['active_jobs'] }}</p>
                <p class="mt-1 sm:mt-2 text-xs text-emerald-600 font-medium">
                    Currently open
                </p>
            </div>
            <div class="flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-full bg-emerald-100 flex-shrink-0">
                <svg class="h-5 w-5 sm:h-6 sm:w-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Total Applications --}}
    <div 
        class="rounded-xl sm:rounded-2xl border border-slate-200 bg-white p-4 sm:p-6 shadow-sm transition hover:shadow-md"
    >
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <p class="text-xs sm:text-sm font-medium text-slate-600">Total Applications</p>
                <p class="mt-1 sm:mt-2 text-2xl sm:text-3xl font-bold text-slate-900">{{ $stats['total_applications'] }}</p>
                <p class="mt-1 sm:mt-2 text-xs text-slate-500">
                    All candidates
                </p>
            </div>
            <div class="flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-full bg-purple-100 flex-shrink-0">
                <svg class="h-5 w-5 sm:h-6 sm:w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>
    </div>

    {{-- Pending Applications --}}
    <div 
        class="rounded-xl sm:rounded-2xl border border-slate-200 bg-white p-4 sm:p-6 shadow-sm transition hover:shadow-md"
    >
        <div class="flex items-start justify-between">
            <div class="flex-1">
                <p class="text-xs sm:text-sm font-medium text-slate-600">Pending Review</p>
                <p class="mt-1 sm:mt-2 text-2xl sm:text-3xl font-bold text-amber-600">{{ $stats['pending_applications'] }}</p>
                <div class="mt-1 sm:mt-2">
                    <button 
                        wire:click="refresh"
                        @click="isRefreshing = true; setTimeout(() => isRefreshing = false, 500)"
                        class="text-xs font-medium text-amber-600 hover:text-amber-700 transition"
                        :disabled="isRefreshing"
                    >
                        <span x-show="!isRefreshing">⟳ Refresh</span>
                        <span x-show="isRefreshing" x-cloak>Refreshing...</span>
                    </button>
                </div>
            </div>
            <div class="flex h-10 w-10 sm:h-12 sm:w-12 items-center justify-center rounded-full bg-amber-100 flex-shrink-0">
                <svg class="h-5 w-5 sm:h-6 sm:w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
        </div>
    </div>
</div>