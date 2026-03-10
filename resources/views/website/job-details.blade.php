@extends('website.layouts.app')

@section('title', ($jobPost->title ?? 'Job Details') . ' | SMTJobs')

@section('content')
    @php
        $company = $jobPost->company;
        $detail = $jobPost->detail;
        $city = $jobPost->city;
        $category = $jobPost->category;
        $industry = $jobPost->industry;
        $employmentType = $jobPost->employmentType;
        $experienceRange = $jobPost->experienceRange;
        
        $locationLabel = $city?->name ?? 'Not specified';
        if ($jobPost->is_remote) {
            $locationLabel .= ' · Remote';
        }
        
        $salaryLabel = ($jobPost->min_salary && $jobPost->max_salary)
            ? 'LKR ' . number_format($jobPost->min_salary) . ' - ' . number_format($jobPost->max_salary) . ' per month'
            : 'Competitive salary';
            
        $experienceLabel = $experienceRange?->name ?? $experienceRange?->label ?? 'Not specified';
        $typeLabel = $employmentType?->label ?? $employmentType?->name ?? 'Full-time';
        $postedAgo = $jobPost->published_at?->diffForHumans() ?? $jobPost->created_at->diffForHumans();
        $companyInitials = strtoupper(substr($company->name ?? 'SM', 0, 2));
        $badgeLabel = $jobPost->is_featured ? 'Featured' : ($jobPost->is_remote ? 'Remote' : 'Hiring');
        
        // Get similar jobs (same category or industry)
        $similarJobs = \App\Models\JobPost::with(['company', 'city', 'employmentType', 'experienceRange'])
            ->where('id', '!=', $jobPost->id)
            ->where('is_active', true)
            ->where('job_status_id', 1)
            ->where(function($q) use ($jobPost) {
                $q->where('category_id', $jobPost->category_id)
                  ->orWhere('industry_id', $jobPost->industry_id);
            })
            ->latest()
            ->take(3)
            ->get();
    @endphp

    {{-- Breadcrumb Navigation --}}
    <div class="bg-slate-50border-b border-slate-200">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center gap-2 text-sm text-slate-600" aria-label="Breadcrumb">
                <a href="{{ route('home') }}" class="hover:text-slate-900 transition">Home</a>
                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <a href="{{ route('jobs') }}" class="hover:text-slate-900 transition">Jobs</a>
                <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="text-slate-900 font-medium truncate">{{ Str::limit($jobPost->title, 50) }}</span>
            </nav>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8 pb-16">
        <div class="grid gap-8 lg:grid-cols-[1fr_380px]">
            {{-- Main Content --}}
            <div class="space-y-6">
                {{-- Job Header Card --}}
                <article class="rounded-2xl border border-slate-200 bg-white p-6 lg:p-8 shadow-sm">
                    {{-- Logo, Title & Company --}}
                    <div class="flex items-start justify-between gap-6 mb-6">
                        <div class="flex items-start gap-4 flex-1">
                            <div class="flex h-16 w-16 flex-shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-slate-800 to-black text-white text-2xl font-bold shadow-lg">
                                {{ $companyInitials }}
                            </div>
                            <div class="flex-1">
                                
                                <h1 class="text-3xl lg:text-4xl font-bold text-slate-900 leading-tight">
                                    {{ $jobPost->title }}
                                </h1>
                                <div class="flex items-center gap-2 text-lg">
                                    <a href="#" class="font-semibold text-slate-900 hover:text-slate-700 transition">
                                        {{ $company->name }}
                                    </a>
                                    <svg class="h-5 w-5 text-slate-700" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                        <button class="rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-red-500 transition flex-shrink-0" title="Save job">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </button>
                    </div>

                    {{-- Key Details Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 py-6 border-y border-slate-200">
                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-slate-900">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Job Type</p>
                                <p class="mt-1 text-sm font-semibold text-slate-900 truncate">{{ $typeLabel }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-slate-900 ">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Salary</p>
                                <p class="mt-1 text-sm font-semibold text-slate-900 truncate">{{ $salaryLabel }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-slate-900">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Experience</p>
                                <p class="mt-1 text-sm font-semibold text-slate-900 truncate">{{ $experienceLabel }}</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-lg bg-slate-900">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="min-w-0">
                                <p class="text-xs font-medium text-slate-500 uppercase tracking-wider">Location</p>
                                <p class="mt-1 text-sm font-semibold text-slate-900 truncate">{{ $locationLabel }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Meta Info --}}
                    <div class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-2 text-sm text-slate-600">
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $postedAgo }}</span>
                        </div>
                        @if($category)
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                            <span>{{ $category->label ?? $category->name }}</span>
                        </div>
                        @endif
                        @if($industry)
                        <div class="flex items-center gap-2">
                            <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span>{{ $industry->label ?? $industry->name }}</span>
                        </div>
                        @endif
                    </div>
                </article>

                {{-- Job Description --}}
                @if($detail && $detail->description)
                <div class="rounded-2xl border border-slate-200 bg-white p-6 lg:p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-slate-100">
                            <svg class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900">Job Description</h2>
                    </div>
                    <div class="prose prose-slate max-w-none">
                        <p class="text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $detail->description }}</p>
                    </div>
                </div>
                @endif

                {{-- Responsibilities --}}
                @if($detail && $detail->responsibilities)
                <div class="rounded-2xl border border-slate-200 bg-white p-6 lg:p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-slate-900">
                            <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900">Responsibilities</h2>
                    </div>
                    <div class="prose prose-slate max-w-none">
                        <p class="text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $detail->responsibilities }}</p>
                    </div>
                </div>
                @endif

                {{-- Requirements --}}
                @if($detail && $detail->requirements)
                <div class="rounded-2xl border border-slate-200 bg-white p-6 lg:p-8 shadow-sm">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-slate-900">
                            <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900">Requirements</h2>
                    </div>
                    <div class="prose prose-slate max-w-none">
                        <p class="text-slate-700 leading-relaxed whitespace-pre-wrap">{{ $detail->requirements }}</p>
                    </div>
                </div>
                @endif
            </div>

            {{-- Sidebar --}}
            <aside class="space-y-6">
                {{-- Apply Card (Sticky) --}}
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-lg lg:sticky lg:top-6">
                    <div class="space-y-4">
                        @auth
                            @if(auth()->user()->isCandidate())
                                @if($hasApplied ?? false)
                                    <button disabled class="block w-full rounded-xl bg-slate-200 px-6 py-4 text-center text-base font-bold text-slate-500 shadow-lg cursor-not-allowed">
                                        ✓ Already Applied
                                    </button>
                                @else
                                    <form action="{{ route('candidate.job.apply', $jobPost->id) }}" method="POST" id="applyForm">
                                        @csrf
                                        <button type="submit" class="block w-full rounded-xl bg-slate-900 px-6 py-4 text-center text-base font-bold text-white shadow-lg transition hover:bg-black hover:shadow-xl hover:scale-105 active:scale-95">
                                            Apply for this Job
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="block w-full rounded-xl bg-slate-900 px-6 py-4 text-center text-base font-bold text-white shadow-lg transition hover:bg-black hover:shadow-xl hover:scale-105 active:scale-95">
                                    Login to Apply
                                </a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="block w-full rounded-xl bg-slate-900 px-6 py-4 text-center text-base font-bold text-white shadow-lg transition hover:bg-black hover:shadow-xl hover:scale-105 active:scale-95">
                                Login to Apply
                            </a>
                        @endauth
                        
                        <div class="grid grid-cols-2 gap-2">
                            @auth
                                @if(auth()->user()->isCandidate())
                                    <form action="{{ route('candidate.job.toggle-save', $jobPost->id) }}" method="POST" class="save-job-form">
                                        @csrf
                                        <button type="submit" class="w-full rounded-lg border-2 {{ ($isSaved ?? false) ? 'border-slate-900 bg-slate-900 text-white' : 'border-slate-200 text-slate-900' }} px-4 py-2.5 text-sm font-semibold transition hover:bg-slate-100 hover:border-slate-900 {{ ($isSaved ?? false) ? 'hover:bg-slate-800' : '' }}">
                                            {{ ($isSaved ?? false) ? '✓ Saved' : 'Save Job' }}
                                        </button>
                                    </form>
                                @else
                                    <button onclick="window.location.href='{{ route('login') }}'" class="rounded-lg border-2 border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-900 transition hover:bg-slate-100 hover:border-slate-900">
                                        Save Job
                                    </button>
                                @endif
                            @else
                                <button onclick="window.location.href='{{ route('login') }}'" class="rounded-lg border-2 border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-900 transition hover:bg-slate-100 hover:border-slate-900">
                                    Save Job
                                </button>
                            @endauth
                            <button class="rounded-lg border-2 border-slate-200 px-4 py-2.5 text-sm font-semibold text-slate-900 transition hover:bg-slate-100 hover:border-slate-900" onclick="shareJob()">
                                Share
                            </button>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-slate-200 space-y-3">
                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-500">Quick Actions</p>
                        <button class="w-full flex items-center gap-3 rounded-lg p-3 text-left text-sm hover:bg-slate-100 transition">
                            <svg class="h-5 w-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span class="font-medium text-slate-900">Email this job</span>
                        </button>
                        <button class="w-full flex items-center gap-3 rounded-lg p-3 text-left text-sm hover:bg-slate-100 transition">
                            <svg class="h-5 w-5 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                            </svg>
                            <span class="font-medium text-slate-900">Report this job</span>
                        </button>
                    </div>
                </div>

                {{-- Similar Jobs --}}
                @if($similarJobs->isNotEmpty())
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h3 class="text-sm font-bold uppercase tracking-wider text-slate-500 mb-4">Similar Jobs</h3>
                    <div class="space-y-3">
                        @foreach($similarJobs as $similar)
                            @php
                                $similarCompany = $similar->company;
                                $similarLocation = $similar->city?->name ?? 'Remote';
                                $similarType = $similar->employmentType?->label ?? 'Full-time';
                            @endphp
                            <a href="{{ route('job.show', ['city' => $similar->city_slug, 'slug' => $similar->slug]) }}" class="group block rounded-lg border border-slate-200 bg-slate-50/50 p-4 transition hover:border-slate-900 hover:bg-slate-100 hover:shadow-sm">
                                <p class="font-semibold text-slate-900 group-hover:text-black transition mb-1">{{ Str::limit($similar->title, 40) }}</p>
                                <p class="text-xs text-slate-500 uppercase tracking-wide mb-2">{{ $similarCompany->name }}</p>
                                <div class="flex items-center gap-2 text-xs text-slate-600">
                                    <span class="flex items-center gap-1">
                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        </svg>
                                        {{ $similarLocation }}
                                    </span>
                                    <span>•</span>
                                    <span>{{ $similarType }}</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <a href="{{ route('jobs') }}" class="mt-4 block text-center text-sm font-semibold text-slate-900 hover:text-black">
                        View all jobs →
                    </a>
                </div>
                @endif
            </aside>
        </div>
    </div>
@endsection
