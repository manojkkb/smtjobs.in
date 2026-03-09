<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\JobApplication;
use App\Models\ApplicationStatus;

new class extends Component
{
    use WithPagination;
    
    public $search = '';
    public $statusFilter = '';
    public $jobFilter = '';
    public $perPage = 10;
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingStatusFilter()
    {
        $this->resetPage();
    }
    
    public function updatingJobFilter()
    {
        $this->resetPage();
    }
    
    public function clearFilters()
    {
        $this->reset(['search', 'statusFilter', 'jobFilter']);
        $this->resetPage();
    }
    
    public function updateApplicationStatus($applicationId, $statusSlug)
    {
        $application = JobApplication::find($applicationId);
        
        if ($application && $application->jobPost->company_id == auth()->user()->company->id) {
            $status = ApplicationStatus::where('slug', $statusSlug)->first();
            if ($status) {
                $application->status_id = $status->id;
                $application->save();
                $this->dispatch('status-updated');
            }
        }
    }
};
?>

<div>
    @php
        $recruiterId = auth()->user()->company->id ?? null;
        
        $applications = App\Models\JobApplication::with(['candidate.user', 'applicationStatus', 'jobPost'])
            ->when($recruiterId, function($q) use ($recruiterId) {
                $q->whereHas('jobPost', function($query) use ($recruiterId) {
                    $query->where('company_id', $recruiterId);
                });
            })
            ->when($search, function($q) use ($search) {
                $q->whereHas('candidate.user', function($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                          ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->when($statusFilter, function($q) use ($statusFilter) {
                $q->whereHas('applicationStatus', function($query) use ($statusFilter) {
                    $query->where('slug', $statusFilter);
                });
            })
            ->when($jobFilter, function($q) use ($jobFilter) {
                $q->where('job_post_id', $jobFilter);
            })
            ->latest()
            ->paginate($perPage);
        
        $statuses = App\Models\ApplicationStatus::all();
        $jobs = $recruiterId 
            ? App\Models\JobPost::where('company_id', $recruiterId)->get(['id', 'title'])
            : collect();
    @endphp
    
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm overflow-hidden">
        {{-- Modern Filters Header --}}
        <div class="border-b border-slate-200 bg-gradient-to-r from-slate-50 to-white px-6 py-5">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3 flex-1">
                    {{-- Search Input --}}
                    <div class="relative sm:w-72">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            wire:model.live.debounce.300ms="search"
                            placeholder="Search by name or email..."
                            class="block w-full rounded-xl border border-slate-200 bg-white pl-10 pr-3 py-2.5 text-sm placeholder:text-slate-400 focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100 transition"
                        />
                    </div>
                    
                    {{-- Status Filter --}}
                    <div class="relative">
                        <select 
                            wire:model.live="statusFilter"
                            class="block w-full appearance-none rounded-xl border border-slate-200 bg-white px-4 py-2.5 pr-10 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100 transition"
                        >
                            <option value="">All Status</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status->slug }}">{{ ucfirst($status->slug) }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="h-4 w-4 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                    
                    {{-- Job Filter --}}
                    <div class="relative">
                        <select 
                            wire:model.live="jobFilter"
                            class="block w-full appearance-none rounded-xl border border-slate-200 bg-white px-4 py-2.5 pr-10 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100 transition"
                        >
                            <option value="">All Jobs</option>
                            @foreach($jobs as $job)
                                <option value="{{ $job->id }}">{{ Str::limit($job->title, 30) }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3">
                            <svg class="h-4 w-4 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                @if($search || $statusFilter || $jobFilter)
                    <button 
                        wire:click="clearFilters"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-slate-600 hover:text-slate-900 transition"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                        Clear filters
                    </button>
                @endif
            </div>
        </div>

        {{-- Applications List --}}
        
        {{-- Shimmer Loader for Applications --}}
        <div wire:loading class="divide-y divide-slate-100">
            @for($i = 0; $i < 5; $i++)
                <div class="px-6 py-5">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                        <div class="flex-1">
                            <div class="flex items-start gap-4">
                                {{-- Avatar skeleton --}}
                                <div class="flex-shrink-0">
                                    <div class="h-14 w-14 bg-slate-200 rounded-xl relative overflow-hidden">
                                        <div class="absolute inset-0 shimmer"></div>
                                    </div>
                                </div>
                                
                                <div class="flex-1 min-w-0 space-y-3">
                                    {{-- Name and status skeleton --}}
                                    <div class="flex items-center gap-3">
                                        <div class="h-5 bg-slate-200 rounded w-40 relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                        <div class="h-6 bg-slate-200 rounded-full w-24 relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                    </div>
                                    
                                    {{-- Job title skeleton --}}
                                    <div class="flex items-center gap-2">
                                        <div class="h-8 w-8 bg-slate-200 rounded-lg relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                        <div class="h-4 bg-slate-200 rounded w-52 relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                    </div>
                                    
                                    {{-- Email and date skeleton --}}
                                    <div class="flex items-center gap-4">
                                        <div class="h-3 bg-slate-200 rounded w-48 relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                        <div class="h-3 bg-slate-200 rounded w-32 relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                    </div>
                                    
                                    {{-- Cover letter skeleton (only on some) --}}
                                    @if($i % 2 === 0)
                                        <div class="rounded-lg bg-slate-100 p-3 space-y-2">
                                            <div class="h-3 bg-slate-200 rounded w-full relative overflow-hidden">
                                                <div class="absolute inset-0 shimmer"></div>
                                            </div>
                                            <div class="h-3 bg-slate-200 rounded w-3/4 relative overflow-hidden">
                                                <div class="absolute inset-0 shimmer"></div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        {{-- Button skeleton --}}
                        <div class="flex items-center gap-2 flex-shrink-0">
                            <div class="h-10 w-10 bg-slate-200 rounded-lg relative overflow-hidden">
                                <div class="absolute inset-0 shimmer"></div>
                            </div>
                            <div class="h-10 w-10 bg-slate-200 rounded-lg relative overflow-hidden">
                                <div class="absolute inset-0 shimmer"></div>
                            </div>
                            <div class="h-10 w-10 bg-slate-200 rounded-lg relative overflow-hidden">
                                <div class="absolute inset-0 shimmer"></div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
        
        <div wire:loading.remove class="divide-y divide-slate-100">
            @forelse($applications as $application)
                <div 
                    class="group px-6 py-5 hover:bg-slate-50/50 transition-all duration-200"
                    wire:key="app-{{ $application->id }}"
                >
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                        {{-- Candidate Info Section --}}
                        <div class="flex-1">
                            <div class="flex items-start gap-4">
                                {{-- Avatar with Status Indicator --}}
                                <div class="flex-shrink-0 relative">
                                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-gradient-to-br from-cyan-400 to-blue-500 text-white font-bold text-xl shadow-md">
                                        {{ strtoupper(substr($application->candidate->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    {{-- Online/Active Indicator --}}
                                    <div class="absolute -bottom-1 -right-1 h-4 w-4 rounded-full border-2 border-white
                                        @if($application->applicationStatus->slug === 'pending') bg-yellow-400
                                        @elseif($application->applicationStatus->slug === 'reviewing') bg-blue-400
                                        @elseif($application->applicationStatus->slug === 'shortlisted') bg-emerald-400
                                        @elseif($application->applicationStatus->slug === 'rejected') bg-red-400
                                        @else bg-slate-400
                                        @endif
                                    "></div>
                                </div>
                                
                                {{-- Candidate Details --}}
                                <div class="flex-1 min-w-0 space-y-3">
                                    {{-- Name and Status Row --}}
                                    <div class="flex items-center gap-3 flex-wrap">
                                        <h3 class="text-lg font-bold text-slate-900">
                                            {{ $application->candidate->user->name ?? 'Unknown Candidate' }}
                                        </h3>
                                        <div 
                                            x-data="{ open: false }"
                                            @click.away="open = false"
                                            class="relative"
                                        >
                                            <button 
                                                @click="open = !open"
                                                class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-semibold cursor-pointer transition-all duration-200 shadow-sm
                                                    @if($application->applicationStatus->slug === 'pending') bg-yellow-100 text-yellow-800 ring-1 ring-yellow-200 hover:bg-yellow-200
                                                    @elseif($application->applicationStatus->slug === 'reviewing') bg-blue-100 text-blue-800 ring-1 ring-blue-200 hover:bg-blue-200
                                                    @elseif($application->applicationStatus->slug === 'shortlisted') bg-emerald-100 text-emerald-800 ring-1 ring-emerald-200 hover:bg-emerald-200
                                                    @elseif($application->applicationStatus->slug === 'rejected') bg-red-100 text-red-800 ring-1 ring-red-200 hover:bg-red-200
                                                    @else bg-slate-100 text-slate-800 ring-1 ring-slate-200 hover:bg-slate-200
                                                    @endif"
                                            >
                                                <span class="inline-block h-1.5 w-1.5 rounded-full
                                                    @if($application->applicationStatus->slug === 'pending') bg-yellow-500
                                                    @elseif($application->applicationStatus->slug === 'reviewing') bg-blue-500
                                                    @elseif($application->applicationStatus->slug === 'shortlisted') bg-emerald-500 animate-pulse
                                                    @elseif($application->applicationStatus->slug === 'rejected') bg-red-500
                                                    @else bg-slate-500
                                                    @endif
                                                "></span>
                                                {{ ucfirst($application->applicationStatus->slug) }}
                                                <svg class="h-3 w-3" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                            
                                            <div 
                                                x-show="open"
                                                x-transition
                                                x-cloak
                                                class="absolute left-0 top-full mt-2 w-52 rounded-xl border border-slate-200 bg-white shadow-xl z-20 overflow-hidden"
                                            >
                                                <button 
                                                    wire:click="updateApplicationStatus({{ $application->id }}, 'reviewing')"
                                                    class="w-full px-4 py-3 text-left text-sm flex items-center gap-3 hover:bg-blue-50 text-slate-700 transition-colors border-b border-slate-100"
                                                    @click="open = false"
                                                >
                                                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                                        </svg>
                                                    </span>
                                                    <span class="font-medium">Mark as Reviewing</span>
                                                </button>
                                                <button 
                                                    wire:click="updateApplicationStatus({{ $application->id }}, 'shortlisted')"
                                                    class="w-full px-4 py-3 text-left text-sm flex items-center gap-3 hover:bg-emerald-50 text-slate-700 transition-colors border-b border-slate-100"
                                                    @click="open = false"
                                                >
                                                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-emerald-100 text-emerald-600">
                                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </span>
                                                    <span class="font-medium">Shortlist Candidate</span>
                                                </button>
                                                <button 
                                                    wire:click="updateApplicationStatus({{ $application->id }}, 'rejected')"
                                                    class="w-full px-4 py-3 text-left text-sm flex items-center gap-3 hover:bg-red-50 text-slate-700 transition-colors"
                                                    @click="open = false"
                                                >
                                                    <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-red-100 text-red-600">
                                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                        </svg>
                                                    </span>
                                                    <span class="font-medium">Reject Application</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    {{-- Job Applied For --}}
                                    <div class="flex items-center gap-2 text-sm">
                                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-slate-100">
                                            <svg class="h-4 w-4 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span class="text-slate-600">Applied for:</span>
                                        <span class="font-semibold text-slate-900">{{ $application->jobPost->title }}</span>
                                    </div>
                                    
                                    {{-- Contact & Time Info --}}
                                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm">
                                        <div class="flex items-center gap-2 text-slate-600">
                                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                            </svg>
                                            <span>{{ $application->candidate->user->email ?? 'No email provided' }}</span>
                                        </div>
                                        <div class="flex items-center gap-2 text-slate-500">
                                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span>{{ $application->applied_at?->diffForHumans() ?? $application->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                    
                                    {{-- Cover Letter Preview --}}
                                    @if($application->cover_letter)
                                        <div class="mt-3 rounded-lg bg-slate-50 border border-slate-100 px-4 py-3">
                                            <div class="flex items-start gap-2">
                                                <svg class="h-4 w-4 text-slate-400 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <p class="text-sm text-slate-600 line-clamp-2 flex-1">
                                                    {{ Str::limit($application->cover_letter, 180) }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        {{-- Action Buttons --}}
                        <div class="flex items-center gap-2 flex-shrink-0 lg:pt-1">
                            <button 
                                class="inline-flex items-center justify-center h-10 w-10 rounded-lg bg-cyan-50 text-cyan-600 hover:bg-cyan-100 transition-all duration-200 shadow-sm"
                                title="View Profile"
                            >
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                            <button 
                                class="inline-flex items-center justify-center h-10 w-10 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100 transition-all duration-200 shadow-sm"
                                title="Download Resume"
                            >
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </button>
                            <button 
                                class="inline-flex items-center justify-center h-10 w-10 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-100 transition-all duration-200 shadow-sm"
                                title="Send Message"
                            >
                                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-6 py-16 text-center">
                    <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-2xl bg-gradient-to-br from-slate-100 to-slate-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </div>
                    <h3 class="mt-6 text-base font-bold text-slate-900">No applications yet</h3>
                    <p class="mt-2 text-sm text-slate-600 max-w-sm mx-auto">
                        @if($search || $statusFilter || $jobFilter)
                            No applications match your current filters. Try adjusting your search criteria.
                        @else
                            Your talent inbox is empty. Applications from candidates will appear here once they start applying to your job posts.
                        @endif
                    </p>
                    @if($search || $statusFilter || $jobFilter)
                        <button 
                            wire:click="clearFilters"
                            class="mt-6 inline-flex items-center gap-2 rounded-xl bg-cyan-500 px-5 py-2.5 text-sm font-semibold text-white hover:bg-cyan-600 transition-all shadow-sm hover:shadow-md"
                        >
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Clear all filters
                        </button>
                    @else
                        <a 
                            href="{{ route('recruiter.job-posts.index') }}"
                            class="mt-6 inline-flex items-center gap-2 rounded-xl bg-slate-900 px-5 py-2.5 text-sm font-semibold text-white hover:bg-slate-800 transition-all shadow-sm hover:shadow-md"
                        >
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            View Job Posts
                        </a>
                    @endif
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        {{-- Shimmer Loader for Pagination --}}
        <div wire:loading class="border-t border-slate-200 px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="h-8 bg-slate-200 rounded w-64 relative overflow-hidden">
                    <div class="absolute inset-0 shimmer"></div>
                </div>
                <div class="h-8 bg-slate-200 rounded w-48 relative overflow-hidden">
                    <div class="absolute inset-0 shimmer"></div>
                </div>
            </div>
        </div>
        
        @if($applications->hasPages())
            <div wire:loading.remove class="border-t border-slate-200 px-6 py-4">
                {{ $applications->links() }}
            </div>
        @endif
    </div>
</div>