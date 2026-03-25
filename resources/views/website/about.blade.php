@extends('website.layouts.app')

@section('title', 'About Us - SMTJobs')

@section('meta_description', 'Learn about SMTJobs - India\'s leading job portal connecting talented professionals with top companies.')

@section('content')
    <!-- Hero Section with Gradient -->
    <div class="relative bg-gradient-to-br from-black via-slate-900 to-slate-800 text-white py-32 overflow-hidden">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-white rounded-full blur-3xl animate-pulse delay-700"></div>
        </div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-6 py-2 mb-8 animate-fade-in">
                    <span class="w-2 h-2 bg-green-400 rounded-full animate-ping"></span>
                    <span class="text-sm font-semibold">Trusted by 100,000+ Job Seekers</span>
                </div>
                <h1 class="text-6xl md:text-7xl font-black mb-6 bg-clip-text text-transparent bg-gradient-to-r from-white via-slate-200 to-slate-400 animate-fade-in-up">
                    About SMTJobs
                </h1>
                <p class="text-xl md:text-2xl text-slate-300 leading-relaxed animate-fade-in-up delay-200">
                    Connecting talented professionals with top companies across India
                </p>
            </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 animate-bounce">
            <svg class="w-6 h-6 text-white/60" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-20">
        <div class="max-w-6xl mx-auto">
            
            <!-- Our Story with Image -->
            <div class="grid lg:grid-cols-2 gap-12 items-center mb-24">
                <div class="order-2 lg:order-1">
                    <div class="inline-flex items-center gap-2 bg-slate-100 rounded-full px-4 py-2 mb-6">
                        <svg class="w-5 h-5 text-black" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-sm font-bold text-black">Our Story</span>
                    </div>
                    <h2 class="text-4xl md:text-5xl font-black text-black mb-6 leading-tight">
                        Revolutionizing Job Search in India
                    </h2>
                    <div class="space-y-4">
                        <p class="text-lg text-slate-700 leading-relaxed">
                            Founded with a vision to revolutionize the job search experience in India, SMTJobs has become a trusted platform for job seekers and employers alike. We understand that finding the right opportunity or the perfect candidate is crucial for success.
                        </p>
                        <p class="text-lg text-slate-700 leading-relaxed">
                            Our platform bridges the gap between talented professionals and forward-thinking companies, making the hiring process seamless, efficient, and transparent.
                        </p>
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <div class="relative group">
                        <div class="absolute -inset-4 bg-gradient-to-r from-slate-900 to-black rounded-3xl blur-2xl opacity-25 group-hover:opacity-40 transition duration-500"></div>
                        <div class="relative bg-gradient-to-br from-slate-100 to-slate-200 rounded-3xl p-12 shadow-2xl">
                            <div class="grid grid-cols-2 gap-6">
                                <div class="bg-white rounded-2xl p-6 shadow-lg transform hover:-translate-y-2 transition duration-300">
                                    <div class="text-4xl font-black text-black mb-2">50K+</div>
                                    <div class="text-sm text-slate-600 font-semibold">Active Jobs</div>
                                </div>
                                <div class="bg-white rounded-2xl p-6 shadow-lg transform hover:-translate-y-2 transition duration-300 delay-75">
                                    <div class="text-4xl font-black text-black mb-2">5K+</div>
                                    <div class="text-sm text-slate-600 font-semibold">Companies</div>
                                </div>
                                <div class="bg-white rounded-2xl p-6 shadow-lg transform hover:-translate-y-2 transition duration-300 delay-150">
                                    <div class="text-4xl font-black text-black mb-2">100K+</div>
                                    <div class="text-sm text-slate-600 font-semibold">Job Seekers</div>
                                </div>
                                <div class="bg-white rounded-2xl p-6 shadow-lg transform hover:-translate-y-2 transition duration-300 delay-225">
                                    <div class="text-4xl font-black text-black mb-2">25K+</div>
                                    <div class="text-sm text-slate-600 font-semibold">Placements</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Mission - Glassmorphism Card -->
            <div class="mb-24">
                <div class="relative overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-br from-slate-900 via-black to-slate-800"></div>
                    <div class="relative backdrop-blur-xl bg-white/10 border border-white/20 rounded-3xl p-12 shadow-2xl">
                        <div class="max-w-3xl mx-auto text-center">
                            <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-2xl mb-6 shadow-xl">
                                <svg class="w-8 h-8 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h2 class="text-4xl font-black text-white mb-6">Our Mission</h2>
                            <p class="text-xl text-slate-200 leading-relaxed">
                                To empower every professional in India with access to meaningful career opportunities and help companies build exceptional teams through innovative technology and personalized service.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Our Values -->
            <div class="mb-24">
                <div class="text-center mb-12">
                    <h2 class="text-4xl md:text-5xl font-black text-black mb-4">Our Core Values</h2>
                    <p class="text-xl text-slate-600">The principles that guide everything we do</p>
                </div>
                <div class="grid md:grid-cols-2 gap-8">
                    <div class="group relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-slate-900 to-slate-700 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                        <div class="relative bg-white border-2 border-slate-200 rounded-3xl p-8 hover:border-black transition-all duration-300 h-full">
                            <div class="bg-black text-white rounded-2xl w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-black mb-3">Integrity</h3>
                            <p class="text-slate-600 leading-relaxed">We operate with honesty and transparency in all our interactions, building trust with every connection we make.</p>
                        </div>
                    </div>
                    
                    <div class="group relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-slate-900 to-slate-700 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                        <div class="relative bg-white border-2 border-slate-200 rounded-3xl p-8 hover:border-black transition-all duration-300 h-full">
                            <div class="bg-black text-white rounded-2xl w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-black mb-3">Innovation</h3>
                            <p class="text-slate-600 leading-relaxed">We continuously improve our platform with cutting-edge technology to deliver the best experience possible.</p>
                        </div>
                    </div>
                    
                    <div class="group relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-slate-900 to-slate-700 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                        <div class="relative bg-white border-2 border-slate-200 rounded-3xl p-8 hover:border-black transition-all duration-300 h-full">
                            <div class="bg-black text-white rounded-2xl w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-black mb-3">Community</h3>
                            <p class="text-slate-600 leading-relaxed">We build lasting relationships with job seekers and employers, creating a supportive ecosystem for all.</p>
                        </div>
                    </div>
                    
                    <div class="group relative">
                        <div class="absolute -inset-1 bg-gradient-to-r from-slate-900 to-slate-700 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                        <div class="relative bg-white border-2 border-slate-200 rounded-3xl p-8 hover:border-black transition-all duration-300 h-full">
                            <div class="bg-black text-white rounded-2xl w-16 h-16 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-black text-black mb-3">Excellence</h3>
                            <p class="text-slate-600 leading-relaxed">We strive for the highest quality in everything we do, from our technology to our customer service.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="mb-24">
                <div class="relative overflow-hidden rounded-3xl">
                    <div class="absolute inset-0 bg-gradient-to-r from-black via-slate-900 to-black"></div>
                    <div class="relative grid grid-cols-2 md:grid-cols-4 gap-px">
                        <div class="bg-black/40 backdrop-blur-sm p-8 text-center hover:bg-black/60 transition duration-300">
                            <div class="text-5xl font-black mb-3 bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">50,000+</div>
                            <div class="text-slate-300 font-semibold">Active Jobs</div>
                        </div>
                        <div class="bg-black/40 backdrop-blur-sm p-8 text-center hover:bg-black/60 transition duration-300">
                            <div class="text-5xl font-black mb-3 bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">5,000+</div>
                            <div class="text-slate-300 font-semibold">Companies</div>
                        </div>
                        <div class="bg-black/40 backdrop-blur-sm p-8 text-center hover:bg-black/60 transition duration-300">
                            <div class="text-5xl font-black mb-3 bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">100,000+</div>
                            <div class="text-slate-300 font-semibold">Job Seekers</div>
                        </div>
                        <div class="bg-black/40 backdrop-blur-sm p-8 text-center hover:bg-black/60 transition duration-300">
                            <div class="text-5xl font-black mb-3 bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">25,000+</div>
                            <div class="text-slate-300 font-semibold">Placements</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="relative overflow-hidden rounded-3xl">
                <!-- Gradient Background -->
                <div class="absolute inset-0 bg-gradient-to-br from-black via-slate-900 to-black"></div>
                
                <!-- Animated Background Elements -->
                <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
                
                <!-- Content -->
                <div class="relative p-12 md:p-16 text-center">
                    <div class="max-w-3xl mx-auto">
                        <!-- Badge -->
                        <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-4 py-2 mb-6">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-ping"></div>
                            <span class="text-sm font-semibold text-white">Join Our Growing Community</span>
                        </div>
                        
                        <h2 class="text-4xl md:text-5xl lg:text-6xl font-black text-white mb-6">
                            Ready to Start Your Journey?
                        </h2>
                        <p class="text-xl md:text-2xl text-slate-300 mb-10 leading-relaxed">
                            Join thousands of professionals who found their dream job through <span class="font-bold text-white">SMTJobs</span>
                        </p>
                        
                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row justify-center gap-4">
                            <a href="{{ route('jobs') }}" class="group relative overflow-hidden">
                                <div class="absolute inset-0 bg-white transition-transform duration-300 group-hover:scale-105"></div>
                                <div class="relative px-10 py-5 flex items-center justify-center gap-2 rounded-2xl font-bold text-lg text-black">
                                    Browse Jobs
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </div>
                            </a>
                            
                            <a href="{{ route('contact') }}" class="group relative overflow-hidden">
                                <div class="absolute inset-0 border-2 border-white rounded-2xl transition-all duration-300 group-hover:bg-white"></div>
                                <div class="relative px-10 py-5 flex items-center justify-center gap-2 rounded-2xl font-bold text-lg text-white group-hover:text-black transition-colors">
                                    Contact Us
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </div>
                            </a>
                        </div>
                        
                        <!-- Trust Indicators -->
                        <div class="mt-12 flex flex-wrap items-center justify-center gap-8 text-slate-400">
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <span class="text-sm font-medium">100% Secure</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-sm font-medium">Free to Join</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span class="text-sm font-medium">Quick Setup</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
