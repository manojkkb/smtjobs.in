@extends('website.layouts.app')

@section('title', $company->name . ' - Company Profile | SMTJobs')

@section('meta_description', $company->profile?->description ? Str::limit($company->profile->description, 150) : 'View company profile, open positions, and employee reviews.')

@section('content')
    <div class="bg-slate-50 min-h-screen">
        
        <!-- Company Header Section -->
        <section class="bg-white border-b-2 border-slate-200">
            <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6">
                    
                    <!-- Company Logo -->
                    <div class="flex-shrink-0">
                        @if($company->logo)
                            <img src="{{ asset('storage/' . $company->logo) }}" alt="{{ $company->name }}" class="h-24 w-24 md:h-32 md:w-32 rounded-2xl bg-slate-100 border-2 border-slate-200 object-contain shadow-lg">
                        @else
                            <div class="h-24 w-24 md:h-32 md:w-32 rounded-2xl bg-slate-100 border-2 border-slate-200 flex items-center justify-center shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 md:h-16 md:w-16 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Company Info -->
                    <div class="flex-1">
                        <div class="space-y-3">
                            <div>
                                <h1 class="text-3xl md:text-4xl font-bold text-black">{{ $company->name }}</h1>
                                <p class="text-base text-slate-600 mt-1">{{ $company->industry?->label ?? 'Industry' }}</p>
                            </div>
                            
                            <div class="flex flex-wrap items-center gap-4 text-sm text-slate-600">
                                @if($company->city)
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="font-semibold">{{ $company->city->name }}{{ $company->city->state ? ', ' . $company->city->state->name : '' }}{{ $company->city->state?->country ? ', ' . $company->city->state->country->name : '' }}</span>
                                </div>
                                @endif
                                @if($company->companySize)
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span class="font-semibold">{{ $company->companySize->name }}</span>
                                </div>
                                @endif
                                <div class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="font-semibold">{{ number_format($company->profile?->job_post_count ?? 0) }} Open Jobs</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Follow Section -->
                    <div class="flex flex-col items-center gap-3">
                        @auth
                            @if($isFollowing)
                                <button onclick="unfollowCompany('{{ $company->slug }}')" id="followBtn" class="inline-flex items-center gap-2 rounded-full bg-slate-200 px-8 py-3 text-base font-bold text-black shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl hover:bg-slate-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Following
                                </button>
                            @else
                                <button onclick="followCompany('{{ $company->slug }}')" id="followBtn" class="inline-flex items-center gap-2 rounded-full bg-black px-8 py-3 text-base font-bold text-white shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl hover:bg-slate-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Follow
                                </button>
                            @endif
                        @else
                            <button onclick="requireLogin()" class="inline-flex items-center gap-2 rounded-full bg-black px-8 py-3 text-base font-bold text-white shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl hover:bg-slate-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Follow
                            </button>
                        @endauth
                        <div class="text-center">
                            <p class="text-2xl font-bold text-black" id="followersCount">{{ number_format($company->profile?->followers_count ?? 0) }}</p>
                            <p class="text-xs text-slate-600 font-semibold">Followers</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        
        <!-- Tabs Section -->
        <section class="bg-white border-b-2 border-slate-200 sticky top-0 z-10">
            <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8">
                <div class="flex gap-1">
                    <a href="{{ route('company.show', ['companySlug' => $company->slug]) }}" 
                       class="px-6 py-4 text-base font-bold border-b-4 transition-colors {{ $activeTab === 'overview' ? 'border-black text-black' : 'border-transparent text-slate-600 hover:text-black' }}">
                        Overview
                    </a>
                    <a href="{{ route('company.jobs', ['companySlug' => $company->slug]) }}" 
                       class="px-6 py-4 text-base font-bold border-b-4 transition-colors {{ $activeTab === 'jobs' ? 'border-black text-black' : 'border-transparent text-slate-600 hover:text-black' }}">
                        Jobs
                        <span class="ml-2 inline-flex items-center rounded-full bg-slate-900 px-2.5 py-0.5 text-xs font-bold text-white">{{ number_format($company->profile?->job_post_count ?? 0) }}</span>
                    </a>
                    <a href="{{ route('company.reviews', ['companySlug' => $company->slug]) }}" 
                       class="px-6 py-4 text-base font-bold border-b-4 transition-colors {{ $activeTab === 'reviews' ? 'border-black text-black' : 'border-transparent text-slate-600 hover:text-black' }}">
                        Reviews
                        <span class="ml-2 inline-flex items-center rounded-full bg-slate-900 px-2.5 py-0.5 text-xs font-bold text-white">{{ number_format($company->profile?->review_count ?? 0) }}</span>
                    </a>
                </div>
            </div>
        </section>
        
        <!-- Tab Content -->
        <div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 py-8">
            
            @if($activeTab === 'overview')
            <!-- Overview Tab -->
            <div class="space-y-8">
                
                <!-- About Company -->
                <section class="bg-white rounded-3xl p-8 shadow-lg border-2 border-slate-200">
                    <h2 class="text-2xl font-bold text-black mb-4">About Company</h2>
                    @if($company->profile?->description)
                        <div class="space-y-4 text-slate-700 leading-relaxed">
                            {!! nl2br(e($company->profile->description)) !!}
                        </div>
                    @else
                        <p class="text-slate-600">No company description available.</p>
                    @endif
                </section>
                
                <!-- Company Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @if($company->profile?->founded_year)
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-slate-200 hover:border-black transition-colors">
                        <p class="text-3xl font-bold text-black">{{ $company->profile->founded_year }}</p>
                        <p class="text-sm text-slate-600 font-semibold mt-1">Founded</p>
                    </div>
                    @endif
                    @if($company->profile?->employee_count)
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-slate-200 hover:border-black transition-colors">
                        <p class="text-3xl font-bold text-black">{{ number_format($company->profile->employee_count) }}+</p>
                        <p class="text-sm text-slate-600 font-semibold mt-1">Employees</p>
                    </div>
                    @endif
                    @if($company->profile?->job_post_count)
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-slate-200 hover:border-black transition-colors">
                        <p class="text-3xl font-bold text-black">{{ number_format($company->profile->job_post_count) }}</p>
                        <p class="text-sm text-slate-600 font-semibold mt-1">Open Jobs</p>
                    </div>
                    @endif
                    @if($company->profile?->average_rating)
                    <div class="bg-white rounded-2xl p-6 shadow-lg border-2 border-slate-200 hover:border-black transition-colors">
                        <p class="text-3xl font-bold text-black">{{ number_format($company->profile->average_rating, 1) }}/5</p>
                        <p class="text-sm text-slate-600 font-semibold mt-1">Rating</p>
                    </div>
                    @endif
                </div>
                
                <!-- Company Culture -->
                <section class="bg-white rounded-3xl p-8 shadow-lg border-2 border-slate-200">
                    <h2 class="text-2xl font-bold text-black mb-6">Why Join Us?</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 rounded-xl bg-black flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold text-black mb-2">Learning & Development</h3>
                                <p class="text-sm text-slate-600">Continuous learning opportunities with world-class training programs and certifications.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 rounded-xl bg-black flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold text-black mb-2">Global Exposure</h3>
                                <p class="text-sm text-slate-600">Work with clients across the globe and gain international experience.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 rounded-xl bg-black flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold text-black mb-2">Career Growth</h3>
                                <p class="text-sm text-slate-600">Clear career progression paths with opportunities to grow vertically and horizontally.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <div class="h-12 w-12 rounded-xl bg-black flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h3 class="font-bold text-black mb-2">Work-Life Balance</h3>
                                <p class="text-sm text-slate-600">Flexible work arrangements and comprehensive wellness programs.</p>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Contact Info -->
                <section class="bg-white rounded-3xl p-8 shadow-lg border-2 border-slate-200">
                    <h2 class="text-2xl font-bold text-black mb-6">Contact Information</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        @if($company->profile?->email)
                        <div class="flex items-start gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-slate-600">Email</p>
                                <p class="text-base font-bold text-black">{{ $company->profile->email }}</p>
                            </div>
                        </div>
                        @endif
                        @if($company->profile?->website)
                        <div class="flex items-start gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-slate-600">Website</p>
                                <a href="{{ $company->profile->website }}" target="_blank" class="text-base font-bold text-black hover:underline">{{ $company->profile->website }}</a>
                            </div>
                        </div>
                        @endif
                        @if($company->profile?->headquarters || $company->city)
                        <div class="flex items-start gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-slate-600">Headquarters</p>
                                <p class="text-base font-bold text-black">
                                    {{ $company->profile?->headquarters ?? ($company->city ? $company->city->name . ', ' . ($company->city->state?->name ?? '') . ', ' . ($company->city->state?->country?->name ?? '') : 'N/A') }}
                                </p>
                            </div>
                        </div>
                        @endif
                        @if($company->industry)
                        <div class="flex items-start gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-slate-600">Industry</p>
                                <p class="text-base font-bold text-black">{{ $company->industry->label }}</p>
                            </div>
                        </div>
                        @endif
                        @if($company->profile?->phone)
                        <div class="flex items-start gap-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-slate-600">Phone</p>
                                <p class="text-base font-bold text-black">{{ $company->profile->phone }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </section>
                    </div>
                </section>
                
            </div>
            
            @elseif($activeTab === 'jobs')
            <!-- Jobs Tab -->
            <div class="space-y-4">
                
                <!-- Job Search/Filter -->
                <section class="bg-white rounded-3xl p-6 shadow-lg border-2 border-slate-200">
                    <div class="flex flex-wrap gap-4">
                        <input type="text" placeholder="Search jobs..." class="flex-1 min-w-[240px] rounded-xl border-2 border-slate-200 px-4 py-3 text-sm font-medium focus:border-black focus:outline-none">
                        <select class="rounded-xl border-2 border-slate-200 px-4 py-3 text-sm font-medium focus:border-black focus:outline-none">
                            <option>All Locations</option>
                            <option>Bangalore</option>
                            <option>Mumbai</option>
                            <option>Pune</option>
                        </select>
                        <select class="rounded-xl border-2 border-slate-200 px-4 py-3 text-sm font-medium focus:border-black focus:outline-none">
                            <option>All Departments</option>
                            <option>Engineering</option>
                            <option>Sales</option>
                            <option>Marketing</option>
                        </select>
                    </div>
                </section>
                
                <!-- Job Listings -->
                @if($company->jobPosts && $company->jobPosts->count() > 0)
                    @foreach($company->jobPosts as $job)
                        <article class="bg-white rounded-3xl p-6 shadow-lg border-2 border-slate-200 hover:border-black transition-all hover:-translate-y-1 hover:shadow-2xl">
                            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                                <div class="flex-1">
                                    <h3 class="text-xl font-bold text-black mb-2">{{ $job->title }}</h3>
                                    <div class="flex flex-wrap gap-4 text-sm text-slate-600">
                                        @if($job->city)
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            </svg>
                                            <span class="font-semibold">{{ $job->city->name }}{{ $job->is_remote ? ' (Remote)' : '' }}</span>
                                        </div>
                                        @endif
                                        @if($job->experienceRange)
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            <span class="font-semibold">{{ $job->experienceRange->name }}</span>
                                        </div>
                                        @endif
                                        <div class="flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            <span class="font-semibold">{{ $job->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex gap-3">
                                    <button class="rounded-full border-2 border-black px-6 py-2 text-sm font-bold text-black transition-all hover:bg-black hover:text-white">
                                        Save
                                    </button>
                                    <button class="rounded-full bg-black px-6 py-2 text-sm font-bold text-white transition-all hover:bg-slate-800">
                                        Apply Now
                                    </button>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @else
                    <div class="bg-white rounded-3xl p-12 shadow-lg border-2 border-slate-200 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <h3 class="text-xl font-bold text-black mb-2">No Open Positions</h3>
                        <p class="text-slate-600">There are currently no job openings at {{ $company->name }}. Check back later!</p>
                    </div>
                @endif
                
                <!-- View All Jobs Button -->
                @if($company->jobPosts && $company->jobPosts->count() > 0)
                <div class="text-center pt-4">
                    <a href="{{ route('company.jobs', ['companySlug' => $company->slug]) }}" class="inline-flex items-center gap-2 rounded-full border-2 border-black px-8 py-3 text-base font-bold text-black transition-all hover:bg-black hover:text-white">
                        View All {{ number_format($company->jobPosts->count()) }} Jobs
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                @endif
                
            </div>
            
            @elseif($activeTab === 'reviews')
            <!-- Reviews Tab -->
            <div class="space-y-6">
                
                <!-- Overall Rating -->
                <section class="bg-white rounded-3xl p-8 shadow-lg border-2 border-slate-200">
                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="text-center md:text-left">
                            <p class="text-6xl font-bold text-black mb-2">{{ $company->profile?->average_rating ? number_format($company->profile->average_rating, 1) : 'N/A' }}</p>
                            @if($company->profile?->average_rating)
                            <div class="flex items-center justify-center md:justify-start gap-1 mb-2">
                                @for($i = 0; $i < 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 {{ $i < round($company->profile->average_rating) ? 'text-yellow-400' : 'text-slate-300' }}" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                    </svg>
                                @endfor
                            </div>
                            @endif
                            <p class="text-sm text-slate-600 font-semibold">Based on {{ number_format($company->profile?->review_count ?? 0) }} reviews</p>
                        </div>
                        <div class="space-y-2">
                            @foreach($ratingDistribution as $rating)
                                <div class="flex items-center gap-3">
                                    <span class="text-sm font-semibold text-slate-600 w-12">{{ $rating['stars'] }} star</span>
                                    <div class="flex-1 h-3 bg-slate-200 rounded-full overflow-hidden">
                                        <div class="h-full bg-yellow-400 rounded-full" style="width: {{ $rating['percentage'] }}%"></div>
                                    </div>
                                    <span class="text-sm font-semibold text-slate-600 w-12 text-right">{{ $rating['percentage'] }}%</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                
                <!-- Individual Reviews -->
                @if($reviews->count() > 0)
                    @foreach($reviews as $review)
                        <article class="bg-white rounded-3xl p-6 shadow-lg border-2 border-slate-200">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    @if($review->is_anonymous)
                                        <h3 class="font-bold text-black">Anonymous</h3>
                                        <p class="text-sm text-slate-600">Employee</p>
                                    @else
                                        <h3 class="font-bold text-black">{{ $review->user->name }}</h3>
                                        <p class="text-sm text-slate-600">Employee</p>
                                    @endif
                                </div>
                                <span class="text-sm text-slate-500 font-semibold">{{ $review->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="flex items-center gap-1 mb-3">
                                @for($i = 0; $i < 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 {{ $i < $review->rating ? 'text-yellow-400' : 'text-slate-300' }}" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                    </svg>
                                @endfor
                            </div>
                            @if($review->review)
                                <p class="text-slate-700 leading-relaxed mb-3">{{ $review->review }}</p>
                            @endif
                            @if($review->pros || $review->cons)
                                <div class="grid md:grid-cols-2 gap-4 pt-3 border-t border-slate-200">
                                    @if($review->pros)
                                        <div>
                                            <p class="text-sm font-bold text-green-700 mb-2">Pros</p>
                                            <p class="text-sm text-slate-600">{{ $review->pros }}</p>
                                        </div>
                                    @endif
                                    @if($review->cons)
                                        <div>
                                            <p class="text-sm font-bold text-red-700 mb-2">Cons</p>
                                            <p class="text-sm text-slate-600">{{ $review->cons }}</p>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </article>
                    @endforeach
                @else
                    <div class="bg-white rounded-3xl p-12 shadow-lg border-2 border-slate-200 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto mb-4 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        <h3 class="text-xl font-bold text-black mb-2">No Reviews Yet</h3>
                        <p class="text-slate-600">Be the first to review {{ $company->name }}!</p>
                    </div>
                @endif
                
                <!-- Write Review Button -->
                <div class="text-center pt-4">
                    @auth
                        <button onclick="writeReview()" class="inline-flex items-center gap-2 rounded-full bg-black px-8 py-3 text-base font-bold text-white transition-all hover:bg-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            @if(isset($userReview))
                                Update Your Review
                            @else
                                Write a Review
                            @endif
                        </button>
                    @else
                        <button onclick="requireLogin()" class="inline-flex items-center gap-2 rounded-full bg-black px-8 py-3 text-base font-bold text-white transition-all hover:bg-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                            Write a Review
                        </button>
                    @endauth
                </div>
                
            </div>
            @endif
            
        </div>
        
    </div>
    
    <!-- Review Modal -->
    @auth
    <div id="reviewModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
            <form id="reviewForm" class="p-8">
                <!-- Modal Header -->
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-black" id="reviewModalTitle">
                        @if(isset($userReview))
                            Update Your Review
                        @else
                            Write a Review
                        @endif
                    </h2>
                    <button type="button" onclick="closeReviewModal()" class="text-slate-400 hover:text-black transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                
                <!-- Overall Rating -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-black mb-3">Overall Rating <span class="text-red-600">*</span></label>
                    <div class="flex gap-2">
                        <input type="radio" name="rating" value="1" id="rating1" class="hidden" required {{ isset($userReview) && $userReview->rating == 1 ? 'checked' : '' }}>
                        <input type="radio" name="rating" value="2" id="rating2" class="hidden" {{ isset($userReview) && $userReview->rating == 2 ? 'checked' : '' }}>
                        <input type="radio" name="rating" value="3" id="rating3" class="hidden" {{ isset($userReview) && $userReview->rating == 3 ? 'checked' : '' }}>
                        <input type="radio" name="rating" value="4" id="rating4" class="hidden" {{ isset($userReview) && $userReview->rating == 4 ? 'checked' : '' }}>
                        <input type="radio" name="rating" value="5" id="rating5" class="hidden" {{ isset($userReview) && $userReview->rating == 5 ? 'checked' : '' }}>
                        <div class="flex gap-1" id="starRating">
                            <svg onclick="setRating(1)" data-rating="1" class="star-icon h-10 w-10 cursor-pointer text-slate-300 hover:text-yellow-400 transition" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg onclick="setRating(2)" data-rating="2" class="star-icon h-10 w-10 cursor-pointer text-slate-300 hover:text-yellow-400 transition" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg onclick="setRating(3)" data-rating="3" class="star-icon h-10 w-10 cursor-pointer text-slate-300 hover:text-yellow-400 transition" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg onclick="setRating(4)" data-rating="4" class="star-icon h-10 w-10 cursor-pointer text-slate-300 hover:text-yellow-400 transition" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                            <svg onclick="setRating(5)" data-rating="5" class="star-icon h-10 w-10 cursor-pointer text-slate-300 hover:text-yellow-400 transition" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <!-- Review Text -->
                <div class="mb-6">
                    <label for="review" class="block text-sm font-bold text-black mb-2">Your Review</label>
                    <textarea name="review" id="review" rows="4" class="w-full rounded-2xl border-2 border-slate-200 px-4 py-3 text-sm focus:border-black focus:outline-none" placeholder="Share your experience working at this company...">{{ $userReview->review ?? '' }}</textarea>
                </div>
                
                <!-- Pros -->
                <div class="mb-6">
                    <label for="pros" class="block text-sm font-bold text-black mb-2">Pros</label>
                    <textarea name="pros" id="pros" rows="3" class="w-full rounded-2xl border-2 border-slate-200 px-4 py-3 text-sm focus:border-black focus:outline-none" placeholder="What are the benefits of working here?">{{ $userReview->pros ?? '' }}</textarea>
                </div>
                
                <!-- Cons -->
                <div class="mb-6">
                    <label for="cons" class="block text-sm font-bold text-black mb-2">Cons</label>
                    <textarea name="cons" id="cons" rows="3" class="w-full rounded-2xl border-2 border-slate-200 px-4 py-3 text-sm focus:border-black focus:outline-none" placeholder="What could be improved?">{{ $userReview->cons ?? '' }}</textarea>
                </div>
                
                <!-- Additional Ratings (Optional) -->
                <div class="mb-6">
                    <p class="text-sm font-bold text-black mb-4">Rate Specific Aspects (Optional)</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-2">Interview Process</label>
                            <select name="interview_process_rating" class="w-full rounded-xl border-2 border-slate-200 px-3 py-2 text-sm focus:border-black focus:outline-none">
                                <option value="">Select rating</option>
                                <option value="1" {{ isset($userReview) && $userReview->interview_process_rating == 1 ? 'selected' : '' }}>1 - Poor</option>
                                <option value="2" {{ isset($userReview) && $userReview->interview_process_rating == 2 ? 'selected' : '' }}>2 - Fair</option>
                                <option value="3" {{ isset($userReview) && $userReview->interview_process_rating == 3 ? 'selected' : '' }}>3 - Good</option>
                                <option value="4" {{ isset($userReview) && $userReview->interview_process_rating == 4 ? 'selected' : '' }}>4 - Very Good</option>
                                <option value="5" {{ isset($userReview) && $userReview->interview_process_rating == 5 ? 'selected' : '' }}>5 - Excellent</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-2">Communication</label>
                            <select name="communication_rating" class="w-full rounded-xl border-2 border-slate-200 px-3 py-2 text-sm focus:border-black focus:outline-none">
                                <option value="">Select rating</option>
                                <option value="1" {{ isset($userReview) && $userReview->communication_rating == 1 ? 'selected' : '' }}>1 - Poor</option>
                                <option value="2" {{ isset($userReview) && $userReview->communication_rating == 2 ? 'selected' : '' }}>2 - Fair</option>
                                <option value="3" {{ isset($userReview) && $userReview->communication_rating == 3 ? 'selected' : '' }}>3 - Good</option>
                                <option value="4" {{ isset($userReview) && $userReview->communication_rating == 4 ? 'selected' : '' }}>4 - Very Good</option>
                                <option value="5" {{ isset($userReview) && $userReview->communication_rating == 5 ? 'selected' : '' }}>5 - Excellent</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-2">Salary & Benefits</label>
                            <select name="salary_rating" class="w-full rounded-xl border-2 border-slate-200 px-3 py-2 text-sm focus:border-black focus:outline-none">
                                <option value="">Select rating</option>
                                <option value="1" {{ isset($userReview) && $userReview->salary_rating == 1 ? 'selected' : '' }}>1 - Poor</option>
                                <option value="2" {{ isset($userReview) && $userReview->salary_rating == 2 ? 'selected' : '' }}>2 - Fair</option>
                                <option value="3" {{ isset($userReview) && $userReview->salary_rating == 3 ? 'selected' : '' }}>3 - Good</option>
                                <option value="4" {{ isset($userReview) && $userReview->salary_rating == 4 ? 'selected' : '' }}>4 - Very Good</option>
                                <option value="5" {{ isset($userReview) && $userReview->salary_rating == 5 ? 'selected' : '' }}>5 - Excellent</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-600 mb-2">Work Culture</label>
                            <select name="work_culture_rating" class="w-full rounded-xl border-2 border-slate-200 px-3 py-2 text-sm focus:border-black focus:outline-none">
                                <option value="">Select rating</option>
                                <option value="1" {{ isset($userReview) && $userReview->work_culture_rating == 1 ? 'selected' : '' }}>1 - Poor</option>
                                <option value="2" {{ isset($userReview) && $userReview->work_culture_rating == 2 ? 'selected' : '' }}>2 - Fair</option>
                                <option value="3" {{ isset($userReview) && $userReview->work_culture_rating == 3 ? 'selected' : '' }}>3 - Good</option>
                                <option value="4" {{ isset($userReview) && $userReview->work_culture_rating == 4 ? 'selected' : '' }}>4 - Very Good</option>
                                <option value="5" {{ isset($userReview) && $userReview->work_culture_rating == 5 ? 'selected' : '' }}>5 - Excellent</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Anonymous Option -->
                <div class="mb-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_anonymous" value="1" {{ isset($userReview) && $userReview->is_anonymous ? 'checked' : '' }} class="rounded border-slate-300 text-black focus:ring-black">
                        <span class="text-sm font-semibold text-slate-700">Post anonymously</span>
                    </label>
                </div>
                
                <!-- Submit Buttons -->
                <div class="flex gap-3">
                    <button type="button" onclick="closeReviewModal()" class="flex-1 rounded-full border-2 border-slate-200 px-6 py-3 text-base font-bold text-black transition-all hover:bg-slate-50">
                        Cancel
                    </button>
                    <button type="submit" id="submitReviewBtn" class="flex-1 rounded-full bg-black px-6 py-3 text-base font-bold text-white transition-all hover:bg-slate-800">
                        @if(isset($userReview))
                            Update Review
                        @else
                            Submit Review
                        @endif
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endauth
@endsection

@push('scripts')
<script>
    // CSRF token for AJAX requests
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    
    // Require login function
    function requireLogin() {
        if (confirm('Please login to continue. Do you want to go to the login page?')) {
            window.location.href = '{{ route("login") }}';
        }
    }
    
    // Follow company function
    async function followCompany(companySlug) {
        const btn = document.getElementById('followBtn');
        const originalContent = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
        
        try {
            const response = await fetch(`/company/${companySlug}/follow`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            
            const data = await response.json();
            
            if (response.status === 401) {
                if (confirm(data.message + '. Do you want to go to the login page?')) {
                    window.location.href = data.redirect;
                }
                btn.disabled = false;
                btn.innerHTML = originalContent;
                return;
            }
            
            if (data.success) {
                // Update followers count
                document.getElementById('followersCount').textContent = data.followers_count.toLocaleString();
                
                // Update button to "Following"
                btn.className = 'inline-flex items-center gap-2 rounded-full bg-slate-200 px-8 py-3 text-base font-bold text-black shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl hover:bg-slate-300';
                btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg> Following';
                btn.onclick = () => unfollowCompany(companySlug);
                
                // Show success message
                showNotification(data.message, 'success');
            } else {
                showNotification(data.message, 'error');
                btn.innerHTML = originalContent;
            }
            
            btn.disabled = false;
        } catch (error) {
            console.error('Error:', error);
            showNotification('Failed to follow company. Please try again.', 'error');
            btn.disabled = false;
            btn.innerHTML = originalContent;
        }
    }
    
    // Unfollow company function
    async function unfollowCompany(companySlug) {
        const btn = document.getElementById('followBtn');
        const originalContent = btn.innerHTML;
        btn.disabled = true;
        btn.innerHTML = '<svg class="animate-spin h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
        
        try {
            const response = await fetch(`/company/${companySlug}/unfollow`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                // Update followers count
                document.getElementById('followersCount').textContent = data.followers_count.toLocaleString();
                
                // Update button to "Follow"
                btn.className = 'inline-flex items-center gap-2 rounded-full bg-black px-8 py-3 text-base font-bold text-white shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl hover:bg-slate-800';
                btn.innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg> Follow';
                btn.onclick = () => followCompany(companySlug);
                
                // Show success message
                showNotification(data.message, 'success');
            } else {
                showNotification(data.message, 'error');
                btn.innerHTML = originalContent;
            }
            
            btn.disabled = false;
        } catch (error) {
            console.error('Error:', error);
            showNotification('Failed to unfollow company. Please try again.', 'error');
            btn.disabled = false;
            btn.innerHTML = originalContent;
        }
    }
    
    // Write review function
    function writeReview() {
        document.getElementById('reviewModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        
        // If there's an existing rating, display the stars correctly
        @if(isset($userReview) && $userReview->rating)
            setRating({{ $userReview->rating }});
        @endif
    }
    
    // Close review modal
    function closeReviewModal() {
        document.getElementById('reviewModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('reviewForm').reset();
        // Reset star ratings
        document.querySelectorAll('.star-icon').forEach(star => {
            star.classList.remove('text-yellow-400');
            star.classList.add('text-slate-300');
        });
    }
    
    // Set rating
    function setRating(rating) {
        // Update radio button
        document.getElementById(`rating${rating}`).checked = true;
        
        // Update star display
        document.querySelectorAll('.star-icon').forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-slate-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-slate-300');
            }
        });
    }
    
    // Submit review
    @auth
    document.getElementById('reviewForm')?.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const btn = document.getElementById('submitReviewBtn');
        const originalText = btn.textContent;
        btn.disabled = true;
        btn.innerHTML = '<svg class="animate-spin h-5 w-5 mx-auto" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
        
        const formData = new FormData(this);
        const data = Object.fromEntries(formData.entries());
        
        try {
            const response = await fetch(`/company/{{ $company->slug }}/review`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(data)
            });
            
            const result = await response.json();
            
            if (result.success) {
                showNotification(result.message, 'success');
                closeReviewModal();
                // Optionally reload the page to show the new review
                setTimeout(() => {
                    window.location.href = '{{ route("company.reviews", ["companySlug" => $company->slug]) }}';
                }, 2000);
            } else {
                showNotification(result.message, 'error');
                btn.disabled = false;
                btn.textContent = originalText;
            }
        } catch (error) {
            console.error('Error:', error);
            showNotification('Failed to submit review. Please try again.', 'error');
            btn.disabled = false;
            btn.textContent = originalText;
        }
    });
    @endauth
    
    // Show notification function
    function showNotification(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 rounded-2xl px-6 py-4 shadow-2xl transition-all duration-300 ${
            type === 'success' ? 'bg-green-600' : 
            type === 'error' ? 'bg-red-600' : 
            'bg-black'
        } text-white font-semibold`;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.opacity = '0';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
</script>
@endpush
