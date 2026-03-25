@extends('website.layouts.app')

@section('title', 'Sitemap - SMTJobs')

@section('meta_description', 'Browse all pages on SMTJobs. Find jobs, post jobs, learn about us, and access all features of our platform.')

@section('content')
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-black via-slate-900 to-slate-800 text-white py-24 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute top-10 right-10 w-72 h-72 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-10 left-10 w-96 h-96 bg-white/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        
        <div class="container mx-auto px-4 relative">
            <div class="max-w-4xl mx-auto text-center">
                <!-- Badge -->
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-4 py-2 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                    </svg>
                    <span class="text-sm font-semibold">Navigate Our Platform</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-6 bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">
                    Sitemap
                </h1>
                <p class="text-xl md:text-2xl text-slate-300 leading-relaxed">
                    Find all pages and resources available on SMTJobs
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-6xl mx-auto">

                <!-- Job Seekers Section -->
                <div class="mb-12">
                    <div class="mb-8">
                        <h2 class="text-3xl md:text-4xl font-black text-black mb-3">For Job Seekers</h2>
                        <p class="text-lg text-slate-600">Find and apply for jobs across various industries</p>
                    </div>
                    
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <a href="{{ route('home') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Home</h3>
                                        <p class="text-sm text-slate-600">Main homepage</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('jobs') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">All Jobs</h3>
                                        <p class="text-sm text-slate-600">Browse all available jobs</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('browse-jobs') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Browse Jobs</h3>
                                        <p class="text-sm text-slate-600">Explore jobs by filters</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('job-by-role') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Jobs by Role</h3>
                                        <p class="text-sm text-slate-600">Find jobs by job role</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('job-by-category') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Jobs by Category</h3>
                                        <p class="text-sm text-slate-600">Browse by job category</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('job-by-industry') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Jobs by Industry</h3>
                                        <p class="text-sm text-slate-600">Explore by industry</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('job-by-company') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Jobs by Company</h3>
                                        <p class="text-sm text-slate-600">Find jobs by companies</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('jobs-by-location') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Jobs by Location</h3>
                                        <p class="text-sm text-slate-600">Search jobs near you</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('login') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Login / Register</h3>
                                        <p class="text-sm text-slate-600">Sign in to your account</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- For Employers Section -->
                <div class="mb-12">
                    <div class="mb-8">
                        <h2 class="text-3xl md:text-4xl font-black text-black mb-3">For Employers</h2>
                        <p class="text-lg text-slate-600">Post jobs and find the best candidates</p>
                    </div>
                    
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <a href="{{ route('recruiter.dashboard') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-slate-900 to-slate-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Employer Dashboard</h3>
                                        <p class="text-sm text-slate-600">Manage your recruitment</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('recruiter.job-posts.create') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-slate-900 to-slate-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Post a Job</h3>
                                        <p class="text-sm text-slate-600">Create new job posting</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('login') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-slate-900 to-slate-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Employer Login</h3>
                                        <p class="text-sm text-slate-600">Access recruiter account</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Company Information Section -->
                <div class="mb-12">
                    <div class="mb-8">
                        <h2 class="text-3xl md:text-4xl font-black text-black mb-3">Company</h2>
                        <p class="text-lg text-slate-600">Learn more about SMTJobs and get in touch</p>
                    </div>
                    
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                        <a href="{{ route('about') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-purple-500 to-purple-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">About Us</h3>
                                        <p class="text-sm text-slate-600">Our story and mission</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('contact') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-purple-500 to-purple-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Contact Us</h3>
                                        <p class="text-sm text-slate-600">Get in touch with us</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('help') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-purple-500 to-purple-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Help Center</h3>
                                        <p class="text-sm text-slate-600">FAQs and support</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('privacy') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-purple-500 to-purple-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Privacy Policy</h3>
                                        <p class="text-sm text-slate-600">How we protect your data</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('terms') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-purple-500 to-purple-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Terms of Service</h3>
                                        <p class="text-sm text-slate-600">Terms and conditions</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="{{ route('sitemap') }}" class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-purple-500 to-purple-700 rounded-2xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-xl p-4 hover:border-black transition-all">
                                <div class="flex items-center gap-3">
                                    <div class="bg-black text-white rounded-lg w-10 h-10 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-black">Sitemap</h3>
                                        <p class="text-sm text-slate-600">Browse all pages</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Quick Links CTA -->
                <div class="relative overflow-hidden rounded-3xl">
                    <!-- Gradient Background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-black via-slate-900 to-black"></div>
                    
                    <!-- Animated Background Elements -->
                    <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
                    <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
                    
                    <!-- Content -->
                    <div class="relative p-12 md:p-16 text-center">
                        <div class="max-w-2xl mx-auto">
                            <h2 class="text-4xl md:text-5xl font-black text-white mb-4">Can't find what you're looking for?</h2>
                            <p class="text-xl text-slate-300 mb-8 leading-relaxed">Our support team is ready to help you navigate our platform</p>
                            
                            <div class="flex flex-col sm:flex-row justify-center gap-4">
                                <a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 relative overflow-hidden">
                                    <div class="absolute inset-0 bg-white transition-transform duration-300 group-hover:scale-105"></div>
                                    <span class="relative px-10 py-5 flex items-center gap-2 rounded-2xl font-bold text-lg text-black">
                                        Contact Support
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </span>
                                </a>
                                
                                <a href="{{ route('help') }}" class="group inline-flex items-center gap-2 relative overflow-hidden">
                                    <div class="absolute inset-0 border-2 border-white rounded-2xl transition-all duration-300 group-hover:bg-white"></div>
                                    <span class="relative px-10 py-5 flex items-center gap-2 rounded-2xl font-bold text-lg text-white group-hover:text-black transition-colors">
                                        Visit Help Center
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
