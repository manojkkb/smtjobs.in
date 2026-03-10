@extends('website.layouts.app')

@section('title', 'View All Jobs - Find Jobs by Company, Role, Location & Industry | SMTJobs')

@section('meta_description', 'Browse all job opportunities by company, role, location, industry and category. Search and filter from 50000+ verified job listings in India.')

@section('meta_keywords', 'view all jobs, browse jobs India, jobs by company, jobs by location, jobs by industry')

@section('content')
    <div class="mx-auto w-full max-w-7xl space-y-12 px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Page Header with Search -->
        <section class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-slate-900 via-slate-800 to-black p-8 lg:p-12 shadow-2xl">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDE2djI4YTQgNCAwIDAgMS00IDRIMTZhNCA0IDAgMCAxLTQtNFYxNmE0IDQgMCAwIDEgNC00aDhtNCA0aDRtMCA0aDQiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
            
            <div class="relative space-y-8">
                <div class="text-center space-y-4">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-2 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-black">View All Jobs</span>
                    </div>
                    
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">
                        Discover Your Next <span class="text-slate-300">Opportunity</span>
                    </h1>
                    
                    <p class="text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
                        Search and filter from thousands of verified job listings. Find the perfect role by company, location, industry, or category.
                    </p>
                </div>

                <!-- Search Form -->
                <div class="max-w-4xl mx-auto">
                    <form action="{{ route('jobs') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Keyword Search -->
                            <div class="md:col-span-3 lg:col-span-1">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="keyword" placeholder="Job title, keywords..." 
                                           class="w-full rounded-2xl border-2 border-slate-200 bg-white py-4 pl-12 pr-4 text-sm font-medium text-slate-900 placeholder-slate-400 focus:border-black focus:outline-none focus:ring-2 focus:ring-black">
                                </div>
                            </div>

                            <!-- Location Search -->
                            <div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="location" placeholder="City, state..." 
                                           class="w-full rounded-2xl border-2 border-slate-200 bg-white py-4 pl-12 pr-4 text-sm font-medium text-slate-900 placeholder-slate-400 focus:border-black focus:outline-none focus:ring-2 focus:ring-black">
                                </div>
                            </div>

                            <!-- Category/Type -->
                            <div>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                    </div>
                                    <select name="category" 
                                            class="w-full rounded-2xl border-2 border-slate-200 bg-white py-4 pl-12 pr-4 text-sm font-medium text-slate-900 focus:border-black focus:outline-none focus:ring-2 focus:ring-black">
                                        <option value="">All Categories</option>
                                        <option value="engineering">Engineering</option>
                                        <option value="sales">Sales & Marketing</option>
                                        <option value="finance">Finance</option>
                                        <option value="hr">Human Resources</option>
                                        <option value="operations">Operations</option>
                                        <option value="support">Customer Support</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Advanced Filters Row -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <!-- Company -->
                            <div>
                                <select name="company" 
                                        class="w-full rounded-2xl border-2 border-slate-200 bg-white py-3 px-4 text-sm font-medium text-slate-900 focus:border-black focus:outline-none focus:ring-2 focus:ring-black">
                                    <option value="">All Companies</option>
                                    <option value="tcs">TCS</option>
                                    <option value="infosys">Infosys</option>
                                    <option value="wipro">Wipro</option>
                                    <option value="hcl">HCL Technologies</option>
                                </select>
                            </div>

                            <!-- Industry -->
                            <div>
                                <select name="industry" 
                                        class="w-full rounded-2xl border-2 border-slate-200 bg-white py-3 px-4 text-sm font-medium text-slate-900 focus:border-black focus:outline-none focus:ring-2 focus:ring-black">
                                    <option value="">All Industries</option>
                                    <option value="it">IT & Software</option>
                                    <option value="banking">Banking & Finance</option>
                                    <option value="healthcare">Healthcare</option>
                                    <option value="ecommerce">E-commerce</option>
                                </select>
                            </div>

                            <!-- Experience -->
                            <div>
                                <select name="experience" 
                                        class="w-full rounded-2xl border-2 border-slate-200 bg-white py-3 px-4 text-sm font-medium text-slate-900 focus:border-black focus:outline-none focus:ring-2 focus:ring-black">
                                    <option value="">Experience</option>
                                    <option value="0-2">0-2 years</option>
                                    <option value="2-5">2-5 years</option>
                                    <option value="5-10">5-10 years</option>
                                    <option value="10+">10+ years</option>
                                </select>
                            </div>

                            <!-- Job Type -->
                            <div>
                                <select name="type" 
                                        class="w-full rounded-2xl border-2 border-slate-200 bg-white py-3 px-4 text-sm font-medium text-slate-900 focus:border-black focus:outline-none focus:ring-2 focus:ring-black">
                                    <option value="">Job Type</option>
                                    <option value="full-time">Full-time</option>
                                    <option value="part-time">Part-time</option>
                                    <option value="contract">Contract</option>
                                    <option value="remote">Remote</option>
                                </select>
                            </div>
                        </div>

                        <!-- Search Button -->
                        <div class="flex justify-center">
                            <button type="submit" 
                                    class="inline-flex items-center gap-3 rounded-full bg-white px-12 py-4 text-base font-bold text-black shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl hover:bg-slate-50 border-2 border-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                                Search Jobs
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Quick Stats -->
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">50000+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Total Jobs</p>
            </div>
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">5000+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Companies</p>
            </div>
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">250+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Cities</p>
            </div>
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">35+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Industries</p>
            </div>
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">1200+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">New Today</p>
            </div>
        </div>

        <!-- Jobs by Company Section -->
        <section class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-black mb-2">Browse Jobs by <span class="text-slate-600">Company</span></h2>
                    <p class="text-sm text-slate-600">Find opportunities at India's top employers</p>
                </div>
                <a href="{{ route('jobs') }}?sort=company" class="inline-flex items-center gap-2 text-sm font-semibold text-black hover:text-slate-600 transition group">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                @php
                    $companies = [
                        ['name' => 'TCS', 'jobs' => 3245, 'logo' => 'T'],
                        ['name' => 'Infosys', 'jobs' => 2876, 'logo' => 'I'],
                        ['name' => 'Wipro', 'jobs' => 2134, 'logo' => 'W'],
                        ['name' => 'HCL Technologies', 'jobs' => 1987, 'logo' => 'H'],
                        ['name' => 'Tech Mahindra', 'jobs' => 1654, 'logo' => 'T'],
                        ['name' => 'Accenture', 'jobs' => 1432, 'logo' => 'A'],
                        ['name' => 'Cognizant', 'jobs' => 1234, 'logo' => 'C'],
                        ['name' => 'IBM India', 'jobs' => 987, 'logo' => 'I'],
                        ['name' => 'Capgemini', 'jobs' => 876, 'logo' => 'C'],
                        ['name' => 'Oracle', 'jobs' => 765, 'logo' => 'O'],
                    ];
                @endphp

                @foreach($companies as $company)
                    <a href="{{ route('jobs') }}?company={{ strtolower($company['name']) }}" 
                       class="group flex flex-col items-center gap-3 rounded-3xl border-2 border-slate-200 bg-white p-6 shadow-lg transition-all hover:-translate-y-2 hover:shadow-2xl hover:border-black">
                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-black text-2xl font-bold text-white shadow-lg">
                            {{ $company['logo'] }}
                        </div>
                        <div class="text-center">
                            <p class="font-bold text-slate-900 text-sm mb-1">{{ $company['name'] }}</p>
                            <p class="text-xs text-slate-500 font-semibold">{{ number_format($company['jobs']) }} Jobs</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Jobs by Role Section -->
        <section class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-black mb-2">Browse Jobs by <span class="text-slate-600">Role</span></h2>
                    <p class="text-sm text-slate-600">Explore opportunities matching your expertise</p>
                </div>
                <a href="{{ route('jobs') }}?sort=role" class="inline-flex items-center gap-2 text-sm font-semibold text-black hover:text-slate-600 transition group">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $roles = [
                        ['name' => 'Software Engineer', 'jobs' => 1245, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />'],
                        ['name' => 'Data Scientist', 'jobs' => 892, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />'],
                        ['name' => 'Product Manager', 'jobs' => 567, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />'],
                        ['name' => 'UI/UX Designer', 'jobs' => 423, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />'],
                        ['name' => 'DevOps Engineer', 'jobs' => 398, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />'],
                        ['name' => 'Business Analyst', 'jobs' => 312, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />'],
                    ];
                @endphp

                @foreach($roles as $role)
                    <a href="{{ route('jobs') }}?role={{ strtolower(str_replace(' ', '-', $role['name'])) }}" 
                       class="group flex items-center gap-4 rounded-3xl border-2 border-slate-200 bg-white p-6 shadow-lg transition-all hover:-translate-y-2 hover:shadow-2xl hover:border-black">
                        <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-black shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                {!! $role['icon'] !!}
                            </svg>
                        </div>
                        <div class="flex-1">
                            <p class="font-bold text-slate-900 mb-1">{{ $role['name'] }}</p>
                            <p class="text-sm text-slate-500 font-semibold">{{ number_format($role['jobs']) }} Openings</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Jobs by Location Section -->
        <section class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-black mb-2">Browse Jobs by <span class="text-slate-600">Location</span></h2>
                    <p class="text-sm text-slate-600">Discover opportunities in your preferred city</p>
                </div>
                <a href="{{ route('jobs') }}?sort=location" class="inline-flex items-center gap-2 text-sm font-semibold text-black hover:text-slate-600 transition group">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                @php
                    $locations = [
                        ['name' => 'Bangalore', 'jobs' => 3245],
                        ['name' => 'Mumbai', 'jobs' => 2876],
                        ['name' => 'Pune', 'jobs' => 2134],
                        ['name' => 'Hyderabad', 'jobs' => 1987],
                        ['name' => 'Chennai', 'jobs' => 1765],
                        ['name' => 'Delhi NCR', 'jobs' => 1654],
                        ['name' => 'Kolkata', 'jobs' => 987],
                        ['name' => 'Ahmedabad', 'jobs' => 765],
                        ['name' => 'Kochi', 'jobs' => 543],
                        ['name' => 'Chandigarh', 'jobs' => 432],
                    ];
                @endphp

                @foreach($locations as $location)
                    <a href="{{ route('jobs') }}?location={{ strtolower($location['name']) }}" 
                       class="group flex flex-col items-center gap-3 rounded-3xl border-2 border-slate-200 bg-white p-6 shadow-lg transition-all hover:-translate-y-2 hover:shadow-2xl hover:border-black">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="text-center">
                            <p class="font-bold text-slate-900 text-sm mb-1">{{ $location['name'] }}</p>
                            <p class="text-xs text-slate-500 font-semibold">{{ number_format($location['jobs']) }} Jobs</p>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <div class="h-1.5 w-1.5 rounded-full bg-black animate-pulse"></div>
                            <span class="text-xs font-semibold text-slate-600">Hiring</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Jobs by Industry Section -->
        <section class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-black mb-2">Browse Jobs by <span class="text-slate-600">Industry</span></h2>
                    <p class="text-sm text-slate-600">Find your next role in your industry of choice</p>
                </div>
                <a href="{{ route('jobs') }}?sort=industry" class="inline-flex items-center gap-2 text-sm font-semibold text-black hover:text-slate-600 transition group">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-5">
                @php
                    $industries = [
                        ['name' => 'IT & Software', 'jobs' => 5432, 'gradient' => 'from-black to-slate-200'],
                        ['name' => 'Banking & Finance', 'jobs' => 2876, 'gradient' => 'from-slate-900 to-slate-300'],
                        ['name' => 'Healthcare', 'jobs' => 1987, 'gradient' => 'from-slate-800 to-slate-200'],
                        ['name' => 'E-commerce', 'jobs' => 1654, 'gradient' => 'from-slate-700 to-slate-200'],
                        ['name' => 'Manufacturing', 'jobs' => 1432, 'gradient' => 'from-slate-600 to-slate-200'],
                        ['name' => 'Education', 'jobs' => 1234, 'gradient' => 'from-slate-500 to-slate-200'],
                        ['name' => 'Real Estate', 'jobs' => 876, 'gradient' => 'from-slate-400 to-slate-200'],
                        ['name' => 'Hospitality', 'jobs' => 654, 'gradient' => 'from-slate-300 to-slate-100'],
                    ];
                @endphp

                @foreach($industries as $industry)
                    <a href="{{ route('jobs') }}?industry={{ strtolower(str_replace(' ', '-', $industry['name'])) }}" 
                       class="group relative overflow-hidden rounded-3xl border-2 border-slate-200 bg-gradient-to-br {{ $industry['gradient'] }} p-6 shadow-lg transition-all hover:-translate-y-2 hover:shadow-2xl hover:border-black">
                        <div class="relative space-y-3">
                            <div class="inline-flex items-center justify-center h-10 w-10 rounded-xl bg-white shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <p class="font-bold text-slate-900 mb-1">{{ $industry['name'] }}</p>
                                <p class="text-sm text-slate-700 font-semibold">{{ number_format($industry['jobs']) }} Positions</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Jobs by Category Section -->
        <section class="space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl sm:text-3xl font-bold text-black mb-2">Browse Jobs by <span class="text-slate-600">Category</span></h2>
                    <p class="text-sm text-slate-600">Explore opportunities by functional area</p>
                </div>
                <a href="{{ route('jobs') }}?sort=category" class="inline-flex items-center gap-2 text-sm font-semibold text-black hover:text-slate-600 transition group">
                    View All
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $categories = [
                        ['name' => 'Engineering & Development', 'jobs' => 4567, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />'],
                        ['name' => 'Sales & Marketing', 'jobs' => 2345, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />'],
                        ['name' => 'Finance & Accounting', 'jobs' => 1876, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />'],
                        ['name' => 'Human Resources', 'jobs' => 1234, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />'],
                        ['name' => 'Operations & Logistics', 'jobs' => 987, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />'],
                        ['name' => 'Customer Support', 'jobs' => 765, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />'],
                    ];
                @endphp

                @foreach($categories as $category)
                    <a href="{{ route('jobs') }}?category={{ strtolower(str_replace(' ', '-', $category['name'])) }}" 
                       class="group relative overflow-hidden rounded-3xl border-2 border-slate-200 bg-white p-8 shadow-lg transition-all hover:-translate-y-2 hover:shadow-2xl hover:border-black">
                        <div class="absolute top-0 right-0 h-32 w-32 bg-slate-100 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <div class="relative flex items-start gap-4">
                            <div class="flex h-14 w-14 flex-shrink-0 items-center justify-center rounded-2xl bg-black shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    {!! $category['icon'] !!}
                                </svg>
                            </div>
                            <div class="flex-1">
                                <p class="font-bold text-slate-900 mb-2">{{ $category['name'] }}</p>
                                <p class="text-sm text-slate-500 font-semibold mb-3">{{ number_format($category['jobs']) }} Open Positions</p>
                                <div class="inline-flex items-center gap-2 text-xs font-bold text-black">
                                    Explore Jobs
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Final CTA Section -->
        <section class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-slate-900 via-slate-800 to-black p-12 lg:p-16 text-center shadow-2xl">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDE2djI4YTQgNCAwIDAgMS00IDRIMTZhNCA0IDAgMCAxLTQtNFYxNmE0IDQgMCAwIDEgNC00aDhtNCA0aDRtMCA0aDQiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
            
            <div class="relative space-y-8 max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-2 shadow-lg">
                    <span class="text-xs font-bold uppercase tracking-wider text-black">Start Your Journey</span>
                </div>
                
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">
                    Can't Find What You're <span class="text-slate-300">Looking For?</span>
                </h2>
                
                <p class="text-lg text-slate-300 leading-relaxed">
                    Use our advanced search to filter by skills, salary range, work mode, and more. Get personalized job recommendations based on your profile.
                </p>
                
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('jobs') }}" 
                       class="inline-flex items-center gap-3 rounded-full bg-white px-10 py-4 text-base font-bold text-black shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl hover:bg-slate-50">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Advanced Search
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="{{ route('register') }}" 
                       class="inline-flex items-center gap-3 rounded-full bg-transparent border-2 border-white px-10 py-4 text-base font-bold text-white transition-all hover:-translate-y-1 hover:bg-white hover:text-black">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        Get Job Alerts
                    </a>
                </div>
            </div>
        </section>

    </div>
@endsection
