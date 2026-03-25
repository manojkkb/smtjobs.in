@extends('website.layouts.app')

@section('title', 'Contact Us - SMTJobs')

@section('meta_description', 'Get in touch with SMTJobs. We\'re here to help with any questions about jobs, hiring, or our platform.')

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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span class="text-sm font-semibold">We're Here to Help</span>
                </div>
                
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black mb-6 bg-clip-text text-transparent bg-gradient-to-r from-white to-slate-400">
                    Contact Us
                </h1>
                <p class="text-xl md:text-2xl text-slate-300 leading-relaxed">
                    Have questions? We'd love to hear from you. Send us a message and we'll respond as soon as possible.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-16">
        <div class="max-w-6xl mx-auto">
            
            <div class="grid lg:grid-cols-2 gap-12">
                
                <!-- Contact Form -->
                <div class="relative">
                    <div class="mb-8">
                        <h2 class="text-3xl md:text-4xl font-black text-black mb-3">Send us a Message</h2>
                        <p class="text-lg text-slate-600">Fill out the form below and we'll get back to you soon</p>
                    </div>
                    
                    <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-br from-slate-900/10 to-slate-700/10 rounded-3xl blur-2xl"></div>
                        <div class="relative bg-white border-2 border-slate-200 rounded-3xl p-8 shadow-xl">
                            <form id="contactForm" class="space-y-5">
                                @csrf
                                
                                <div class="group">
                                    <label for="name" class="block text-sm font-bold text-black mb-2">Full Name <span class="text-red-600">*</span></label>
                                    <input type="text" id="name" name="name" required class="w-full rounded-xl border-2 border-slate-200 px-4 py-3.5 text-sm focus:border-black focus:outline-none transition-colors group-hover:border-slate-300" placeholder="John Doe">
                                </div>
                                
                                <div class="group">
                                    <label for="email" class="block text-sm font-bold text-black mb-2">Email Address <span class="text-red-600">*</span></label>
                                    <input type="email" id="email" name="email" required class="w-full rounded-xl border-2 border-slate-200 px-4 py-3.5 text-sm focus:border-black focus:outline-none transition-colors group-hover:border-slate-300" placeholder="john@example.com">
                                </div>
                                
                                <div class="group">
                                    <label for="phone" class="block text-sm font-bold text-black mb-2">Phone Number</label>
                                    <input type="tel" id="phone" name="phone" class="w-full rounded-xl border-2 border-slate-200 px-4 py-3.5 text-sm focus:border-black focus:outline-none transition-colors group-hover:border-slate-300" placeholder="+91 98765 43210">
                                </div>
                                
                                <div class="group">
                                    <label for="subject" class="block text-sm font-bold text-black mb-2">Subject <span class="text-red-600">*</span></label>
                                    <select id="subject" name="subject" required class="w-full rounded-xl border-2 border-slate-200 px-4 py-3.5 text-sm focus:border-black focus:outline-none transition-colors group-hover:border-slate-300">
                                        <option value="">Select a subject</option>
                                        <option value="job_seeker">Job Seeker Support</option>
                                        <option value="employer">Employer/Recruiter Support</option>
                                        <option value="technical">Technical Issue</option>
                                        <option value="partnership">Partnership Inquiry</option>
                                        <option value="feedback">Feedback</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                
                                <div class="group">
                                    <label for="message" class="block text-sm font-bold text-black mb-2">Message <span class="text-red-600">*</span></label>
                                    <textarea id="message" name="message" rows="6" required class="w-full rounded-xl border-2 border-slate-200 px-4 py-3.5 text-sm focus:border-black focus:outline-none transition-colors group-hover:border-slate-300 resize-none" placeholder="How can we help you?"></textarea>
                                </div>
                                
                                <button type="submit" class="group relative w-full overflow-hidden rounded-2xl bg-black px-8 py-4 text-base font-bold text-white transition-all hover:scale-[1.02] active:scale-[0.98]">
                                    <span class="relative flex items-center justify-center gap-2">
                                        Send Message
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Information -->
                <div>
                    <div class="mb-8">
                        <h2 class="text-3xl md:text-4xl font-black text-black mb-3">Get in Touch</h2>
                        <p class="text-lg text-slate-600">We're available to answer your questions</p>
                    </div>
                    
                    <div class="space-y-4">
                        
                        <!-- Office Address -->
                        <div class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-slate-900 to-slate-700 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-2xl p-6 hover:border-black transition-all duration-300">
                                <div class="flex gap-4">
                                    <div class="bg-black text-white rounded-2xl w-14 h-14 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-black text-black mb-2">Office Address</h3>
                                        <p class="text-slate-600 leading-relaxed">
                                        SMTJobs Private Limited<br>
                                        123 Business Tower, MG Road<br>
                                        Bangalore, Karnataka - 560001<br>
                                            India
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Email -->
                        <div class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-slate-900 to-slate-700 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-2xl p-6 hover:border-black transition-all duration-300">
                                <div class="flex gap-4">
                                    <div class="bg-black text-white rounded-2xl w-14 h-14 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-black text-black mb-2">Email Us</h3>
                                        <p class="text-slate-600 leading-relaxed">
                                            General: <a href="mailto:info@smtjobs.com" class="text-black font-semibold hover:underline">info@smtjobs.com</a><br>
                                            Support: <a href="mailto:support@smtjobs.com" class="text-black font-semibold hover:underline">support@smtjobs.com</a><br>
                                            Careers: <a href="mailto:careers@smtjobs.com" class="text-black font-semibold hover:underline">careers@smtjobs.com</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Phone -->
                        <div class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-slate-900 to-slate-700 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-2xl p-6 hover:border-black transition-all duration-300">
                                <div class="flex gap-4">
                                    <div class="bg-black text-white rounded-2xl w-14 h-14 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-black text-black mb-2">Call Us</h3>
                                        <p class="text-slate-600 leading-relaxed">
                                            Job Seekers: <a href="tel:+911234567890" class="text-black font-semibold hover:underline">+91 123 456 7890</a><br>
                                            Employers: <a href="tel:+911234567891" class="text-black font-semibold hover:underline">+91 123 456 7891</a><br>
                                            <span class="text-sm text-slate-500">Mon-Fri, 9:00 AM - 6:00 PM IST</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Social Media -->
                        <div class="group relative">
                            <div class="absolute -inset-1 bg-gradient-to-r from-slate-900 to-slate-700 rounded-3xl blur opacity-25 group-hover:opacity-75 transition duration-500"></div>
                            <div class="relative bg-white border-2 border-slate-200 rounded-2xl p-6 hover:border-black transition-all duration-300">
                                <div class="flex gap-4">
                                    <div class="bg-black text-white rounded-2xl w-14 h-14 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-black text-black mb-3">Follow Us</h3>
                                        <div class="flex gap-3">
                                            <a href="#" class="w-11 h-11 bg-slate-100 hover:bg-black text-black hover:text-white rounded-2xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                            </a>
                                            <a href="#" class="w-11 h-11 bg-slate-100 hover:bg-black text-black hover:text-white rounded-2xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                            </a>
                                            <a href="#" class="w-11 h-11 bg-slate-100 hover:bg-black text-black hover:text-white rounded-2xl flex items-center justify-center transition-all duration-300 hover:scale-110">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                
            </div>

        </div>
    </div>
    
    <script>
        document.getElementById('contactForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for contacting us! We will get back to you within 24-48 hours.');
            this.reset();
        });
    </script>
@endsection
