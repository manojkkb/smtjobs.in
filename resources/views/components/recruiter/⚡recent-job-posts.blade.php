<?php

use Livewire\Component;
use App\Models\JobPost;

new class extends Component
{
    public $limit = 5;
    
    public function toggleStatus($jobId)
    {
        $job = JobPost::find($jobId);
        
        if ($job && $job->company_id == auth()->user()->company->id) {
            $job->is_active = !$job->is_active;
            $job->save();
            $this->dispatch('job-updated');
        }
    }
};
?>

@php
    $recruiterId = auth()->user()->company->id ?? null;
    $jobPosts = collect();
    
    if ($recruiterId) {
        $jobPosts = App\Models\JobPost::with(['category', 'city', 'employmentType'])
            ->where('company_id', $recruiterId)
            ->latest()
            ->limit($limit)
            ->get();
    }
@endphp

<div 
    class="rounded-xl sm:rounded-2xl bg-white"
    wire:poll.30s
>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 px-4 sm:px-6 py-3 sm:py-4 border-b border-slate-100">
        <div>
            <h2 class="text-base sm:text-lg font-semibold text-slate-900">Recent Job Posts</h2>
            <p class="text-xs sm:text-sm text-slate-600">Your latest openings</p>
        </div>
        <a href="{{ route('recruiter.job-posts.index') }}" class="text-xs sm:text-sm font-semibold text-blue-600 hover:text-blue-700 whitespace-nowrap transition">
            View all →
        </a>
    </div>
    
    <div class="divide-y divide-slate-100">
        @forelse($jobPosts as $job)
            <div 
                class="px-4 sm:px-6 py-3 sm:py-4 hover:bg-slate-50 transition-colors"
                wire:key="job-{{ $job->id }}"
            >
                <div class="flex items-start justify-between gap-2 sm:gap-3">
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-1 sm:gap-2">
                            <a 
                                href="{{ route('recruiter.job-posts.show', $job) }}"
                                class="text-xs sm:text-sm font-semibold text-slate-900 hover:text-blue-600 truncate transition"
                            >
                                {{ $job->title }}
                            </a>
                            <button 
                                wire:click="toggleStatus({{ $job->id }})"
                                class="inline-flex items-center rounded-full px-1.5 sm:px-2 py-0.5 text-xs font-medium transition {{ $job->is_active ? 'bg-emerald-100 text-emerald-800 hover:bg-emerald-200' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}"
                                wire:loading.class="opacity-50 pointer-events-none"
                            >
                                {{ $job->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </div>
                        <p class="mt-0.5 sm:mt-1 text-xs text-slate-600 truncate">
                            {{ optional($job->category)->label ?? 'General' }} • 
                            {{ optional($job->city)->name ?? 'Remote' }} • 
                            {{ optional($job->employmentType)->label ?? 'N/A' }}
                        </p>
                        <div class="mt-0.5 sm:mt-1 flex items-center gap-3 text-xs text-slate-500">
                            <span>Posted {{ $job->created_at->diffForHumans() }}</span>
                            <span class="flex items-center gap-1">
                                <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{ $job->views_count ?? 0 }} views
                            </span>
                        </div>
                    </div>
                    <div class="flex flex-col items-end gap-2">
                        <a 
                            href="{{ route('recruiter.job-posts.show', $job) }}" 
                            class="text-xs font-semibold text-blue-600 hover:text-blue-700 flex-shrink-0 transition"
                        >
                            View
                        </a>
                        <div 
                            x-data="{ open: false }"
                            @click.away="open = false"
                            class="relative"
                        >
                            <button 
                                @click="open = !open"
                                class="p-1 text-slate-400 hover:text-slate-600 transition"
                            >
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </button>
                            
                            <div 
                                x-show="open"
                                x-transition
                                x-cloak
                                class="absolute right-0 top-full mt-1 w-40 rounded-lg border border-slate-200 bg-white shadow-lg z-10"
                            >
                                <a 
                                    href="{{ route('recruiter.job-posts.edit', $job) }}"
                                    class="block px-3 py-2 text-xs hover:bg-slate-50 text-slate-700 transition"
                                >
                                    Edit Job
                                </a>
                                <button 
                                    wire:click="toggleStatus({{ $job->id }})"
                                    class="w-full px-3 py-2 text-left text-xs hover:bg-slate-50 text-slate-700 transition"
                                    @click="open = false"
                                >
                                    {{ $job->is_active ? 'Deactivate' : 'Activate' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="px-4 sm:px-6 py-8 sm:py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <p class="mt-2 text-sm text-slate-500">No job posts yet</p>
                <p class="mt-1 text-xs text-slate-400">Create your first job posting to get started</p>
                <a 
                    href="{{ route('recruiter.job-posts.create') }}"
                    class="mt-4 inline-flex items-center gap-2 rounded-lg bg-slate-900 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-800 transition"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Job Post
                </a>
            </div>
        @endforelse
    </div>
    
    <div 
        wire:loading 
        class="absolute inset-0 bg-white/50 flex items-center justify-center rounded-xl"
    >
        <div class="flex items-center gap-2 text-sm text-slate-600">
            <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Loading...
        </div>
    </div>
</div>