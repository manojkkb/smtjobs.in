@extends('website.layouts.app')

@section('title', 'Jobs by Industry - Find Jobs in IT, Banking, Healthcare & More | SMTJobs')

@section('meta_description', 'Browse job opportunities by industry sector. Find jobs in IT, Banking, Healthcare, E-commerce, Manufacturing and more industries in India.')

@section('meta_keywords', 'jobs by industry, IT jobs India, banking jobs, healthcare jobs, industry jobs India')

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
                        <span class="text-xs font-bold uppercase tracking-wider text-black">Jobs by Industry</span>
                    </div>
                    
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">
                        Find Jobs in Your <span class="text-slate-300">Industry</span>
                    </h1>
                    
                    <p class="text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
                        Explore career opportunities across different industry sectors. From IT to Healthcare, find your perfect role.
                    </p>
                </div>

                <!-- Search Form -->
                <div class="max-w-3xl mx-auto">
                    <form action="{{ route('jobs') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Industry Search -->
                            <div class="md:col-span-2">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="industry" placeholder="Search by industry or sector..." 
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
                                <option value="sales-manager">Sales Manager</option>
                                <option value="analyst">Analyst</option>
                            </select>
                            
                            <select name="location" class="rounded-xl border-2 border-slate-200 bg-white py-3 px-4 text-sm font-medium text-slate-900 focus:border-black focus:outline-none">
                                <option value="">Location</option>
                                <option value="bangalore">Bangalore</option>
                                <option value="mumbai">Mumbai</option>
                                <option value="pune">Pune</option>
                            </select>
                            
                            <select name="experience" class="rounded-xl border-2 border-slate-200 bg-white py-3 px-4 text-sm font-medium text-slate-900 focus:border-black focus:outline-none">
                                <option value="">Experience</option>
                                <option value="0-2">0-2 years</option>
                                <option value="2-5">2-5 years</option>
                                <option value="5-10">5-10 years</option>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </section>

        <!-- Quick Stats -->
        <div class="grid grid-cols-3 gap-4">
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">{{ number_format($industries->count()) }}</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Industries</p>
            </div>
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">{{ number_format($industries->sum('job_posts_count')) }}</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Job Openings</p>
            </div>
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">{{ number_format($industries->sum('companies_count')) }}</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Companies</p>
            </div>
        </div>

        <!-- Top Industries -->
        <section class="space-y-6">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-black mb-2">Top <span class="text-slate-600">Industries</span></h2>
                <p class="text-sm text-slate-600">Highest job demand sectors in India</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $gradients = [
                        'from-black to-slate-300',
                        'from-slate-900 to-slate-300',
                        'from-slate-800 to-slate-300',
                        'from-slate-700 to-slate-300',
                        'from-slate-600 to-slate-200',
                        'from-slate-500 to-slate-200',
                        'from-slate-400 to-slate-200',
                        'from-slate-300 to-slate-100',
                    ];
                    $topIndustries = $industries->take(8);
                @endphp

                @foreach($topIndustries as $index => $industry)
                    <a href="{{ route('jobs') }}?industry_id={{ $industry->id }}" 
                       class="group relative overflow-hidden rounded-3xl border-2 border-slate-200 bg-gradient-to-br {{ $gradients[$index % count($gradients)] }} p-6 shadow-lg transition-all hover:-translate-y-2 hover:shadow-2xl hover:border-black">
                        <div class="relative space-y-4">
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white shadow-lg">
                                @if($industry->icon)
                                    {!! $industry->icon !!}
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                @endif
                            </div>
                            
                            <div>
                                <p class="font-bold text-slate-900 mb-2">{{ $industry->label }}</p>
                                <p class="text-2xl font-bold text-black mb-1">{{ number_format($industry->job_posts_count) }}</p>
                                <p class="text-sm text-slate-700 font-semibold">Open Positions</p>
                            </div>
                            
                            <div class="pt-2 border-t border-slate-900/10">
                                <p class="text-xs text-slate-600 font-semibold">{{ number_format($industry->companies_count) }} companies</p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- More Industries -->
        <section class="space-y-6">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-black mb-2">More <span class="text-slate-600">Industries</span></h2>
                <p class="text-sm text-slate-600">Explore opportunities in other sectors</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @php
                    $moreIndustries = $industries->skip(8);
                @endphp

                @foreach($moreIndustries as $industry)
                    <a href="{{ route('jobs') }}?industry_id={{ $industry->id }}" 
                       class="group flex items-center justify-between rounded-2xl border-2 border-slate-200 bg-white p-5 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl hover:border-black">
                        <div>
                            <p class="font-bold text-slate-900">{{ $industry->label }}</p>
                            <p class="text-sm text-slate-500 font-semibold mt-1">{{ number_format($industry->job_posts_count) }} Openings</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Industry Trends -->
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-100 to-white p-8 lg:p-12 shadow-xl border-2 border-slate-200">
            <div class="relative space-y-8">
                <div>
                    <div class="inline-flex items-center gap-2 rounded-full bg-black px-4 py-2 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-white">Market Insights</span>
                    </div>
                    
                    <h2 class="text-2xl sm:text-3xl font-bold text-black mb-3">Top <span class="text-slate-600">Sectors</span></h2>
                    <p class="text-sm text-slate-600">Industries with the most opportunities</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @php
                        $growingIndustries = $industries->take(4);
                    @endphp
                    
                    @foreach($growingIndustries as $industry)
                        <div class="rounded-2xl bg-white p-6 shadow-lg border-2 border-slate-200">
                            <div class="space-y-3">
                                <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                    </svg>
                                    Top Sector
                                </span>
                                <p class="font-bold text-slate-900 text-lg">{{ $industry->label }}</p>
                                <p class="text-sm text-slate-600">{{ number_format($industry->job_posts_count) }} open positions</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-slate-900 via-slate-800 to-black p-12 text-center shadow-2xl">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDE2djI4YTQgNCAwIDAgMS00IDRIMTZhNCA0IDAgMCAxLTQtNFYxNmE0IDQgMCAwIDEgNC00aDhtNCA0aDRtMCA0aDQiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
            
            <div class="relative space-y-6 max-w-2xl mx-auto">
                <h2 class="text-3xl sm:text-4xl font-bold text-white leading-tight">
                    Want to Switch <span class="text-slate-300">Industries?</span>
                </h2>
                
                <p class="text-lg text-slate-300">
                    Get personalized recommendations based on your skills and experience. Discover transferable skills and new career paths.
                </p>
            </div>
        </section>

    </div>
@endsection
