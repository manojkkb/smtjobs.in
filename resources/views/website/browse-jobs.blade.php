@extends('website.layouts.app')

@section('title', 'Browse Jobs | SMTJobs - Find Jobs by Company, Role, Location & Industry')

@section('meta_description', 'Browse thousands of job openings organized by company, role, location, industry and category. Find your perfect job opportunity.')

@section('meta_keywords', 'browse jobs, jobs by company, jobs by location, jobs by industry, job categories')

@section('content')
    <div class="mx-auto w-full max-w-7xl space-y-16 px-4 py-12 sm:px-6 lg:px-8">
        
        <!-- Hero Header -->
        <section class="text-center space-y-6">
            <div class="inline-flex items-center gap-2 rounded-full bg-black px-5 py-2 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <span class="text-sm font-bold uppercase tracking-wider text-white">Browse All Jobs</span>
            </div>
            
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-black leading-tight">
                Find Jobs Your <span class="text-slate-600">Way</span>
            </h1>
            
            <p class="text-lg sm:text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed">
                Explore thousands of opportunities organized by company, role, location, industry, and category
            </p>
        </section>

        <!-- Jobs by Company -->
        <section class="space-y-8">
            <div class="flex items-center justify-between">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 rounded-full bg-black px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-white">Companies</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-black">Jobs by Company</h2>
                    <p class="text-sm text-slate-600">Browse opportunities from top hiring companies</p>
                </div>
                <a href="{{ route('jobs') }}?browse=company" class="inline-flex items-center gap-2 text-sm font-semibold text-black hover:text-slate-600 transition group">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
            
            <div class="grid gap-4 grid-cols-2 sm:grid-cols-3 lg:grid-cols-4">
                @php
                    $companies = [
                        ['name' => 'TCS', 'jobs' => 156, 'logo' => 'T'],
                        ['name' => 'Infosys', 'jobs' => 142, 'logo' => 'I'],
                        ['name' => 'Wipro', 'jobs' => 128, 'logo' => 'W'],
                        ['name' => 'HCL Technologies', 'jobs' => 115, 'logo' => 'H'],
                        ['name' => 'Tech Mahindra', 'jobs' => 98, 'logo' => 'T'],
                        ['name' => 'Accenture', 'jobs' => 87, 'logo' => 'A'],
                        ['name' => 'Cognizant', 'jobs' => 76, 'logo' => 'C'],
                        ['name' => 'IBM India', 'jobs' => 65, 'logo' => 'I'],
                    ];
                @endphp
                
                @foreach($companies as $company)
                    <a href="{{ route('jobs') }}?company={{ Str::slug($company['name']) }}" 
                       class="group relative overflow-hidden rounded-3xl border-2 border-slate-200 bg-white p-6 shadow-lg transition-all hover:border-black hover:-translate-y-2 hover:shadow-2xl">
                        <div class="space-y-4">
                            <div class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-black text-xl font-bold text-white shadow-lg">
                                {{ $company['logo'] }}
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-black group-hover:text-slate-700 transition mb-1">{{ $company['name'] }}</h3>
                                <p class="text-sm font-semibold text-slate-600">{{ $company['jobs'] }} Open Positions</p>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Jobs by Role -->
        <section class="space-y-8">
            <div class="flex items-center justify-between">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 rounded-full bg-black px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-white">Job Roles</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-black">Jobs by Role</h2>
                    <p class="text-sm text-slate-600">Find jobs matching your expertise and career goals</p>
                </div>
                <a href="{{ route('jobs') }}?browse=role" class="inline-flex items-center gap-2 text-sm font-semibold text-black hover:text-slate-600 transition group">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
            
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @php
                    $roles = [
                        ['name' => 'Software Engineer', 'jobs' => 1245, 'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
                        ['name' => 'Data Scientist', 'jobs' => 892, 'icon' => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z'],
                        ['name' => 'Product Manager', 'jobs' => 567, 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01'],
                        ['name' => 'UI/UX Designer', 'jobs' => 423, 'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01'],
                        ['name' => 'DevOps Engineer', 'jobs' => 398, 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
                        ['name' => 'Business Analyst', 'jobs' => 312, 'icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
                    ];
                @endphp
                
                @foreach($roles as $role)
                    <a href="{{ route('jobs') }}?role={{ Str::slug($role['name']) }}" 
                       class="group relative overflow-hidden rounded-3xl border-2 border-slate-200 bg-white p-6 shadow-lg transition-all hover:border-black hover:-translate-y-2 hover:shadow-2xl">
                        <div class="flex items-start gap-4">
                            <div class="inline-flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-black shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $role['icon'] }}" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-black group-hover:text-slate-700 transition mb-1">{{ $role['name'] }}</h3>
                                <p class="text-sm font-semibold text-slate-600">{{ number_format($role['jobs']) }} Jobs</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 transition-all group-hover:text-black group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Jobs by Location -->
        <section class="space-y-8">
            <div class="flex items-center justify-between">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 rounded-full bg-black px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-white">Locations</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-black">Jobs by Location</h2>
                    <p class="text-sm text-slate-600">Discover opportunities in your preferred cities</p>
                </div>
                <a href="{{ route('jobs') }}?browse=location" class="inline-flex items-center gap-2 text-sm font-semibold text-black hover:text-slate-600 transition group">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
            
            <div class="grid gap-4 grid-cols-2 sm:grid-cols-3 lg:grid-cols-5">
                @php
                    $locations = [
                        ['city' => 'Bangalore', 'jobs' => 3245],
                        ['city' => 'Mumbai', 'jobs' => 2876],
                        ['city' => 'Pune', 'jobs' => 2134],
                        ['city' => 'Hyderabad', 'jobs' => 1987],
                        ['city' => 'Chennai', 'jobs' => 1765],
                        ['city' => 'Delhi NCR', 'jobs' => 1654],
                        ['city' => 'Kolkata', 'jobs' => 987],
                        ['city' => 'Ahmedabad', 'jobs' => 765],
                        ['city' => 'Kochi', 'jobs' => 543],
                        ['city' => 'Chandigarh', 'jobs' => 432],
                    ];
                @endphp
                
                @foreach($locations as $location)
                    <a href="{{ route('jobs') }}?location={{ $location['city'] }}" 
                       class="group relative overflow-hidden rounded-3xl border-2 border-slate-200 bg-white p-5 shadow-lg transition-all hover:border-black hover:-translate-y-2 hover:shadow-2xl">
                        <div class="space-y-3">
                            <div class="inline-flex h-10 w-10 items-center justify-center rounded-2xl bg-black shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-base font-bold text-black group-hover:text-slate-700 transition mb-1">{{ $location['city'] }}</h3>
                                <p class="text-xs font-semibold text-slate-600">{{ number_format($location['jobs']) }} Jobs</p>
                            </div>
                        </div>
                        <div class="absolute bottom-3 right-3">
                            <div class="h-2 w-2 rounded-full bg-black animate-pulse"></div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Jobs by Industry -->
        <section class="space-y-8">
            <div class="flex items-center justify-between">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 rounded-full bg-black px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-white">Industries</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-black">Jobs by Industry</h2>
                    <p class="text-sm text-slate-600">Explore opportunities across different sectors</p>
                </div>
                <a href="{{ route('jobs') }}?browse=industry" class="inline-flex items-center gap-2 text-sm font-semibold text-black hover:text-slate-600 transition group">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
            
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @php
                    $industries = [
                        ['name' => 'Information Technology', 'jobs' => 5432, 'color' => 'bg-black'],
                        ['name' => 'Banking & Finance', 'jobs' => 2876, 'color' => 'bg-slate-800'],
                        ['name' => 'Healthcare', 'jobs' => 1987, 'color' => 'bg-slate-700'],
                        ['name' => 'E-commerce', 'jobs' => 1654, 'color' => 'bg-slate-600'],
                        ['name' => 'Manufacturing', 'jobs' => 1432, 'color' => 'bg-slate-500'],
                        ['name' => 'Education', 'jobs' => 1234, 'color' => 'bg-slate-400'],
                        ['name' => 'Real Estate', 'jobs' => 876, 'color' => 'bg-slate-300'],
                        ['name' => 'Hospitality', 'jobs' => 654, 'color' => 'bg-slate-200'],
                    ];
                @endphp
                
                @foreach($industries as $industry)
                    <a href="{{ route('jobs') }}?industry={{ Str::slug($industry['name']) }}" 
                       class="group relative overflow-hidden rounded-3xl border-2 border-slate-200 bg-gradient-to-br from-white to-slate-50 p-6 shadow-lg transition-all hover:border-black hover:-translate-y-2 hover:shadow-2xl">
                        <div class="space-y-4">
                            <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl {{ $industry['color'] }} shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-black group-hover:text-slate-700 transition mb-1">{{ $industry['name'] }}</h3>
                                <p class="text-sm font-semibold text-slate-600">{{ number_format($industry['jobs']) }} Openings</p>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Jobs by Category -->
        <section class="space-y-8">
            <div class="flex items-center justify-between">
                <div class="space-y-2">
                    <div class="inline-flex items-center gap-2 rounded-full bg-black px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-white">Categories</span>
                    </div>
                    <h2 class="text-3xl sm:text-4xl font-bold text-black">Jobs by Category</h2>
                    <p class="text-sm text-slate-600">Browse jobs organized by functional areas</p>
                </div>
                <a href="{{ route('jobs') }}?browse=category" class="inline-flex items-center gap-2 text-sm font-semibold text-black hover:text-slate-600 transition group">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
            
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @php
                    $categories = [
                        ['name' => 'Engineering & Development', 'jobs' => 4567, 'icon' => 'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4'],
                        ['name' => 'Sales & Marketing', 'jobs' => 2345, 'icon' => 'M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z'],
                        ['name' => 'Finance & Accounting', 'jobs' => 1876, 'icon' => 'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['name' => 'Human Resources', 'jobs' => 1234, 'icon' => 'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z'],
                        ['name' => 'Operations & Logistics', 'jobs' => 987, 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                        ['name' => 'Customer Support', 'jobs' => 765, 'icon' => 'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z'],
                    ];
                @endphp
                
                @foreach($categories as $category)
                    <a href="{{ route('jobs') }}?category={{ Str::slug($category['name']) }}" 
                       class="group relative overflow-hidden rounded-3xl border-2 border-slate-200 bg-white p-6 shadow-lg transition-all hover:border-black hover:-translate-y-2 hover:shadow-2xl">
                        <div class="flex items-start gap-4">
                            <div class="inline-flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-2xl bg-black shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="{{ $category['icon'] }}" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-black group-hover:text-slate-700 transition mb-1">{{ $category['name'] }}</h3>
                                <p class="text-sm font-semibold text-slate-600">{{ number_format($category['jobs']) }} Positions</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 transition-all group-hover:text-black group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-slate-900 via-slate-800 to-black p-12 lg:p-16 shadow-2xl">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDE2djI4YTQgNCAwIDAgMS00IDRIMTZhNCA0IDAgMCAxLTQtNFYxNmE0IDQgMCAwIDEgNC00aDhtNCA0aDRtMCA0aDQiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
            
            <div class="relative text-center space-y-6">
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">
                    Can't Find What You're <span class="text-slate-300">Looking For?</span>
                </h2>
                
                <p class="text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed">
                    Use our advanced search to filter jobs by multiple criteria and find your perfect match
                </p>
                
                <div class="flex flex-wrap gap-4 justify-center pt-4">
                    <a href="{{ route('jobs') }}" 
                       class="group inline-flex items-center gap-2 rounded-full bg-white px-8 py-4 text-base font-semibold text-black shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl hover:bg-slate-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Advanced Job Search
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </section>

    </div>
@endsection
