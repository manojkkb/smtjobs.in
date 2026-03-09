<?php

use Livewire\Component;
use App\Models\JobApplication;

new class extends Component
{
    public $limit = 5;
    
    public function updateStatus($applicationId, $statusSlug)
    {
        $application = JobApplication::find($applicationId);
        
        if ($application && $application->jobPost->company_id == auth()->user()->company->id) {
            $status = \App\Models\ApplicationStatus::where('slug', $statusSlug)->first();
            if ($status) {
                $application->status_id = $status->id;
                $application->save();
                $this->dispatch('application-updated');
                $this->dispatch('stats-refreshed');
            }
        }
    }
};
?>

@php
    $recruiterId = auth()->user()->company->id ?? null;
    $applications = collect();
    
    if ($recruiterId) {
        $applications = App\Models\JobApplication::with(['candidate.user', 'applicationStatus', 'jobPost'])
            ->whereHas('jobPost', function($q) use ($recruiterId) {
                $q->where('company_id', $recruiterId);
            })
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
            <h2 class="text-base sm:text-lg font-semibold text-slate-900">Recent Applications</h2>
            <p class="text-xs sm:text-sm text-slate-600">Latest candidates who applied</p>
        </div>
        <a href="{{ route('recruiter.job-applications') }}" class="text-xs sm:text-sm font-semibold text-blue-600 hover:text-blue-700 whitespace-nowrap transition">
            View all →
        </a>
    </div>
    
    <div class="divide-y divide-slate-100">
        @forelse($applications as $application)
            <div 
                class="px-4 sm:px-6 py-3 sm:py-4 hover:bg-slate-50 transition-colors"
                wire:key="app-{{ $application->id }}"
            >
                <div class="flex items-start gap-2 sm:gap-3">
                    <div class="flex-shrink-0">
                        <div class="flex h-8 w-8 sm:h-10 sm:w-10 items-center justify-center rounded-full bg-gradient-to-br from-blue-400 to-blue-600 text-white text-xs sm:text-sm font-semibold shadow-sm">
                            {{ strtoupper(substr($application->candidate->user->name ?? 'U', 0, 1)) }}
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex flex-wrap items-center gap-1 sm:gap-2">
                            <p class="text-xs sm:text-sm font-semibold text-slate-900 truncate">
                                {{ $application->candidate->user->name ?? 'Unknown' }}
                            </p>
                            <span class="inline-flex items-center rounded-full px-1.5 sm:px-2 py-0.5 text-xs font-medium
                                @if($application->applicationStatus->slug === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($application->applicationStatus->slug === 'reviewing') bg-blue-100 text-blue-800
                                @elseif($application->applicationStatus->slug === 'shortlisted') bg-green-100 text-green-800
                                @elseif($application->applicationStatus->slug === 'rejected') bg-red-100 text-red-800
                                @else bg-slate-100 text-slate-800
                                @endif">
                                {{ ucfirst($application->applicationStatus->slug) }}
                            </span>
                        </div>
                        <p class="mt-0.5 sm:mt-1 text-xs text-slate-600 truncate">
                            {{ $application->jobPost->title }}
                        </p>
                        <div class="mt-1 sm:mt-2 flex items-center gap-2">
                            <p class="text-xs text-slate-500">
                                {{ $application->created_at->diffForHumans() }}
                            </p>
                            
                            {{-- Quick Actions Dropdown --}}
                            <div 
                                x-data="{ open: false }" 
                                @click.away="open = false"
                                class="relative"
                            >
                                <button 
                                    @click="open = !open"
                                    class="text-xs font-medium text-slate-600 hover:text-slate-900 transition"
                                >
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                    </svg>
                                </button>
                                
                                <div 
                                    x-show="open"
                                    x-transition
                                    x-cloak
                                    class="absolute left-0 top-full mt-1 w-40 rounded-lg border border-slate-200 bg-white shadow-lg z-10"
                                >
                                    <button 
                                        wire:click="updateStatus({{ $application->id }}, 'reviewing')"
                                        class="w-full px-3 py-2 text-left text-xs hover:bg-blue-50 text-slate-700 hover:text-blue-700 transition"
                                        @click="open = false"
                                    >
                                        Mark Reviewing
                                    </button>
                                    <button 
                                        wire:click="updateStatus({{ $application->id }}, 'shortlisted')"
                                        class="w-full px-3 py-2 text-left text-xs hover:bg-green-50 text-slate-700 hover:text-green-700 transition"
                                        @click="open = false"
                                    >
                                        Shortlist
                                    </button>
                                    <button 
                                        wire:click="updateStatus({{ $application->id }}, 'rejected')"
                                        class="w-full px-3 py-2 text-left text-xs hover:bg-red-50 text-slate-700 hover:text-red-700 transition"
                                        @click="open = false"
                                    >
                                        Reject
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="px-4 sm:px-6 py-8 sm:py-12 text-center">
                <svg class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <p class="mt-2 text-sm text-slate-500">No applications yet</p>
                <p class="mt-1 text-xs text-slate-400">Applications will appear here when candidates apply</p>
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