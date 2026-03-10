@extends('website.layouts.app')

@section('title', 'Jobs by Category - Browse Jobs by Functional Area | SMTJobs')

@section('meta_description', 'Browse job opportunities by category and functional area. Find jobs in Engineering, Sales, Finance, HR, Operations and more.')

@section('meta_keywords', 'jobs by category, engineering jobs, sales jobs, finance jobs, HR jobs, operations jobs')

@section('content')
    <div class="mx-auto w-full max-w-7xl space-y-12 px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Page Header -->
        <section class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-slate-900 via-slate-800 to-black p-8 lg:p-12 shadow-2xl">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDE2djI4YTQgNCAwIDAgMS00IDRIMTZhNCA0IDAgMCAxLTQtNFYxNmE0IDQgMCAwIDEgNC00aDhtNCA0aDRtMCA0aDQiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
            
            <div class="relative space-y-8">
                <div class="text-center space-y-4">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-2 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-black">Jobs by Category</span>
                    </div>
                    
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">
                        Find Jobs by <span class="text-slate-300">Function</span>
                    </h1>
                    
                    <p class="text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
                        Browse opportunities by functional area. Discover roles that match your expertise across different departments.
                    </p>
                </div>

                <!-- Search Form -->
                <div class="max-w-3xl mx-auto">
                    <form action="{{ route('jobs') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Category Search -->
                            <div class="md:col-span-2">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="category" placeholder="Search by category or function..." 
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
                <p class="text-3xl font-bold text-black">15+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Categories</p>
            </div>
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">50000+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Job Openings</p>
            </div>
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">3500+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">New This Week</p>
            </div>
        </div>

        <!-- Main Categories -->
        <section class="space-y-6">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-black mb-2">Main <span class="text-slate-600">Categories</span></h2>
                <p class="text-sm text-slate-600">Browse by functional department</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $mainCategories = [
                        ['name' => 'Engineering & Development', 'jobs' => 4567, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />', 'desc' => 'Software, DevOps, QA'],
                        ['name' => 'Sales & Marketing', 'jobs' => 2345, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />', 'desc' => 'Sales, Digital Marketing, Brand'],
                        ['name' => 'Finance & Accounting', 'jobs' => 1876, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />', 'desc' => 'Accounting, Finance, Audit'],
                        ['name' => 'Human Resources', 'jobs' => 1234, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />', 'desc' => 'Recruitment, L&D, HR Operations'],
                        ['name' => 'Operations & Logistics', 'jobs' => 987, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />', 'desc' => 'Supply Chain, Warehouse, Procurement'],
                        ['name' => 'Customer Support', 'jobs' => 765, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />', 'desc' => 'Customer Service, Technical Support'],
                    ];
                @endphp

                @foreach($mainCategories as $category)
                    <a href="{{ route('jobs') }}?category={{ strtolower(str_replace(' ', '-', $category['name'])) }}" 
                       class="group relative overflow-hidden rounded-3xl border-2 border-slate-200 bg-white p-8 shadow-lg transition-all hover:-translate-y-2 hover:shadow-2xl hover:border-black">
                        <div class="absolute top-0 right-0 h-32 w-32 bg-slate-100 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        
                        <div class="relative space-y-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-black shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    {!! $category['icon'] !!}
                                </svg>
                            </div>
                            
                            <div>
                                <p class="font-bold text-slate-900 text-lg mb-1">{{ $category['name'] }}</p>
                                <p class="text-sm text-slate-600 mb-3">{{ $category['desc'] }}</p>
                                <p class="text-2xl font-bold text-black">{{ number_format($category['jobs']) }}</p>
                                <p class="text-sm text-slate-500 font-semibold">Open Positions</p>
                            </div>
                            
                            <div class="flex items-center gap-2 pt-2">
                                <div class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></div>
                                <span class="text-xs font-semibold text-green-600">Actively Hiring</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- More Categories -->
        <section class="space-y-6">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-black mb-2">More <span class="text-slate-600">Functions</span></h2>
                <p class="text-sm text-slate-600">Additional functional areas</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @php
                    $moreCategories = [
                        ['name' => 'Product Management', 'jobs' => 654],
                        ['name' => 'Design & Creative', 'jobs' => 543],
                        ['name' => 'Data & Analytics', 'jobs' => 498],
                        ['name' => 'Quality Assurance', 'jobs' => 432],
                        ['name' => 'Project Management', 'jobs' => 398],
                        ['name' => 'Legal & Compliance', 'jobs' => 321],
                        ['name' => 'Administration', 'jobs' => 298],
                        ['name' => 'Research & Development', 'jobs' => 276],
                        ['name' => 'Content & Writing', 'jobs' => 254],
                        ['name' => 'Healthcare & Medical', 'jobs' => 234],
                        ['name' => 'Education & Training', 'jobs' => 212],
                        ['name' => 'Manufacturing', 'jobs' => 198],
                    ];
                @endphp

                @foreach($moreCategories as $category)
                    <a href="{{ route('jobs') }}?category={{ strtolower(str_replace(' ', '-', $category['name'])) }}" 
                       class="group flex items-center justify-between rounded-2xl border-2 border-slate-200 bg-white p-5 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl hover:border-black">
                        <div>
                            <p class="font-bold text-slate-900 text-sm mb-1">{{ $category['name'] }}</p>
                            <p class="text-xs text-slate-500 font-semibold">{{ number_format($category['jobs']) }} jobs</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- Skills-Based Matching -->
        <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-slate-100 to-white p-8 lg:p-12 shadow-xl border-2 border-slate-200">
            <div class="relative grid gap-8 lg:grid-cols-2 items-center">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-2 rounded-full bg-black px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-white">Smart Matching</span>
                    </div>
                    
                   <h2 class="text-3xl sm:text-4xl font-bold text-black leading-tight">
                        Find Jobs by <span class="text-slate-600">Your Skills</span>
                    </h2>
                    
                    <p class="text-lg text-slate-700 leading-relaxed">
                        Our AI-powered matching helps you discover roles across different categories based on your skillset and experience.
                    </p>
                    
                    <div class="flex flex-wrap gap-2">
                        @foreach(['Python', 'JavaScript', 'Java', 'React', 'SQL', 'AWS', 'Docker', 'Kubernetes'] as $skill)
                            <span class="inline-flex items-center gap-2 rounded-full bg-white border-2 border-slate-200 px-4 py-2 text-sm font-semibold text-slate-900 hover:border-black transition-colors">
                                {{ $skill }}
                            </span>
                        @endforeach
                    </div>
                </div>
                
                <div class="rounded-3xl bg-white p-8 shadow-lg border-2 border-slate-200">
                    <div class="space-y-6">
                        <div>
                            <p class="text-sm font-semibold text-slate-600 mb-3">Top Skills in Demand</p>
                            <div class="space-y-3">
                                @foreach([
                                    ['skill' => 'Full Stack Development', 'percentage' => 85],
                                    ['skill' => 'Data Analysis', 'percentage' => 72],
                                    ['skill' => 'Digital Marketing', 'percentage' => 68],
                                    ['skill' => 'Project Management', 'percentage' => 61],
                                ] as $skillDemand)
                                    <div>
                                        <div class="flex items-center justify-between mb-1">
                                            <span class="text-sm font-semibold text-slate-900">{{ $skillDemand['skill'] }}</span>
                                            <span class="text-sm font-bold text-black">{{ $skillDemand['percentage'] }}%</span>
                                        </div>
                                        <div class="h-2 rounded-full bg-slate-200 overflow-hidden">
                                            <div class="h-full rounded-full bg-black" style="width: {{ $skillDemand['percentage'] }}%"></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-slate-900 via-slate-800 to-black p-12 text-center shadow-2xl">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDE2djI4YTQgNCAwIDAgMS00IDRIMTZhNCA0IDAgMCAxLTQtNFYxNmE0IDQgMCAwIDEgNC00aDhtNCA0aDRtMCA0aDQiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
            
            <div class="relative space-y-6 max-w-2xl mx-auto">
                <h2 class="text-3xl sm:text-4xl font-bold text-white leading-tight">
                    Ready for a <span class="text-slate-300">Career Change?</span>
                </h2>
                
                <p class="text-lg text-slate-300">
                    Explore opportunities in different functional areas. Our career counselors can help you identify transferable skills and make a successful transition.
                </p>
                
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="{{ route('jobs') }}" 
                       class="inline-flex items-center gap-3 rounded-full bg-white px-10 py-4 text-base font-bold text-black shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Explore All Jobs
                    </a>
                </div>
            </div>
        </section>

    </div>
@endsection
