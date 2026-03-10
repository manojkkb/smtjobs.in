@extends('website.layouts.app')

@section('title', 'Jobs by Role - Find Jobs by Job Title & Position | SMTJobs')

@section('meta_description', 'Browse job opportunities by role. Find Software Engineer, Data Scientist, Product Manager and other roles in India.')

@section('meta_keywords', 'jobs by role, job positions India, software engineer jobs, data scientist jobs')

@section('content')
    <div class="mx-auto w-full max-w-7xl space-y-12 px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Page Header -->
        <section class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-slate-900 via-slate-800 to-black p-8 lg:p-12 shadow-2xl">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDE2djI4YTQgNCAwIDAgMS00IDRIMTZhNCA0IDAgMCAxLTQtNFYxNmE0IDQgMCAwIDEgNC00aDhtNCA0aDRtMCA0aDQiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
            
            <div class="relative space-y-8">
                <div class="text-center space-y-4">
                    <div class="inline-flex items-center gap-2 rounded-full bg-white px-5 py-2 shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-black">Jobs by Role</span>
                    </div>
                    
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">
                        Find Jobs by <span class="text-slate-300">Position</span>
                    </h1>
                    
                    <p class="text-base sm:text-lg text-slate-300 leading-relaxed max-w-2xl mx-auto">
                        Discover opportunities matching your expertise. Search by job title, position, or role type.
                    </p>
                </div>

                <!-- Search Form -->
                <div class="max-w-3xl mx-auto">
                    <form action="{{ route('jobs') }}" method="GET" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Role Search -->
                            <div class="md:col-span-2">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="role" placeholder="Search by job title or role..." 
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
                            <select name="experience" class="rounded-xl border-2 border-slate-200 bg-white py-3 px-4 text-sm font-medium text-slate-900 focus:border-black focus:outline-none">
                                <option value="">Experience Level</option>
                                <option value="entry">Entry Level</option>
                                <option value="mid">Mid Level</option>
                                <option value="senior">Senior Level</option>
                            </select>
                            
                            <select name="location" class="rounded-xl border-2 border-slate-200 bg-white py-3 px-4 text-sm font-medium text-slate-900 focus:border-black focus:outline-none">
                                <option value="">Location</option>
                                <option value="bangalore">Bangalore</option>
                                <option value="mumbai">Mumbai</option>
                                <option value="pune">Pune</option>
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
                <p class="text-3xl font-bold text-black">500+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Job Roles</p>
            </div>
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">50000+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">Openings</p>
            </div>
            <div class="rounded-2xl bg-white p-6 text-center shadow-lg hover:shadow-xl transition-all hover:-translate-y-1 border-2 border-slate-200 hover:border-black">
                <p class="text-3xl font-bold text-black">2500+</p>
                <p class="text-sm text-slate-600 font-semibold mt-2">New This Week</p>
            </div>
        </div>

        <!-- Trending Roles -->
        <section class="space-y-6">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-black mb-2">Trending <span class="text-slate-600">Roles</span></h2>
                <p class="text-sm text-slate-600">Most in-demand positions right now</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @php
                    $trendingRoles = [
                        ['name' => 'Software Engineer', 'jobs' => 1245, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />', 'growth' => '+15%'],
                        ['name' => 'Data Scientist', 'jobs' => 892, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />', 'growth' => '+22%'],
                        ['name' => 'Product Manager', 'jobs' => 567, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />', 'growth' => '+18%'],
                        ['name' => 'UI/UX Designer', 'jobs' => 423, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />', 'growth' => '+12%'],
                        ['name' => 'DevOps Engineer', 'jobs' => 398, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />', 'growth' => '+25%'],
                        ['name' => 'Business Analyst', 'jobs' => 312, 'icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />', 'growth' => '+10%'],
                    ];
                @endphp

                @foreach($trendingRoles as $role)
                    <a href="{{ route('jobs') }}?role={{ strtolower(str_replace(' ', '-', $role['name'])) }}" 
                       class="group relative overflow-hidden rounded-3xl border-2 border-slate-200 bg-white p-6 shadow-lg transition-all hover:-translate-y-2 hover:shadow-2xl hover:border-black">
                        <div class="absolute top-4 right-4">
                            <span class="inline-flex items-center gap-1 rounded-full bg-green-100 px-3 py-1 text-xs font-bold text-green-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                                </svg>
                                {{ $role['growth'] }}
                            </span>
                        </div>
                        
                        <div class="space-y-4">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-black shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    {!! $role['icon'] !!}
                                </svg>
                            </div>
                            
                            <div>
                                <p class="font-bold text-slate-900 text-lg mb-1">{{ $role['name'] }}</p>
                                <p class="text-sm text-slate-500 font-semibold">{{ number_format($role['jobs']) }} Open Positions</p>
                            </div>
                            
                            <div class="flex items-center gap-2 pt-2">
                                <div class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></div>
                                <span class="text-xs font-semibold text-green-600">High Demand</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

        <!-- All Roles by Category -->
        <section class="space-y-8">
            <div>
                <h2 class="text-2xl sm:text-3xl font-bold text-black mb-2">Browse by <span class="text-slate-600">Department</span></h2>
                <p class="text-sm text-slate-600">Explore roles organized by functional area</p>
            </div>

            @php
                $rolesByCategory = [
                    'Engineering & Technology' => [
                        ['name' => 'Full Stack Developer', 'jobs' => 987],
                        ['name' => 'Backend Developer', 'jobs' => 876],
                        ['name' => 'Frontend Developer', 'jobs' => 765],
                        ['name' => 'Mobile App Developer', 'jobs' => 654],
                        ['name' => 'Cloud Architect', 'jobs' => 543],
                        ['name' => 'Security Engineer', 'jobs' => 432],
                    ],
                    'Data & Analytics' => [
                        ['name' => 'Data Engineer', 'jobs' => 765],
                        ['name' => 'ML Engineer', 'jobs' => 654],
                        ['name' => 'Data Analyst', 'jobs' => 543],
                        ['name' => 'BI Developer', 'jobs' => 432],
                    ],
                    'Product & Design' => [
                        ['name' => 'Product Designer', 'jobs' => 432],
                        ['name' => 'UX Researcher', 'jobs' => 321],
                        ['name' => 'Graphic Designer', 'jobs' => 287],
                        ['name' => 'Product Owner', 'jobs' => 234],
                    ],
                    'Sales & Marketing' => [
                        ['name' => 'Sales Manager', 'jobs' => 654],
                        ['name' => 'Digital Marketing Manager', 'jobs' => 543],
                        ['name' => 'Content Writer', 'jobs' => 432],
                        ['name' => 'SEO Specialist', 'jobs' => 321],
                    ],
                ];
            @endphp

            @foreach($rolesByCategory as $category => $roles)
                <div class="space-y-4">
                    <h3 class="text-xl font-bold text-slate-900 flex items-center gap-3">
                        <div class="h-1 w-12 rounded bg-black"></div>
                        {{ $category }}
                    </h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                        @foreach($roles as $role)
                            <a href="{{ route('jobs') }}?role={{ strtolower(str_replace(' ', '-', $role['name'])) }}" 
                               class="group flex items-center justify-between rounded-2xl border-2 border-slate-200 bg-white p-4 shadow-lg transition-all hover:-translate-y-1 hover:shadow-xl hover:border-black">
                                <div>
                                    <p class="font-bold text-slate-900 text-sm">{{ $role['name'] }}</p>
                                    <p class="text-xs text-slate-500 font-semibold mt-1">{{ number_format($role['jobs']) }} jobs</p>
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
                    Can't Find Your <span class="text-slate-300">Ideal Role?</span>
                </h2>
                
                <p class="text-lg text-slate-300">
                    Upload your resume and let recruiters find you. Get matched with roles that fit your skills and experience.
                </p>
            </div>
        </section>

    </div>
@endsection
