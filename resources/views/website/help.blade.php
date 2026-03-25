@extends('website.layouts.app')

@section('title', 'Help Center - SMTJobs')

@section('meta_description', 'Find answers to common questions about SMTJobs. Get help with job search, applications, and account management.')

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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-semibold">We're Here to Support You</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-6 bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">
                    Help Center
                </h1>
                <p class="text-xl md:text-2xl text-slate-300 leading-relaxed mb-8">
                    Find answers to your questions and get the help you need
                </p>
                
                <!-- Search Help -->
                <div class="relative max-w-2xl mx-auto">
                    <div class="absolute -inset-2 bg-gradient-to-r from-white/20 to-white/10 rounded-full blur-xl"></div>
                    <div class="relative">
                        <input type="text" id="helpSearch" placeholder="Search for help..." class="w-full rounded-full border-2 border-white/20 bg-white/10 backdrop-blur-sm px-6 py-4 pr-14 text-white placeholder-slate-300 focus:border-white focus:outline-none focus:bg-white/20 transition-all">
                        <button class="absolute right-2 top-1/2 -translate-y-1/2 bg-white text-black rounded-full p-3 hover:scale-110 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="bg-white">
        <div class="container mx-auto px-4 py-16">
            <div class="max-w-6xl mx-auto">

                    <!-- Categories -->
                <div class="grid md:grid-cols-3 gap-6 mb-16">
                    <a href="#job-seekers" class="group relative scroll-smooth">
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-500 to-blue-700 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                        <div class="relative bg-white border-2 border-slate-200 rounded-2xl p-8 hover:border-black transition-all text-center h-full">
                            <div class="bg-black text-white rounded-2xl w-16 h-16 flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-black text-black mb-2">For Job Seekers</h3>
                            <p class="text-slate-600">Find jobs, apply, and manage applications</p>
                        </div>
                    </a>

                    <a href="#employers" class="group relative scroll-smooth">
                        <div class="absolute -inset-1 bg-gradient-to-r from-slate-900 to-slate-700 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                        <div class="relative bg-white border-2 border-slate-200 rounded-2xl p-8 hover:border-black transition-all text-center h-full">
                            <div class="bg-black text-white rounded-2xl w-16 h-16 flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-black text-black mb-2">For Employers</h3>
                            <p class="text-slate-600">Post jobs and find candidates</p>
                        </div>
                    </a>

                    <a href="#account" class="group relative scroll-smooth">
                        <div class="absolute -inset-1 bg-gradient-to-r from-slate-900 to-slate-700 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                        <div class="relative bg-white border-2 border-slate-200 rounded-2xl p-8 hover:border-black transition-all text-center h-full">
                            <div class="bg-black text-white rounded-2xl w-16 h-16 flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-black text-black mb-2">Account & Settings</h3>
                            <p class="text-slate-600">Manage your profile and preferences</p>
                        </div>
                    </a>
                </div>

                <!-- FAQ Sections -->
                <div id="job-seekers" class="mb-16 scroll-mt-24">
                    <div class="mb-8">
                        <h2 class="text-3xl md:text-4xl font-black text-black mb-3">For Job Seekers</h2>
                        <p class="text-lg text-slate-600">Everything you need to know about finding and applying for jobs</p>
                    </div>
                    <div class="space-y-3">
                        <details class="group bg-white border-2 border-slate-200 rounded-2xl hover:border-black transition-all overflow-hidden">
                            <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-lg text-black">
                                <span>How do I create an account?</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="px-6 pb-6 pt-2">
                                <p class="text-slate-600 leading-relaxed">Click on "Sign Up" or "Register" button in the top navigation. Fill in your details including name, email, and password. Verify your email address through the link sent to your inbox to activate your account.</p>
                            </div>
                        </details>

                        <details class="group bg-white border-2 border-slate-200 rounded-2xl hover:border-black transition-all overflow-hidden">
                            <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-lg text-black">
                                <span>How do I search for jobs?</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="px-6 pb-6 pt-2">
                                <p class="text-slate-600 leading-relaxed">Use the search bar on the homepage to enter job titles, keywords, or company names. You can filter results by location, industry, salary range, experience level, and more to find the perfect match.</p>
                            </div>
                        </details>

                        <details class="group bg-white border-2 border-slate-200 rounded-2xl hover:border-black transition-all overflow-hidden">
                            <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-lg text-black">
                                <span>How do I apply for a job?</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="px-6 pb-6 pt-2">
                                <p class="text-slate-600 leading-relaxed">Click on any job listing to view full details. Review the job description and requirements. Click the "Apply Now" button and complete your application by uploading your resume and filling in required information.</p>
                            </div>
                        </details>

                        <details class="group bg-white border-2 border-slate-200 rounded-2xl hover:border-black transition-all overflow-hidden">
                            <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-lg text-black">
                                <span>Can I save jobs to apply later?</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="px-6 pb-6 pt-2">
                                <p class="text-slate-600 leading-relaxed">Yes! Click the bookmark or "Save Job" icon on any job listing. Access your saved jobs anytime from your dashboard under "Saved Jobs" section.</p>
                            </div>
                        </details>

                        <details class="group bg-white border-2 border-slate-200 rounded-2xl hover:border-black transition-all overflow-hidden">
                            <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-lg text-black">
                                <span>How do I track my applications?</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="px-6 pb-6 pt-2">
                                <p class="text-slate-600 leading-relaxed">Go to your dashboard and click on "My Applications". You'll see all your job applications with their current status (Submitted, Under Review, Shortlisted, Interview Scheduled, etc.).</p>
                            </div>
                        </details>
                    </div>
                </div>

                <div id="employers" class="mb-16 scroll-mt-24">
                    <div class="mb-8">
                        <h2 class="text-3xl md:text-4xl font-black text-black mb-3">For Employers</h2>
                        <p class="text-lg text-slate-600">Learn how to post jobs and manage your recruitment process</p>
                    </div>
                    <div class="space-y-3">
                        <details class="group bg-white border-2 border-slate-200 rounded-2xl hover:border-black transition-all overflow-hidden">
                            <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-lg text-black">
                                <span>How do I post a job?</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="px-6 pb-6 pt-2">
                                <p class="text-slate-600 leading-relaxed">Register as an employer, complete your company profile, and click "Post a Job". Fill in job details including title, description, requirements, salary range, and location. Review and publish your job listing.</p>
                            </div>
                        </details>

                        <details class="group bg-white border-2 border-slate-200 rounded-2xl hover:border-black transition-all overflow-hidden">
                            <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-lg text-black">
                                <span>How do I search for candidates?</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="px-6 pb-6 pt-2">
                                <p class="text-slate-600 leading-relaxed">Use our Resume Database feature to search for candidates by skills, experience, location, and education. You can also view applications received for your job postings in your recruiter dashboard.</p>
                            </div>
                        </details>

                        <details class="group bg-white border-2 border-slate-200 rounded-2xl hover:border-black transition-all overflow-hidden">
                            <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-lg text-black">
                                <span>What are the pricing plans?</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="px-6 pb-6 pt-2">
                                <p class="text-slate-600 leading-relaxed">We offer various plans for employers including pay-per-job posting, monthly subscriptions, and enterprise solutions. Contact our sales team for custom pricing based on your hiring needs.</p>
                            </div>
                        </details>

                        <details class="group bg-white border-2 border-slate-200 rounded-2xl hover:border-black transition-all overflow-hidden">
                            <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-lg text-black">
                                <span>How do I manage applications?</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="px-6 pb-6 pt-2">
                                <p class="text-slate-600 leading-relaxed">Access your recruiter dashboard to view all applications. You can filter, shortlist, reject, or schedule interviews directly from the platform. Communicate with candidates through our messaging system.</p>
                            </div>
                        </details>
                    </div>
                </div>

                <div id="account" class="mb-16 scroll-mt-24">
                    <div class="mb-8">
                        <h2 class="text-3xl md:text-4xl font-black text-black mb-3">Account & Settings</h2>
                        <p class="text-lg text-slate-600">Manage your profile, security, and preferences</p>
                    </div>
                    <div class="space-y-3">
                        <details class="group bg-white border-2 border-slate-200 rounded-2xl hover:border-black transition-all overflow-hidden">
                            <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-lg text-black">
                                <span>How do I update my profile?</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="px-6 pb-6 pt-2">
                                <p class="text-slate-600 leading-relaxed">Log in to your account and go to "My Profile". Click "Edit Profile" to update your personal information, work experience, education, skills, and resume. Remember to save your changes.</p>
                            </div>
                        </details>

                        <details class="group bg-white border-2 border-slate-200 rounded-2xl hover:border-black transition-all overflow-hidden">
                            <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-lg text-black">
                                <span>How do I reset my password?</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="px-6 pb-6 pt-2">
                                <p class="text-slate-600 leading-relaxed">Click on "Forgot Password" on the login page. Enter your registered email address. We'll send you a password reset link. Follow the instructions to create a new password.</p>
                            </div>
                        </details>

                        <details class="group bg-white border-2 border-slate-200 rounded-2xl hover:border-black transition-all overflow-hidden">
                            <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-lg text-black">
                                <span>How do I delete my account?</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="px-6 pb-6 pt-2">
                                <p class="text-slate-600 leading-relaxed">Go to Settings > Account Settings > Delete Account. Please note that deleting your account is permanent and will remove all your data including applications, saved jobs, and profile information.</p>
                            </div>
                        </details>

                        <details class="group bg-white border-2 border-slate-200 rounded-2xl hover:border-black transition-all overflow-hidden">
                            <summary class="flex items-center justify-between p-6 cursor-pointer font-bold text-lg text-black">
                                <span>How do I manage email notifications?</span>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-open:rotate-180 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </summary>
                            <div class="px-6 pb-6 pt-2">
                                <p class="text-slate-600 leading-relaxed">Go to Settings > Notifications. You can customize which emails you receive including job alerts, application updates, and promotional emails. Toggle each option according to your preferences.</p>
                            </div>
                        </details>
                    </div>
                </div>

                <!-- Still Need Help -->
                <div class="relative overflow-hidden rounded-3xl">
                    <!-- Gradient Background -->
                    <div class="absolute inset-0 bg-gradient-to-br from-black via-slate-900 to-black"></div>
                    
                    <!-- Animated Background Elements -->
                    <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
                    <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
                    
                    <!-- Content -->
                    <div class="relative p-12 md:p-16 text-center">
                        <div class="max-w-2xl mx-auto">
                            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 rounded-full px-4 py-2 mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" />
                                </svg>
                                <span class="text-sm font-semibold text-white">24/7 Support Available</span>
                            </div>
                            
                            <h2 class="text-4xl md:text-5xl font-black text-white mb-4">Still need help?</h2>
                            <p class="text-xl text-slate-300 mb-8 leading-relaxed">Can't find the answer you're looking for? Our support team is here to help.</p>
                            
                            <a href="{{ route('contact') }}" class="group inline-flex items-center gap-2 relative overflow-hidden">
                                <div class="absolute inset-0 bg-white transition-transform duration-300 group-hover:scale-105"></div>
                                <span class="relative px-10 py-5 flex items-center gap-2 rounded-2xl font-bold text-lg text-black">
                                    Contact Support
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
