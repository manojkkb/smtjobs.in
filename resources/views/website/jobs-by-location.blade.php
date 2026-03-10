@extends('website.layouts.app')

@section('title', 'Jobs by Location - Find Jobs in Top Cities of India | SMTJobs')

@section('meta_description', 'Browse job opportunities by location. Find jobs in Bangalore, Mumbai, Pune, Hyderabad, Chennai and other major cities in India.')

@section('meta_keywords', 'jobs by location, jobs in Bangalore, jobs in Mumbai, jobs in Pune, jobs in India')

@section('content')
    <div class="mx-auto w-full max-w-7xl space-y-12 px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Page Header -->
        <section class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-slate-900 via-slate-800 to-black p-8 lg:p-12 shadow-2xl">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDE2djI4YTQgNCAwIDAgMS00IDRIMTZhNCA0IDAgMCAxLTQtNFYxNmE0IDQgMCAwIDEgNC00aDhtNCA0aDRtMCA0aDQiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
            
            <div class="relative space-y-8">
                <div class="text-center space-y-4">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-2 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-black">Jobs by Location</span>
                    </div>
                    
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">
                        Find Jobs in Your <span class="text-slate-300">City</span>
                    </h1>
                    
                    <p class="text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
                        Discover career opportunities across India's major tech hubs and growing cities. Work where you want to live.
                    </p>
                </div>

                <!-- Search Form -->
                <div class="max-w-3xl mx-auto">
                    <form action="{{ route('jobs') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Location Search -->
                            <div class="md:col-span-2">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="location" placeholder="Search by city, state or region..." 
                                           class="w-full rounded-2xl border-2 border-slate-200 bg-white py-4 pl-12 pr-4 text-base font-medium text-slate-900 placeholder-slate-400 focus:border-black focus:outline-none focus:ring-2 focus:ring-black">
                                </div>
                            </div>

                            <!-- Search Button -->
                            <div>
                                <button type="submit" 
                                        class="w-full inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-8 py-4 text-base font-bold text-black shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl hover:bg-slate-50 border-2 border-white h-full">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                    Search
                                </button>
                            </div>
                        </div>

                        <!-- Additional Filters -->
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
                            <select name="role" class="rounded-xl border-2 border-slate-200 bg-white py-3 px-4 text-sm font-medium text-slate-900 focus:border-black focus:outline-none">
                                <option value="">Job Role</option>
                                <option value="software-engineer">Software Engineer</option>
                                <option value="data-scientist">Data Scientist</option>
                                <option value="product-manager">Product Manager</option>
                            </select>
                            
                            <select name="experience" class="rounded-xl border-2 border-slate-200 bg-white py-3 px-4 text-sm font-medium text-slate-900 focus:border-black focus:outline-none">
                                <option value="">Experience</option>
                                <option value="0-2">0-2 years</option>
                                <option value="2-5">2-5 years</option>
                                <option value="5-10">5-10 years</option>
                            </select>
                            
                            <select name="type" class="rounded-xl border-2 border-slate-200 bg-white py-3 px-4 text-sm font-medium text-slate-900 focus:border-black focus:outline-none">
                                <option value="">Job Type</option>
                                <option value="full-time">Full-time</option>
                                <option value="remote">Remote</option>
                                <option value="hybrid">Hybrid</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Quick Stats -->
        <div class="grid grid-cols-3 gap-4">
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">250+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Cities</p>
            </div>
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">50000+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Job Openings</p>
            </div>
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">100%</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Remote Friendly</p>
            </div>
        </div>

        <!-- Top Metro Cities -->
        <section class="space-y-6">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-black mb-2">Top <span class="text-slate-600">Metro Cities</span></h2>
                <p class="text-sm text-slate-600">Largest job markets in India</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $metroCities = [
                        ['name' => 'Bangalore', 'jobs' => 3245, 'companies' => 1200, 'growth' => '+18%'],
                        ['name' => 'Mumbai', 'jobs' => 2876, 'companies' => 980, 'growth' => '+15%'],
                        ['name' => 'Pune', 'jobs' => 2134, 'companies' => 750, 'growth' => '+22%'],
                        ['name' => 'Hyderabad', 'jobs' => 1987, 'companies' => 680, 'growth' => '+20%'],
                        ['name' => 'Chennai', 'jobs' => 1765, 'companies' => 590, 'growth' => '+12%'],
                        ['name' => 'Delhi NCR', 'jobs' => 1654, 'companies' => 870, 'growth' => '+14%'],
                        ['name' => 'Kolkata', 'jobs' => 987, 'companies' => 320, 'growth' => '+10%'],
                        ['name' => 'Ahmedabad', 'jobs' => 765, 'companies' => 280, 'growth' => '+16%'],
                    ];
                @endphp

                @foreach($metroCities as $city)
                    <a href="{{ route('jobs') }}?location={{ strtolower($city['name']) }}" 
                       class="group relative overflow-hidden rounded-3xl border-2 border-slate-200 bg-white p-6 shadow-lg transition-all hover:-translate-y-2 hover:shadow-2xl hover:border-black">
                        <div class="absolute top-0 right-0 w-24 h-24 bg-slate-100 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        
                        <div class="relative space-y-4">
                            <div class="flex items-center justify-between">
                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-black shadow-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                                <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-2 py-1 text-xs font-bold text-green-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    {{ $city['growth'] }}
                                </span>
                            </div>
                            
                            <div>
                                <p class="font-bold text-slate-900 text-lg mb-1">{{ $city['name'] }}</p>
                                <p class="text-2xl font-bold text-black mb-1">{{ number_format($city['jobs']) }}</p>
                                <p class="text-sm text-slate-500 font-semibold">Job Openings</p>
                            </div>
                            
                            <div class="pt-2 border-t border-slate-100">
                                <p class="text-xs text-slate-600">{{ number_format($city['companies']) }} companies hiring</p>
                            </div>
                            
                            <div class="flex items-center gap-2">
                                <div class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></div>
                                <span class="text-xs font-semibold text-green-600">Actively Hiring</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Tier 2 Cities -->
        <section class="space-y-6">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-black mb-2">Emerging <span class="text-slate-600">Tech Hubs</span></h2>
                <p class="text-sm text-slate-600">Fast-growing cities with great opportunities</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-4">
                @php
                    $tier2Cities = [
                        ['name' => 'Kochi', 'jobs' => 543],
                        ['name' => 'Chandigarh', 'jobs' => 432],
                        ['name' => 'Jaipur', 'jobs' => 398],
                        ['name' => 'Indore', 'jobs' => 367],
                        ['name' => 'Coimbatore', 'jobs' => 321],
                        ['name' => 'Vadodara', 'jobs' => 298],
                        ['name' => 'Nagpur', 'jobs' => 276],
                        ['name' => 'Visakhapatnam', 'jobs' => 254],
                        ['name' => 'Bhubaneswar', 'jobs' => 234],
                        ['name' => 'Lucknow', 'jobs' => 212],
                    ];
                @endphp

                @foreach($tier2Cities as $city)
                    <a href="{{ route('jobs') }}?location={{ strtolower($city['name']) }}" 
                       class="group flex flex-col items-center gap-3 rounded-3xl border-2 border-slate-200 bg-white p-5 shadow-lg transition-all hover:-translate-y-2 hover:shadow-xl hover:border-black">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>
                        <div class="text-center">
                            <p class="font-bold text-slate-900 text-sm mb-1">{{ $city['name'] }}</p>
                            <p class="text-xs text-slate-500 font-semibold">{{ number_format($city['jobs']) }} Jobs</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Remote Jobs -->
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-100 to-white p-8 lg:p-12 shadow-xl border-2 border-slate-200">
            <div class="relative grid gap-8 lg:grid-cols-2 items-center">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-2 rounded-full bg-black px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-white">Work from Anywhere</span>
                    </div>
                    
                    <h2 class="text-3xl sm:text-4xl font-bold text-black leading-tight">
                        Remote & <span class="text-slate-600">Hybrid Jobs</span>
                    </h2>
                    
                    <p class="text-lg text-slate-700 leading-relaxed">
                        Work from the comfort of your home or choose a hybrid model. Explore 5000+ remote-friendly positions across India.
                    </p>
                    
                    <a href="{{ route('jobs') }}?type=remote" 
                       class="inline-flex items-center gap-3 rounded-full bg-black px-8 py-4 text-base font-bold text-white shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl hover:bg-slate-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Browse Remote Jobs
                    </a>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="rounded-3xl bg-white p-6 shadow-lg border-2 border-slate-200">
                        <p class="text-4xl font-bold text-black mb-2">5000+</p>
                        <p class="text-sm text-slate-600 font-semibold">Remote Jobs</p>
                    </div>
                    <div class="rounded-3xl bg-white p-6 shadow-lg border-2 border-slate-200">
                        <p class="text-4xl font-bold text-black mb-2">3000+</p>
                        <p class="text-sm text-slate-600 font-semibold">Hybrid Options</p>
                    </div>
                    <div class="rounded-3xl bg-white p-6 shadow-lg border-2 border-slate-200">
                        <p class="text-4xl font-bold text-black mb-2">1200+</p>
                        <p class="text-sm text-slate-600 font-semibold">Companies</p>
                    </div>
                    <div class="rounded-3xl bg-white p-6 shadow-lg border-2 border-slate-200">
                        <p class="text-4xl font-bold text-black mb-2">100%</p>
                        <p class="text-sm text-slate-600 font-semibold">Verified</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-slate-900 via-slate-800 to-black p-12 text-center shadow-2xl">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDE2djI4YTQgNCAwIDAgMS00IDRIMTZhNCA0IDAgMCAxLTQtNFYxNmE0IDQgMCAwIDEgNC00aDhtNCA0aDRtMCA0aDQiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
            
            <div class="relative space-y-6 max-w-2xl mx-auto">
                <h2 class="text-3xl sm:text-4xl font-bold text-white leading-tight">
                    Planning to <span class="text-slate-300">Relocate?</span>
                </h2>
                
                <p class="text-lg text-slate-300">
                    Get insights on cost of living, best neighborhoods, and salary benchmarks for every city. Make informed decisions about your career move.
                </p>
                
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('jobs') }}" 
                       class="inline-flex items-center gap-3 rounded-full bg-white px-10 py-4 text-base font-bold text-black shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                        </svg>
                        Explore All Cities
                    </a>
                </div>
            </div>
        </section>

    </div>
@endsection
