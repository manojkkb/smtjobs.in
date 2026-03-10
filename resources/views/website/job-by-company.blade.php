@extends('website.layouts.app')

@section('title', 'Jobs by Company - Find Jobs at Top Companies in India | SMTJobs')

@section('meta_description', 'Browse job opportunities by company. Find jobs at India\'s leading employers including TCS, Infosys, Wipro, HCL and more.')

@section('meta_keywords', 'jobs by company, company jobs India, top employers India')

@section('content')
    <div class="mx-auto w-full max-w-7xl space-y-12 px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Page Header -->
        <section class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-slate-900 via-slate-800 to-black p-8 lg:p-12 shadow-2xl">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDE2djI4YTQgNCAwIDAgMS00IDRIMTZhNCA0IDAgMCAxLTQtNFYxNmE0IDQgMCAwIDEgNC00aDhtNCA0aDRtMCA0aDQiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
            
            <div class="relative space-y-8">
                <div class="text-center space-y-4">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-2 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-black">Jobs by Company</span>
                    </div>
                    
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">
                        Find Jobs at <span class="text-slate-300">Top Companies</span>
                    </h1>
                    
                    <p class="text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
                        Explore career opportunities at India's leading employers. Search by company name and discover your next role.
                    </p>
                </div>

                <!-- Search Form -->
                <div class="max-w-3xl mx-auto">
                    <form action="{{ route('jobs') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Company Search -->
                            <div class="md:col-span-2">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="company" placeholder="Search by company name..." 
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
                            <select name="location" class="rounded-xl border-2 border-slate-200 bg-white py-3 px-4 text-sm font-medium text-slate-900 focus:border-black focus:outline-none">
                                <option value="">All Locations</option>
                                <option value="bangalore">Bangalore</option>
                                <option value="mumbai">Mumbai</option>
                                <option value="pune">Pune</option>
                                <option value="hyderabad">Hyderabad</option>
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
                                <option value="contract">Contract</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Quick Stats -->
        <div class="grid grid-cols-3 gap-4">
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">5000+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Active Companies</p>
            </div>
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">50000+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Job Openings</p>
            </div>
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">1200+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Hiring Today</p>
            </div>
        </div>

        <!-- Featured Companies -->
        <section class="space-y-6">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-black mb-2">Featured <span class="text-slate-600">Companies</span></h2>
                <p class="text-sm text-slate-600">India's most sought-after employers</p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                @php
                    $featuredCompanies = [
                        ['name' => 'TCS', 'jobs' => 3245, 'logo' => 'T', 'featured' => true],
                        ['name' => 'Infosys', 'jobs' => 2876, 'logo' => 'I', 'featured' => true],
                        ['name' => 'Wipro', 'jobs' => 2134, 'logo' => 'W', 'featured' => true],
                        ['name' => 'HCL Technologies', 'jobs' => 1987, 'logo' => 'H', 'featured' => true],
                        ['name' => 'Tech Mahindra', 'jobs' => 1654, 'logo' => 'T', 'featured' => true],
                        ['name' => 'Accenture', 'jobs' => 1432, 'logo' => 'A', 'featured' => true],
                        ['name' => 'Cognizant', 'jobs' => 1234, 'logo' => 'C', 'featured' => true],
                        ['name' => 'IBM India', 'jobs' => 987, 'logo' => 'I', 'featured' => true],
                        ['name' => 'Capgemini', 'jobs' => 876, 'logo' => 'C', 'featured' => true],
                        ['name' => 'Oracle', 'jobs' => 765, 'logo' => 'O', 'featured' => true],
                    ];
                @endphp

                @foreach($featuredCompanies as $company)
                    <a href="{{ route('jobs') }}?company={{ strtolower($company['name']) }}" 
                       class="group flex flex-col items-center gap-4 rounded-3xl border-2 border-slate-200 bg-white p-6 shadow-lg transition-all hover:-translate-y-2 hover:shadow-2xl hover:border-black">
                        <div class="relative">
                            <div class="flex h-20 w-20 items-center justify-center rounded-2xl bg-black text-3xl font-bold text-white shadow-xl">
                                {{ $company['logo'] }}
                            </div>
                            @if($company['featured'])
                                <div class="absolute -top-2 -right-2 h-6 w-6 rounded-full bg-yellow-400 border-2 border-white flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-black" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="text-center">
                            <p class="font-bold text-slate-900 mb-1">{{ $company['name'] }}</p>
                            <p class="text-sm text-slate-500 font-semibold">{{ number_format($company['jobs']) }} Jobs</p>
                        </div>
                        <div class="flex items-center gap-1.5">
                            <div class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></div>
                            <span class="text-xs font-semibold text-green-600">Actively Hiring</span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- All Companies by Alphabet -->
        <section class="space-y-6">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-black mb-2">Browse All <span class="text-slate-600">Companies</span></h2>
                <p class="text-sm text-slate-600">Alphabetically organized for easy discovery</p>
            </div>

            <!-- Alphabet Filter -->
            <div class="flex flex-wrap gap-2 justify-center">
                @foreach(range('A', 'Z') as $letter)
                    <a href="#{{ $letter }}" 
                       class="flex h-10 w-10 items-center justify-center rounded-xl border-2 border-slate-200 bg-white font-bold text-slate-700 transition-all hover:border-black hover:bg-black hover:text-white hover:scale-110">
                        {{ $letter }}
                    </a>
                @endforeach
            </div>

            @php
                $allCompanies = [
                    'T' => [
                        ['name' => 'TCS', 'jobs' => 3245],
                        ['name' => 'Tech Mahindra', 'jobs' => 1654],
                        ['name' => 'Tata Motors', 'jobs' => 543],
                        ['name' => 'Tata Steel', 'jobs' => 432],
                    ],
                    'I' => [
                        ['name' => 'Infosys', 'jobs' => 2876],
                        ['name' => 'IBM India', 'jobs' => 987],
                        ['name' => 'ICICI Bank', 'jobs' => 765],
                    ],
                    'W' => [
                        ['name' => 'Wipro', 'jobs' => 2134],
                        ['name' => 'Wells Fargo', 'jobs' => 654],
                    ],
                    'H' => [
                        ['name' => 'HCL Technologies', 'jobs' => 1987],
                        ['name' => 'HDFC Bank', 'jobs' => 876],
                    ],
                    'A' => [
                        ['name' => 'Accenture', 'jobs' => 1432],
                        ['name' => 'Amazon', 'jobs' => 1234],
                        ['name' => 'Adobe', 'jobs' => 567],
                    ],
                ];
            @endphp

            <!-- Companies Grouped by Letter -->
            @foreach($allCompanies as $letter => $companies)
                <div id="{{ $letter }}" class="scroll-mt-24">
                    <div class="mb-4 flex items-center gap-3">
                        <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-black text-2xl font-bold text-white shadow-lg">
                            {{ $letter }}
                        </div>
                        <h3 class="text-xl font-bold text-slate-900">Companies starting with {{ $letter }}</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($companies as $company)
                            <a href="{{ route('jobs') }}?company={{ strtolower($company['name']) }}" 
                               class="group flex items-center gap-4 rounded-2xl border-2 border-slate-200 bg-white p-5 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl hover:border-black">
                                <div class="flex h-12 w-12 flex-shrink-0 items-center justify-center rounded-xl bg-slate-100 text-lg font-bold text-black">
                                    {{ substr($company['name'], 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <p class="font-bold text-slate-900">{{ $company['name'] }}</p>
                                    <p class="text-sm text-slate-500 font-semibold">{{ number_format($company['jobs']) }} Open Positions</p>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </section>

        <!-- CTA Section -->
        <section class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-slate-900 via-slate-800 to-black p-12 text-center shadow-2xl">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDE2djI4YTQgNCAwIDAgMS00IDRIMTZhNCA0IDAgMCAxLTQtNFYxNmE0IDQgMCAwIDEgNC00aDhtNCA0aDRtMCA0aDQiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
            
            <div class="relative space-y-6 max-w-2xl mx-auto">
                <h2 class="text-3xl sm:text-4xl font-bold text-white leading-tight">
                    Don't See Your <span class="text-slate-300">Dream Company?</span>
                </h2>
                
                <p class="text-lg text-slate-300">
                    Set up job alerts and get notified when your preferred companies post new openings.
                </p>
            </div>
        </section>

    </div>
@endsection
