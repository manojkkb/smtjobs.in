<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\JobPost;

new class extends Component
{
    use WithPagination;
    
    public $search = '';
    public $statusFilter = '';
    public $perPage = 15;
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingStatusFilter()
    {
        $this->resetPage();
    }
    
    public function clearFilters()
    {
        $this->reset(['search', 'statusFilter']);
        $this->resetPage();
    }
    
    public function toggleStatus($jobId)
    {
        $job = JobPost::find($jobId);
        
        if ($job && $job->company_id == auth()->user()->company->id) {
            $job->is_active = !$job->is_active;
            $job->save();
            $this->dispatch('job-status-toggled');
        }
    }
    
    public function deleteJob($jobId)
    {
        $job = JobPost::find($jobId);
        
        if ($job && $job->company_id == auth()->user()->company->id) {
            $job->delete();
            $this->dispatch('job-deleted');
        }
    }
}; ?>

<div>
    <div class="mt-6 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        {{-- Header with filters --}}
        <div class="border-b border-slate-100 px-6 py-5">
            <div class="flex flex-col gap-4 sm:flex-row sm:justify-between sm:items-center">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Open roles</p>
                    <h2 class="text-lg font-semibold text-slate-900">Job Posts</h2>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <input
                        type="text"
                        wire:model.live.debounce.300ms="search"
                        placeholder="Search jobs..."
                        class="rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-100"
                    />
                    <select 
                        wire:model.live="statusFilter"
                        class="rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-100"
                    >
                        <option value="">All Status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                    @if($search || $statusFilter)
                        <button 
                            wire:click="clearFilters"
                            class="text-sm font-medium text-slate-600 hover:text-slate-900 transition"
                        >
                            Clear
                        </button>
                    @endif
                </div>
            </div>
        </div>
        
        {{-- Table --}}
        <div class="w-full overflow-x-auto">
            {{-- Shimmer Loader --}}
            <div wire:loading class="min-w-full">
                <table class="min-w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-slate-200">
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Job Details</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Location</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Compensation</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Requirements</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                            <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @for($i = 0; $i < 8; $i++)
                            <tr>
                                {{-- Job Details Shimmer --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-start gap-3">
                                        <div class="w-10 h-10 bg-slate-200 rounded-lg relative overflow-hidden flex-shrink-0">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                        <div class="flex-1 space-y-2">
                                            <div class="h-4 bg-slate-200 rounded w-48 relative overflow-hidden">
                                                <div class="absolute inset-0 shimmer"></div>
                                            </div>
                                            <div class="h-3 bg-slate-200 rounded w-24 relative overflow-hidden">
                                                <div class="absolute inset-0 shimmer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- Location Shimmer --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-slate-200 rounded-lg relative overflow-hidden flex-shrink-0">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                        <div class="space-y-2">
                                            <div class="h-4 bg-slate-200 rounded w-28 relative overflow-hidden">
                                                <div class="absolute inset-0 shimmer"></div>
                                            </div>
                                            <div class="h-3 bg-slate-200 rounded w-20 relative overflow-hidden">
                                                <div class="absolute inset-0 shimmer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- Compensation Shimmer --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 bg-slate-200 rounded-lg relative overflow-hidden flex-shrink-0">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                        <div class="space-y-2">
                                            <div class="h-4 bg-slate-200 rounded w-32 relative overflow-hidden">
                                                <div class="absolute inset-0 shimmer"></div>
                                            </div>
                                            <div class="h-3 bg-slate-200 rounded w-20 relative overflow-hidden">
                                                <div class="absolute inset-0 shimmer"></div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- Requirements Shimmer --}}
                                <td class="px-6 py-5">
                                    <div class="space-y-2">
                                        <div class="h-4 bg-slate-200 rounded w-28 relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                        <div class="h-3 bg-slate-200 rounded w-24 relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- Status Shimmer --}}
                                <td class="px-6 py-5">
                                    <div class="space-y-2">
                                        <div class="h-7 bg-slate-200 rounded-full w-20 relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                        <div class="h-3 bg-slate-200 rounded w-24 relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                    </div>
                                </td>
                                
                                {{-- Actions Shimmer --}}
                                <td class="px-6 py-5">
                                    <div class="flex items-center justify-end gap-1">
                                        <div class="w-8 h-8 bg-slate-200 rounded-lg relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                        <div class="w-8 h-8 bg-slate-200 rounded-lg relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                        <div class="w-8 h-8 bg-slate-200 rounded-lg relative overflow-hidden">
                                            <div class="absolute inset-0 shimmer"></div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            
            {{-- Actual Content --}}
            <table wire:loading.remove class="min-w-full text-left text-sm">
                <thead>
                    <tr class="border-b border-slate-200">
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Job Details</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Location</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Compensation</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Requirements</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                        <th class="px-6 py-4 text-xs font-semibold uppercase tracking-wider text-slate-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @php
                        $recruiterId = auth()->user()->company->id ?? null;
                        
                        $jobPosts = App\Models\JobPost::with(['category', 'city', 'experienceRange', 'employmentType'])
                            ->when($recruiterId, fn($q) => $q->where('company_id', $recruiterId))
                            ->when($search, function($q) use ($search) {
                                $q->where('title', 'like', '%' . $search . '%');
                            })
                            ->when($statusFilter === 'active', fn($q) => $q->where('is_active', true))
                            ->when($statusFilter === 'inactive', fn($q) => $q->where('is_active', false))
                            ->latest()
                            ->paginate($perPage);
                    @endphp
                    
                    @forelse ($jobPosts as $jobPost)
                        <tr 
                            class="group hover:bg-slate-50/50 transition-all duration-200"
                            wire:key="job-{{ $jobPost->id }}"
                        >
                            {{-- Job Details --}}
                            <td class="px-6 py-5">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-gradient-to-br from-slate-800 to-black flex items-center justify-center text-white font-bold text-sm shadow-sm">
                                        {{ strtoupper(substr($jobPost->title ?? 'J', 0, 1)) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <h3 class="text-sm font-semibold text-slate-900 truncate group-hover:text-black transition-colors">
                                            {{ $jobPost->title ?? 'Untitled role' }}
                                        </h3>
                                        <p class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6 6V5a3 3 0 013-3h2a3 3 0 013 3v1h2a2 2 0 012 2v3.57A22.952 22.952 0 0110 13a22.95 22.95 0 01-8-1.43V8a2 2 0 012-2h2zm2-1a1 1 0 011-1h2a1 1 0 011 1v1H8V5zm1 5a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                            </svg>
                                            {{ optional($jobPost->category)->label ?? 'General' }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            
                            {{-- Location --}}
                            <td class="px-6 py-5">
                                <div class="flex items-center gap-2">
                                    <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                                        <svg class="w-4 h-4 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-slate-900">{{ optional($jobPost->city)->name ?? 'Remote' }}</p>
                                        <p class="text-xs text-slate-500 flex items-center gap-1 mt-0.5">
                                            @if($jobPost->is_remote)
                                                <span class="inline-flex items-center gap-1">
                                                    <svg class="w-3 h-3 text-slate-900" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
                                                    </svg>
                                                    <span class="text-slate-900 font-medium">Remote</span>
                                                </span>
                                            @else
                                                On-site
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </td>
                            
                            {{-- Compensation --}}
                            <td class="px-6 py-5">
                                @if ($jobPost->min_salary || $jobPost->max_salary)
                                    <div class="flex items-center gap-2">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-slate-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900">
                                                ${{ number_format($jobPost->min_salary ?? 0) }} - ${{ number_format($jobPost->max_salary ?? 0) }}
                                            </p>
                                            <p class="text-xs text-slate-500 mt-0.5">Per month</p>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center gap-2">
                                        <div class="flex-shrink-0 w-8 h-8 rounded-lg bg-slate-100 flex items-center justify-center">
                                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </div>
                                        <p class="text-sm text-slate-500">Not disclosed</p>
                                    </div>
                                @endif
                            </td>
                            
                            {{-- Requirements --}}
                            <td class="px-6 py-5">
                                <div>
                                    <p class="text-sm font-medium text-slate-900 flex items-center gap-1">
                                        <svg class="w-3.5 h-3.5 text-slate-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                        </svg>
                                        {{ optional($jobPost->experienceRange)->label ?? 'Any level' }}
                                    </p>
                                    <p class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                        </svg>
                                        {{ optional($jobPost->employmentType)->label ?? 'Full-time' }}
                                    </p>
                                </div>
                            </td>
                            
                            {{-- Status --}}
                            <td class="px-6 py-5">
                                <button
                                    wire:click="toggleStatus({{ $jobPost->id }})"
                                    class="inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold transition-all duration-200 {{ $jobPost->is_active ? 'bg-slate-100 text-slate-900 hover:bg-slate-200 ring-1 ring-slate-300' : 'bg-slate-100 text-slate-600 hover:bg-slate-200 ring-1 ring-slate-200' }}"
                                    wire:loading.class="opacity-50 pointer-events-none"
                                >
                                    <span class="w-1.5 h-1.5 rounded-full {{ $jobPost->is_active ? 'bg-slate-900 animate-pulse' : 'bg-slate-400' }}"></span>
                                    {{ $jobPost->is_active ? 'Active' : 'Inactive' }}
                                </button>
                                <p class="text-xs text-slate-400 mt-2 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ optional($jobPost->published_at)->diffForHumans() ?? 'Draft' }}
                                </p>
                            </td>
                            
                            {{-- Actions --}}
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-end gap-1">
                                    <a
                                        href="{{ route('recruiter.job-posts.show', $jobPost) }}"
                                        class="p-2 rounded-lg text-slate-400 hover:text-slate-900 hover:bg-slate-100 transition-all duration-200"
                                        title="View Details"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    <a
                                        href="{{ route('recruiter.job-posts.edit', $jobPost) }}"
                                        class="p-2 rounded-lg text-slate-400 hover:text-slate-900 hover:bg-slate-100 transition-all duration-200"
                                        title="Edit Job"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <button
                                        wire:click="deleteJob({{ $jobPost->id }})"
                                        wire:confirm="Are you sure you want to delete this job post?"
                                        class="p-2 rounded-lg text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all duration-200"
                                        title="Delete Job"
                                    >
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <h3 class="mt-4 text-sm font-semibold text-slate-900">No job posts found</h3>
                                <p class="mt-2 text-sm text-slate-500">
                                    @if($search || $statusFilter)
                                        Try adjusting your filters.
                                    @else
                                        Start by creating your first job post.
                                    @endif
                                </p>
                                @if($search || $statusFilter)
                                    <button 
                                        wire:click="clearFilters"
                                        class="mt-4 inline-flex items-center text-sm font-medium text-slate-900 hover:text-black transition"
                                    >
                                        Clear filters
                                    </button>
                                @else
                                    <a 
                                        href="{{ route('recruiter.job-posts.create') }}"
                                        class="mt-4 inline-flex items-center gap-2 rounded-lg bg-slate-900 px-4 py-2 text-xs font-semibold text-white hover:bg-slate-800 transition"
                                    >
                                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        Create Job Post
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        <div wire:loading.remove>
            @if($jobPosts->hasPages())
                <div class="border-t border-slate-200 px-6 py-4">
                    {{ $jobPosts->links() }}
                </div>
            @endif
        </div>
        
        {{-- Pagination Shimmer --}}
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
    </div>
</div>