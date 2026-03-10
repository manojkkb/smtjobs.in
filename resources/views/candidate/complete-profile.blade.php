@extends('website.layouts.app')

@section('title', 'Complete Your Profile · SMTJobs')

@section('content')
    <div class="mx-auto w-full max-w-6xl space-y-6 px-4 py-8 sm:px-0">
        <!-- Form Steps -->
        <div class="rounded-[28px] border border-slate-200 bg-white">
            <div class="grid lg:grid-cols-[280px_1fr] gap-0">
                <!-- Left: Progress Sidebar -->
                <div class="hidden lg:block px-6 py-8 bg-slate-50 rounded-l-[28px]">
                    <div class="sticky top-8">
                        <h3 class="text-sm font-bold text-slate-900 mb-6 uppercase tracking-wider">Your Progress</h3>
                        
                        <!-- Progress Steps -->
                        <div class="space-y-6">
                            <!-- Step 1 -->
                            <div class="progress-step flex items-start gap-3" data-progress-step="1">
                                <div class="flex-shrink-0">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-900 text-white progress-circle">
                                        <span class="text-xs font-bold progress-number">1</span>
                                        <svg class="progress-check hidden h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-semibold text-slate-900 progress-title">Basic Details</h4>
                                    <p class="text-xs text-slate-500 mt-0.5">Personal information</p>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="progress-step flex items-start gap-3" data-progress-step="2">
                                <div class="flex-shrink-0">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-200 text-slate-400 progress-circle">
                                        <span class="text-xs font-bold progress-number">2</span>
                                        <svg class="progress-check hidden h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-slate-400 progress-title">Location</h4>
                                    <p class="text-xs text-slate-400 mt-0.5">Where you're based</p>
                                </div>
                            </div>

                            <!-- Step 3 -->
                            <div class="progress-step flex items-start gap-3" data-progress-step="3">
                                <div class="flex-shrink-0">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-200 text-slate-400 progress-circle">
                                        <span class="text-xs font-bold progress-number">3</span>
                                        <svg class="progress-check hidden h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-slate-400 progress-title">Experience</h4>
                                    <p class="text-xs text-slate-400 mt-0.5">Work history</p>
                                </div>
                            </div>

                            <!-- Step 4 -->
                            <div class="progress-step flex items-start gap-3" data-progress-step="4">
                                <div class="flex-shrink-0">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-200 text-slate-400 progress-circle">
                                        <span class="text-xs font-bold progress-number">4</span>
                                        <svg class="progress-check hidden h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-slate-400 progress-title">Education</h4>
                                    <p class="text-xs text-slate-400 mt-0.5">Academic background</p>
                                </div>
                            </div>

                            <!-- Step 5 -->
                            <div class="progress-step flex items-start gap-3" data-progress-step="5">
                                <div class="flex-shrink-0">
                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-200 text-slate-400 progress-circle">
                                        <span class="text-xs font-bold progress-number">5</span>
                                        <svg class="progress-check hidden h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </div>
                                </div>
                                <div>
                                    <h4 class="text-sm font-medium text-slate-400 progress-title">Resume</h4>
                                    <p class="text-xs text-slate-400 mt-0.5">Upload your CV</p>
                                </div>
                            </div>
                        </div>

                        <!-- Overall Progress Bar -->
                        <div class="mt-8 pt-6 border-t border-slate-200">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-semibold text-slate-700">Overall Progress</span>
                                <span class="text-xs font-bold text-slate-900" id="progressPercentage">20%</span>
                            </div>
                            <div class="h-2 rounded-full bg-slate-200 overflow-hidden">
                                <div id="progressBar" class="h-full bg-slate-900 transition-all duration-300" style="width: 20%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right: Form Content -->
                <div class="px-6 py-8 sm:px-8 lg:border-l border-slate-200">
                    <!-- Step 1: Basic Details -->
                    <div class="form-step" data-step="1">
                        <div class="mb-4 flex items-center justify-between">
                            <h2 class="text-xl font-semibold text-slate-900">Basic Details</h2>
                            <div class="text-right">
                                <div class="text-xs font-semibold uppercase tracking-wider text-slate-500">Overall Progress</div>
                                <div class="text-2xl font-bold text-slate-900" id="headerProgressPercentage">0%</div>
                            </div>
                        </div>
                        <!-- Progress Bar Slider -->
                        <div class="mb-6">
                            <div class="h-2 rounded-full bg-slate-200 overflow-hidden">
                                <div class="header-progress-bar h-full bg-gradient-to-r from-slate-900 to-slate-700 transition-all duration-500" style="width: 0%"></div>
                            </div>
                        </div>
                        <form id="basicDetailsForm" class="space-y-4">
                    @csrf
                    <div>
                        <label for="full_name" class="mb-1 block text-sm font-semibold text-slate-700">Name <span class="text-rose-500">*</span></label>
                        <input type="text" id="full_name" name="full_name" value="{{ optional($candidate->profile)->first_name }} {{ optional($candidate->profile)->last_name }}" required
                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        <p class="mt-1 text-xs text-rose-600 hidden" id="full_name_error">Name is required</p>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="date_of_birth" class="mb-1 block text-sm font-semibold text-slate-700">Date of Birth <span class="text-rose-500">*</span></label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ optional($candidate->profile)->date_of_birth?->format('Y-m-d') }}" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                            <p class="mt-1 text-xs text-rose-600 hidden" id="date_of_birth_error">Date of birth is required</p>
                        </div>
                        <div>
                            <label for="gender" class="mb-1 block text-sm font-semibold text-slate-700">Gender <span class="text-rose-500">*</span></label>
                            <select id="gender" name="gender" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                <option value="">Select Gender</option>
                                <option value="male" {{ optional($candidate->profile)->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ optional($candidate->profile)->gender == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ optional($candidate->profile)->gender == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <p class="mt-1 text-xs text-rose-600 hidden" id="gender_error">Please select your gender</p>
                        </div>
                    </div>
                    <div>
                        <label for="email" class="mb-1 block text-sm font-semibold text-slate-700">Email <span class="text-rose-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ $candidate->email }}" required
                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        <p class="mt-1 text-xs text-rose-600 hidden" id="email_error">Please enter a valid email address</p>
                    </div>
                </form>
            </div>

            <!-- Step 2: Location -->
            <div class="form-step hidden" data-step="2">
                <div class="mb-4 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-700" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-semibold text-slate-900">Location</h2>
                    </div>
                    <div class="text-right">
                        <div class="text-xs font-semibold uppercase tracking-wider text-slate-500">Overall Progress</div>
                        <div class="text-2xl font-bold text-slate-900 header-progress">0%</div>
                    </div>
                </div>
                <!-- Progress Bar Slider -->
                <div class="mb-6">
                    <div class="h-2 rounded-full bg-slate-200 overflow-hidden">
                        <div class="header-progress-bar h-full bg-gradient-to-r from-slate-900 to-slate-700 transition-all duration-500" style="width: 0%"></div>
                    </div>
                </div>
                <form id="locationForm" class="space-y-6">
                    @csrf
                    <input type="hidden" id="city_id" name="city_id" value="{{ $candidate->city_id }}">
                    
                    <!-- Search City Option -->
                    <div class="relative">
                        <label class="mb-2 block text-sm font-semibold text-slate-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline h-4 w-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35"/>
                            </svg>
                            Search City <span class="text-rose-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" id="city_search" placeholder="Type to search for your city..." autocomplete="off"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 pr-10 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-4.35-4.35"/>
                            </svg>
                            <!-- Search Results Dropdown -->
                            <div id="city_results" class="hidden absolute z-10 mt-1 max-h-60 w-full overflow-auto rounded-2xl border border-slate-300 bg-white shadow-lg">
                                <!-- Results will be populated here -->
                            </div>
                        </div>
                        <p id="selected_city_display" class="mt-2 text-sm font-medium text-slate-700 hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline h-4 w-4 text-emerald-600 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span id="selected_city_text"></span>
                        </p>
                        <p class="mt-1 text-xs text-rose-600 hidden" id="city_error">Please select a city</p>
                    </div>

                    <!-- OR Divider -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-slate-200"></div>
                        </div>
                        <div class="relative flex justify-center text-xs uppercase">
                            <span class="bg-white px-2 text-slate-500 font-semibold">OR</span>
                        </div>
                    </div>

                    <!-- Pickup Current Location Option -->
                    <div>
                        <button type="button" id="detect_location" 
                            class="w-full inline-flex items-center justify-center gap-2 rounded-2xl border-2 border-slate-900 bg-white px-6 py-3 text-sm font-semibold text-slate-900 transition hover:bg-slate-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v3m0 14v3m9-9h-3M6 12H3m15.364-6.364l-2.121 2.121M8.757 8.757L6.636 6.636m12.728 12.728l-2.121-2.121m-7.071 0l-2.121 2.121"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                            <span>Detect My Current Location</span>
                        </button>
                        <p class="mt-2 text-xs text-slate-500 text-center">We'll automatically find the nearest city to your location</p>
                        <p id="location_status" class="mt-2 text-xs text-center hidden"></p>
                    </div>
                </form>
            </div>

            <!-- Step 3: Experience -->
            <div class="form-step hidden" data-step="3">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-slate-900">Work Experience</h2>
                    <div class="text-right">
                        <div class="text-xs font-semibold uppercase tracking-wider text-slate-500">Overall Progress</div>
                        <div class="text-2xl font-bold text-slate-900 header-progress">0%</div>
                    </div>
                </div>
                <!-- Progress Bar Slider -->
                <div class="mb-6">
                    <div class="h-2 rounded-full bg-slate-200 overflow-hidden">
                        <div class="header-progress-bar h-full bg-gradient-to-r from-slate-900 to-slate-700 transition-all duration-500" style="width: 0%"></div>
                    </div>
                </div>
                <form id="experienceForm" class="space-y-4">
                    @csrf
                    <div id="experienceContainer">
                        @forelse($candidate->experiences ?? [] as $index => $experience)
                            <div class="experience-item space-y-4 rounded-2xl border border-slate-200 bg-slate-50 p-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-semibold text-slate-700">Experience {{ $index + 1 }}</h3>
                                    @if($index > 0)
                                        <button type="button" class="remove-experience text-xs text-rose-600 hover:text-rose-700">Remove</button>
                                    @endif
                                </div>
                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Company Name <span class="text-rose-500">*</span></label>
                                        <input type="text" name="experiences[{{ $index }}][company_name]" value="{{ $experience->company_name }}" required
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Designation <span class="text-rose-500">*</span></label>
                                        <input type="text" name="experiences[{{ $index }}][designation]" value="{{ $experience->designation }}" required
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
                                </div>
                                <div class="grid gap-4 sm:grid-cols-3">
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Start Date <span class="text-rose-500">*</span></label>
                                        <input type="date" name="experiences[{{ $index }}][start_date]" value="{{ $experience->start_date?->format('Y-m-d') }}" required
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
                                    <div class="end-date-container">
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">End Date</label>
                                        <input type="date" name="experiences[{{ $index }}][end_date]" value="{{ $experience->end_date?->format('Y-m-d') }}" {{ $experience->is_current ? 'disabled' : '' }}
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
                                    <div class="flex items-end">
                                        <label class="flex items-center">
                                            <input type="checkbox" name="experiences[{{ $index }}][is_current]" value="1" {{ $experience->is_current ? 'checked' : '' }}
                                                class="is-current-checkbox mr-2 h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-2 focus:ring-slate-200">
                                            <span class="text-sm text-slate-700">Currently working</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="experience-item space-y-4 rounded-2xl border border-slate-200 bg-slate-50 p-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-semibold text-slate-700">Experience 1</h3>
                                </div>
                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Company Name <span class="text-rose-500">*</span></label>
                                        <input type="text" name="experiences[0][company_name]" required
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Designation <span class="text-rose-500">*</span></label>
                                        <input type="text" name="experiences[0][designation]" required
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
                                </div>
                                <div class="grid gap-4 sm:grid-cols-3">
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Start Date <span class="text-rose-500">*</span></label>
                                        <input type="date" name="experiences[0][start_date]" required
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
                                    <div class="end-date-container">
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">End Date</label>
                                        <input type="date" name="experiences[0][end_date]"
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
                                    <div class="flex items-end">
                                        <label class="flex items-center">
                                            <input type="checkbox" name="experiences[0][is_current]" value="1"
                                                class="is-current-checkbox mr-2 h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-2 focus:ring-slate-200">
                                            <span class="text-sm text-slate-700">Currently working</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <button type="button" id="addExperience"
                        class="inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-wider text-slate-700 transition hover:border-slate-400 hover:text-slate-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                        </svg>
                        Add More Experience
                    </button>
                </form>
            </div>

            <!-- Step 4: Education -->
            <div class="form-step hidden" data-step="4">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-slate-900">Education</h2>
                    <div class="text-right">
                        <div class="text-xs font-semibold uppercase tracking-wider text-slate-500">Overall Progress</div>
                        <div class="text-2xl font-bold text-slate-900 header-progress">0%</div>
                    </div>
                </div>
                <!-- Progress Bar Slider -->
                <div class="mb-6">
                    <div class="h-2 rounded-full bg-slate-200 overflow-hidden">
                        <div class="header-progress-bar h-full bg-gradient-to-r from-slate-900 to-slate-700 transition-all duration-500" style="width: 0%"></div>
                    </div>
                </div>
                <form id="educationForm" class="space-y-4">
                    @csrf
                    <div id="educationContainer">
                        @forelse($candidate->education ?? [] as $index => $edu)
                            <div class="education-item space-y-4 rounded-2xl border border-slate-200 bg-slate-50 p-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-semibold text-slate-700">Education {{ $index + 1 }}</h3>
                                    @if($index > 0)
                                        <button type="button" class="remove-education text-xs text-rose-600 hover:text-rose-700">Remove</button>
                                    @endif
                                </div>
                                <div class="grid gap-4 sm:grid-cols-3">
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Education Level <span class="text-rose-500">*</span></label>
                                        <select name="education[{{ $index }}][level]" required class="education-level w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200" data-index="{{ $index }}">
                                            <option value="">Select Level</option>
                                            @foreach($educationLevels as $level)
                                                <option value="{{ $level->id }}" {{ isset($edu->education_level_id) && $edu->education_level_id == $level->id ? 'selected' : '' }}>{{ $level->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Degree/Qualification <span class="text-rose-500">*</span></label>
                                        <select name="education[{{ $index }}][degree]" required class="education-degree w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200" data-index="{{ $index }}">
                                            <option value="">Select Degree</option>
                                            @foreach($educationDegrees as $degree)
                                                <option value="{{ $degree->id }}" data-level="{{ $degree->education_level_id }}" {{ isset($edu->education_degree_id) && $edu->education_degree_id == $degree->id ? 'selected' : '' }}>{{ $degree->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Specialization</label>
                                        <select name="education[{{ $index }}][specialization]" class="education-specialization w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200" data-index="{{ $index }}">
                                            <option value="">Select Specialization</option>
                                            @foreach($educationSpecializations as $spec)
                                                <option value="{{ $spec->id }}" data-degree="{{ $spec->education_degree_id }}" {{ isset($edu->education_specialization_id) && $edu->education_specialization_id == $spec->id ? 'selected' : '' }}>{{ $spec->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Institution <span class="text-rose-500">*</span></label>
                                        <input type="text" name="education[{{ $index }}][institution]" value="{{ $edu->institute_name ?? '' }}" required
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
                                </div>
                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Passing Year <span class="text-rose-500">*</span></label>
                                        <input type="number" name="education[{{ $index }}][passing_year]" value="{{ $edu->passing_year }}" min="1950" max="{{ date('Y') + 10 }}" required
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Percentage/CGPA</label>
                                        <input type="number" name="education[{{ $index }}][percentage]" value="{{ $edu->percentage }}" min="0" max="100" step="0.01"
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="education-item space-y-4 rounded-2xl border border-slate-200 bg-slate-50 p-4 mb-4">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-semibold text-slate-700">Education 1</h3>
                                </div>
                                <div class="grid gap-4 sm:grid-cols-3">
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Education Level <span class="text-rose-500">*</span></label>
                                        <select name="education[0][level]" required class="education-level w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200" data-index="0">
                                            <option value="">Select Level</option>
                                            @foreach($educationLevels as $level)
                                                <option value="{{ $level->id }}">{{ $level->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Degree/Qualification <span class="text-rose-500">*</span></label>
                                        <select name="education[0][degree]" required class="education-degree w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200" data-index="0">
                                            <option value="">Select Degree</option>
                                            @foreach($educationDegrees as $degree)
                                                <option value="{{ $degree->id }}" data-level="{{ $degree->education_level_id }}">{{ $degree->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Specialization</label>
                                        <select name="education[0][specialization]" class="education-specialization w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200" data-index="0">
                                            <option value="">Select Specialization</option>
                                            @foreach($educationSpecializations as $spec)
                                                <option value="{{ $spec->id }}" data-degree="{{ $spec->education_degree_id }}">{{ $spec->label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Institution <span class="text-rose-500">*</span></label>
                                        <input type="text" name="education[0][institution]" required
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
                                </div>
                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Passing Year <span class="text-rose-500">*</span></label>
                                        <input type="number" name="education[0][passing_year]" min="1950" max="{{ date('Y') + 10 }}" required
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Percentage/CGPA</label>
                                        <input type="number" name="education[0][percentage]" min="0" max="100" step="0.01"
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <button type="button" id="addEducation"
                        class="inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-wider text-slate-700 transition hover:border-slate-400 hover:text-slate-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                        </svg>
                        Add More Education
                    </button>
                </form>
            </div>

            <!-- Step 5: Resume -->
            <div class="form-step hidden" data-step="5">
                <div class="mb-4 flex items-center justify-between">
                    <h2 class="text-xl font-semibold text-slate-900">Upload Resume <span class="text-sm font-normal text-slate-500">(Optional)</span></h2>
                    <div class="text-right">
                        <div class="text-xs font-semibold uppercase tracking-wider text-slate-500">Overall Progress</div>
                        <div class="text-2xl font-bold text-slate-900 header-progress">0%</div>
                    </div>
                </div>
                <!-- Progress Bar Slider -->
                <div class="mb-6">
                    <div class="h-2 rounded-full bg-slate-200 overflow-hidden">
                        <div class="header-progress-bar h-full bg-gradient-to-r from-slate-900 to-slate-700 transition-all duration-500" style="width: 0%"></div>
                    </div>
                </div>
                <form id="resumeForm" class="space-y-4">
                    @csrf
                    <div class="rounded-2xl border-2 border-dashed border-slate-300 bg-slate-50 p-8 text-center">
                        <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-slate-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </div>
                        <h3 class="mb-2 text-sm font-semibold text-slate-900">Upload your resume</h3>
                        <p class="mb-4 text-xs text-slate-600">PDF, DOC, or DOCX (Max 5MB)</p>
                        <input type="file" id="resume" name="resume" accept=".pdf,.doc,.docx" class="hidden">
                        <button type="button" id="selectFileBtn"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-900 bg-slate-900 px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-white transition hover:bg-slate-800">
                            Select File
                        </button>
                        <div id="fileName" class="mt-4 hidden text-sm text-slate-700">
                            <span class="font-semibold">Selected:</span> <span id="fileNameText"></span>
                        </div>
                        @if(optional($candidate->profile)->resume_path)
                            <div class="mt-4 text-sm text-emerald-600">
                                <span class="font-semibold">Current resume:</span> {{ basename($candidate->profile->resume_path) }}
                            </div>
                        @endif
                    </div>
                    <p class="text-xs text-slate-500">Your resume helps recruiters understand your skills and experience better. You can skip this step and upload it later.</p>
                </form>
            </div>

            <!-- Navigation Buttons -->
            <div class="mt-8 flex items-center justify-between border-t border-slate-200 pt-6">
                <button type="button" id="prevBtn"
                    class="hidden items-center gap-2 rounded-full border border-slate-300 bg-white px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-slate-700 transition hover:border-slate-400 hover:text-slate-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                    </svg>
                    Previous
                </button>
                <button type="button" id="nextBtn"
                    class="inline-flex items-center gap-2 rounded-full border border-slate-900 bg-slate-900 px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-white transition hover:bg-slate-800">
                    Next
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <button type="button" id="submitBtn"
                    class="hidden items-center gap-2 rounded-full border border-slate-900 bg-slate-900 px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-white transition hover:bg-slate-800">
                    Complete Profile
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </button>
            </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentStep = 1;
        const totalSteps = 5;

        // Education data for dynamic forms
        const educationLevelOptions = `
            <option value="">Select Level</option>
            @foreach($educationLevels as $level)
                <option value="{{ $level->id }}">{{ $level->label }}</option>
            @endforeach
        `;

        const educationDegreeOptions = `
            <option value="">Select Degree</option>
            @foreach($educationDegrees as $degree)
                <option value="{{ $degree->id }}" data-level="{{ $degree->education_level_id }}">{{ $degree->label }}</option>
            @endforeach
        `;

        const educationSpecializationOptions = `
            <option value="">Select Specialization</option>
            @foreach($educationSpecializations as $spec)
                <option value="{{ $spec->id }}" data-degree="{{ $spec->education_degree_id }}">{{ $spec->label }}</option>
            @endforeach
        `;

        // Update progress indicator
        function updateProgress() {
            document.querySelectorAll('.step-indicator').forEach(indicator => {
                const step = parseInt(indicator.dataset.step);
                const circle = indicator.querySelector('.step-circle');
                const line = indicator.querySelector('.step-line');
                const number = indicator.querySelector('.step-number');
                const check = indicator.querySelector('.step-check');
                const label = document.querySelector(`.step-label[data-step="${step}"]`);

                if (step < currentStep) {
                    // Completed step
                    circle.classList.add('border-slate-900', 'bg-slate-900', 'text-white');
                    circle.classList.remove('border-slate-300', 'bg-white', 'text-slate-400');
                    number.classList.add('hidden');
                    check.classList.remove('hidden');
                    if (line) line.classList.add('border-slate-900');
                    label.classList.add('text-slate-700');
                    label.classList.remove('text-slate-400');
                } else if (step === currentStep) {
                    // Current step
                    circle.classList.add('border-slate-900', 'bg-slate-900', 'text-white');
                    circle.classList.remove('border-slate-300', 'bg-white', 'text-slate-400');
                    number.classList.remove('hidden');
                    check.classList.add('hidden');
                    if (line) line.classList.remove('border-slate-900');
                    label.classList.add('text-slate-700');
                    label.classList.remove('text-slate-400');
                } else {
                    // Future step
                    circle.classList.remove('border-slate-900', 'bg-slate-900', 'text-white');
                    circle.classList.add('border-slate-300', 'bg-white', 'text-slate-400');
                    number.classList.remove('hidden');
                    check.classList.add('hidden');
                    if (line) line.classList.remove('border-slate-900');
                    label.classList.remove('text-slate-700');
                    label.classList.add('text-slate-400');
                }
            });

            // Update right sidebar progress
            document.querySelectorAll('.progress-step').forEach(progressStep => {
                const step = parseInt(progressStep.dataset.progressStep);
                const circle = progressStep.querySelector('.progress-circle');
                const number = progressStep.querySelector('.progress-number');
                const check = progressStep.querySelector('.progress-check');
                const title = progressStep.querySelector('.progress-title');

                if (step < currentStep) {
                    // Completed step
                    circle.classList.add('bg-emerald-500', 'text-white');
                    circle.classList.remove('bg-slate-900', 'bg-slate-200', 'text-slate-400');
                    number.classList.add('hidden');
                    check.classList.remove('hidden');
                    title.classList.add('text-slate-900', 'font-semibold');
                    title.classList.remove('text-slate-400', 'font-medium');
                } else if (step === currentStep) {
                    // Current step
                    circle.classList.add('bg-slate-900', 'text-white');
                    circle.classList.remove('bg-emerald-500', 'bg-slate-200', 'text-slate-400');
                    number.classList.remove('hidden');
                    check.classList.add('hidden');
                    title.classList.add('text-slate-900', 'font-semibold');
                    title.classList.remove('text-slate-400', 'font-medium');
                } else {
                    // Future step
                    circle.classList.remove('bg-slate-900', 'bg-emerald-500', 'text-white');
                    circle.classList.add('bg-slate-200', 'text-slate-400');
                    number.classList.remove('hidden');
                    check.classList.add('hidden');
                    title.classList.remove('text-slate-900', 'font-semibold');
                    title.classList.add('text-slate-400', 'font-medium');
                }
            });

            // Update progress bar
            const percentage = ((currentStep - 1) / (totalSteps - 1)) * 100;
            const progressBar = document.getElementById('progressBar');
            const progressPercentage = document.getElementById('progressPercentage');
            const headerProgressPercentage = document.getElementById('headerProgressPercentage');
            const headerProgressElements = document.querySelectorAll('.header-progress');
            const headerProgressBars = document.querySelectorAll('.header-progress-bar');
            
            if (progressBar) progressBar.style.width = percentage + '%';
            if (progressPercentage) progressPercentage.textContent = Math.round(percentage) + '%';
            if (headerProgressPercentage) headerProgressPercentage.textContent = Math.round(percentage) + '%';
            headerProgressElements.forEach(el => {
                el.textContent = Math.round(percentage) + '%';
            });
            headerProgressBars.forEach(bar => {
                bar.style.width = percentage + '%';
            });

            // Show/hide navigation buttons
            document.getElementById('prevBtn').classList.toggle('hidden', currentStep === 1);
            document.getElementById('prevBtn').classList.toggle('inline-flex', currentStep !== 1);
            document.getElementById('nextBtn').classList.toggle('hidden', currentStep === totalSteps);
            document.getElementById('submitBtn').classList.toggle('hidden', currentStep !== totalSteps);
            document.getElementById('submitBtn').classList.toggle('inline-flex', currentStep === totalSteps);
        }

        // Show specific step
        function showStep(step) {
            document.querySelectorAll('.form-step').forEach(formStep => {
                formStep.classList.add('hidden');
            });
            document.querySelector(`.form-step[data-step="${step}"]`).classList.remove('hidden');
            currentStep = step;
            updateProgress();
        }

        // Save current step data
        async function saveStepData() {
            let formData, url;

            switch(currentStep) {
                case 1:
                    formData = new FormData(document.getElementById('basicDetailsForm'));
                    url = '{{ route("candidate.complete.profile.basic") }}';
                    break;
                case 2:
                    formData = new FormData(document.getElementById('locationForm'));
                    url = '{{ route("candidate.complete.profile.location") }}';
                    break;
                case 3:
                    formData = new FormData(document.getElementById('experienceForm'));
                    url = '{{ route("candidate.complete.profile.experience") }}';
                    break;
                case 4:
                    formData = new FormData(document.getElementById('educationForm'));
                    url = '{{ route("candidate.complete.profile.education") }}';
                    break;
                case 5:
                    formData = new FormData(document.getElementById('resumeForm'));
                    url = '{{ route("candidate.complete.profile.resume") }}';
                    break;
            }

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                });

                const data = await response.json();
                
                if (!response.ok) {
                    throw new Error(data.message || 'Failed to save data');
                }

                return true;
            } catch (error) {
                alert(error.message || 'An error occurred while saving data');
                return false;
            }
        }

        // Inline validation for Basic Details
        function validateBasicDetails() {
            let isValid = true;
            
            // Validate Name
            const fullName = document.getElementById('full_name');
            const fullNameError = document.getElementById('full_name_error');
            if (!fullName.value.trim()) {
                fullName.classList.add('border-rose-500');
                fullNameError.classList.remove('hidden');
                isValid = false;
            } else {
                fullName.classList.remove('border-rose-500');
                fullNameError.classList.add('hidden');
            }
            
            // Validate Date of Birth
            const dateOfBirth = document.getElementById('date_of_birth');
            const dateOfBirthError = document.getElementById('date_of_birth_error');
            if (!dateOfBirth.value) {
                dateOfBirth.classList.add('border-rose-500');
                dateOfBirthError.classList.remove('hidden');
                isValid = false;
            } else {
                dateOfBirth.classList.remove('border-rose-500');
                dateOfBirthError.classList.add('hidden');
            }
            
            // Validate Gender
            const gender = document.getElementById('gender');
            const genderError = document.getElementById('gender_error');
            if (!gender.value) {
                gender.classList.add('border-rose-500');
                genderError.classList.remove('hidden');
                isValid = false;
            } else {
                gender.classList.remove('border-rose-500');
                genderError.classList.add('hidden');
            }
            
            // Validate Email
            const email = document.getElementById('email');
            const emailError = document.getElementById('email_error');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email.value.trim() || !emailPattern.test(email.value)) {
                email.classList.add('border-rose-500');
                emailError.classList.remove('hidden');
                isValid = false;
            } else {
                email.classList.remove('border-rose-500');
                emailError.classList.add('hidden');
            }
            
            return isValid;
        }
        
        // Add real-time validation listeners for Basic Details
        document.getElementById('full_name').addEventListener('blur', validateBasicDetails);
        document.getElementById('date_of_birth').addEventListener('blur', validateBasicDetails);
        document.getElementById('gender').addEventListener('change', validateBasicDetails);
        document.getElementById('email').addEventListener('blur', validateBasicDetails);

        // Location Step: City Search Functionality
        const citySearch = document.getElementById('city_search');
        const cityResults = document.getElementById('city_results');
        const cityIdInput = document.getElementById('city_id');
        const selectedCityDisplay = document.getElementById('selected_city_display');
        const selectedCityText = document.getElementById('selected_city_text');
        const cityError = document.getElementById('city_error');
        
        // Cities data from server
        const cities = @json($cities);
        
        // Populate search with current selection
        if (cityIdInput.value) {
            const currentCity = cities.find(c => c.id == cityIdInput.value);
            if (currentCity) {
                const stateName = currentCity.state?.name;
                const displayText = stateName ? `${currentCity.name}, ${stateName}` : currentCity.name;
                citySearch.value = displayText;
                selectedCityText.textContent = displayText;
                selectedCityDisplay.classList.remove('hidden');
            }
        }
        
        // City search input handler
        citySearch.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            if (searchTerm.length < 2) {
                cityResults.classList.add('hidden');
                return;
            }
            
            const filteredCities = cities.filter(city => {
                const cityName = city.name.toLowerCase();
                const stateName = city.state?.name?.toLowerCase() || '';
                return cityName.includes(searchTerm) || stateName.includes(searchTerm);
            }).slice(0, 10); // Limit to 10 results
            
            if (filteredCities.length > 0) {
                cityResults.innerHTML = filteredCities.map(city => {
                    const stateName = city.state?.name;
                    const displayText = stateName ? `${city.name}, ${stateName}` : city.name;
                    return `
                        <div class="city-result cursor-pointer px-4 py-2.5 text-sm text-slate-700 hover:bg-slate-50 border-b border-slate-100 last:border-b-0" data-city-id="${city.id}" data-city-name="${displayText}">
                            <svg xmlns="http://www.w3.org/2000/svg" class="inline h-4 w-4 mr-2 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            ${displayText}
                        </div>
                    `;
                }).join('');
                cityResults.classList.remove('hidden');
                
                // Add click handlers to results
                document.querySelectorAll('.city-result').forEach(result => {
                    result.addEventListener('click', function() {
                        const cityId = this.dataset.cityId;
                        const cityName = this.dataset.cityName;
                        
                        cityIdInput.value = cityId;
                        citySearch.value = cityName;
                        selectedCityText.textContent = cityName;
                        selectedCityDisplay.classList.remove('hidden');
                        cityResults.classList.add('hidden');
                        citySearch.classList.remove('border-rose-500');
                        cityError.classList.add('hidden');
                    });
                });
            } else {
                cityResults.innerHTML = '<div class="px-4 py-3 text-sm text-slate-500">No cities found</div>';
                cityResults.classList.remove('hidden');
            }
        });
        
        // Hide results when clicking outside
        document.addEventListener('click', function(e) {
            if (!citySearch.contains(e.target) && !cityResults.contains(e.target)) {
                cityResults.classList.add('hidden');
            }
        });
        
        // Geolocation: Detect Current Location
        const detectLocationBtn = document.getElementById('detect_location');
        const locationStatus = document.getElementById('location_status');
        
        detectLocationBtn.addEventListener('click', function() {
            if (!navigator.geolocation) {
                locationStatus.textContent = '❌ Geolocation is not supported by your browser';
                locationStatus.classList.remove('hidden', 'text-emerald-600');
                locationStatus.classList.add('text-rose-600');
                return;
            }
            
            // Show loading state
            detectLocationBtn.disabled = true;
            detectLocationBtn.innerHTML = `
                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Detecting location...</span>
            `;
            locationStatus.textContent = '📍 Getting your location...';
            locationStatus.classList.remove('hidden', 'text-rose-600');
            locationStatus.classList.add('text-slate-600');
            
            navigator.geolocation.getCurrentPosition(
                async function(position) {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;
                    
                    // Find nearest city based on coordinates
                    try {
                        const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`);
                        const data = await response.json();
                        const detectedCity = data.address.city || data.address.town || data.address.village || data.address.county;
                        const detectedState = data.address.state;
                        
                        // Try to match with our cities database
                        const matchedCity = cities.find(city => {
                            const cityMatch = city.name.toLowerCase() === detectedCity?.toLowerCase();
                            const stateMatch = city.state?.name?.toLowerCase() === detectedState?.toLowerCase();
                            return cityMatch || stateMatch;
                        });
                        
                        if (matchedCity) {
                            const stateName = matchedCity.state?.name;
                            const displayText = stateName ? `${matchedCity.name}, ${stateName}` : matchedCity.name;
                            
                            cityIdInput.value = matchedCity.id;
                            citySearch.value = displayText;
                            selectedCityText.textContent = displayText;
                            selectedCityDisplay.classList.remove('hidden');
                            citySearch.classList.remove('border-rose-500');
                            cityError.classList.add('hidden');
                            
                            locationStatus.textContent = '✅ Location detected successfully!';
                            locationStatus.classList.remove('text-slate-600', 'text-rose-600');
                            locationStatus.classList.add('text-emerald-600');
                        } else {
                            locationStatus.textContent = `📍 Detected: ${detectedCity}, ${detectedState}. Please search manually if not in list.`;
                            locationStatus.classList.remove('text-slate-600', 'text-rose-600');
                            locationStatus.classList.add('text-amber-600');
                            citySearch.value = detectedCity;
                            citySearch.focus();
                            // Trigger search
                            citySearch.dispatchEvent(new Event('input'));
                        }
                    } catch (error) {
                        locationStatus.textContent = '❌ Could not determine city. Please search manually.';
                        locationStatus.classList.remove('text-slate-600', 'text-emerald-600');
                        locationStatus.classList.add('text-rose-600');
                    }
                    
                    // Reset button
                    detectLocationBtn.disabled = false;
                    detectLocationBtn.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v3m0 14v3m9-9h-3M6 12H3m15.364-6.364l-2.121 2.121M8.757 8.757L6.636 6.636m12.728 12.728l-2.121-2.121m-7.071 0l-2.121 2.121"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                        <span>Detect My Current Location</span>
                    `;
                },
                function(error) {
                    let errorMsg = '❌ ';
                    switch(error.code) {
                        case error.PERMISSION_DENIED:
                            errorMsg += 'Location access denied. Please enable location permissions.';
                            break;
                        case error.POSITION_UNAVAILABLE:
                            errorMsg += 'Location information unavailable.';
                            break;
                        case error.TIMEOUT:
                            errorMsg += 'Location request timed out.';
                            break;
                        default:
                            errorMsg += 'An unknown error occurred.';
                    }
                    
                    locationStatus.textContent = errorMsg;
                    locationStatus.classList.remove('hidden', 'text-slate-600', 'text-emerald-600');
                    locationStatus.classList.add('text-rose-600');
                    
                    // Reset button
                    detectLocationBtn.disabled = false;
                    detectLocationBtn.innerHTML = `
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v3m0 14v3m9-9h-3M6 12H3m15.364-6.364l-2.121 2.121M8.757 8.757L6.636 6.636m12.728 12.728l-2.121-2.121m-7.071 0l-2.121 2.121"/>
                            <circle cx="12" cy="12" r="3"/>
                        </svg>
                        <span>Detect My Current Location</span>
                    `;
                }
            );
        });
        
        // Validate Location
        function validateLocation() {
            if (!cityIdInput.value) {
                citySearch.classList.add('border-rose-500');
                cityError.classList.remove('hidden');
                return false;
            }
            citySearch.classList.remove('border-rose-500');
            cityError.classList.add('hidden');
            return true;
        }

        // Next button
        document.getElementById('nextBtn').addEventListener('click', async function() {
            // Validate if on step 1
            if (currentStep === 1) {
                if (!validateBasicDetails()) {
                    return;
                }
            }
            
            // Validate if on step 2 (Location)
            if (currentStep === 2) {
                if (!validateLocation()) {
                    return;
                }
            }
            
            if (await saveStepData()) {
                if (currentStep < totalSteps) {
                    showStep(currentStep + 1);
                }
            }
        });

        // Previous button
        document.getElementById('prevBtn').addEventListener('click', function() {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        });

        // Submit button
        document.getElementById('submitBtn').addEventListener('click', async function() {
            if (await saveStepData()) {
                // Submit final form
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route("candidate.complete.profile.submit") }}';
                
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                const csrfInput = document.createElement('input');
                csrfInput.type = 'hidden';
                csrfInput.name = '_token';
                csrfInput.value = csrfToken;
                form.appendChild(csrfInput);
                
                document.body.appendChild(form);
                form.submit();
            }
        });

        // Add experience
        document.getElementById('addExperience').addEventListener('click', function() {
            const container = document.getElementById('experienceContainer');
            const count = container.querySelectorAll('.experience-item').length;
            
            const template = `
                <div class="experience-item space-y-4 rounded-2xl border border-slate-200 bg-slate-50 p-4 mb-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-slate-700">Experience ${count + 1}</h3>
                        <button type="button" class="remove-experience text-xs text-rose-600 hover:text-rose-700">Remove</button>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Company Name <span class="text-rose-500">*</span></label>
                            <input type="text" name="experiences[${count}][company_name]" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Designation <span class="text-rose-500">*</span></label>
                            <input type="text" name="experiences[${count}][designation]" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Start Date <span class="text-rose-500">*</span></label>
                            <input type="date" name="experiences[${count}][start_date]" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                        <div class="end-date-container">
                            <label class="mb-1 block text-sm font-semibold text-slate-700">End Date</label>
                            <input type="date" name="experiences[${count}][end_date]"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                        <div class="flex items-end">
                            <label class="flex items-center">
                                <input type="checkbox" name="experiences[${count}][is_current]" value="1"
                                    class="is-current-checkbox mr-2 h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-2 focus:ring-slate-200">
                                <span class="text-sm text-slate-700">Currently working</span>
                            </label>
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', template);
        });

        // Remove experience
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-experience')) {
                e.target.closest('.experience-item').remove();
            }
        });

        // Handle "currently working" checkbox
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('is-current-checkbox')) {
                const container = e.target.closest('.experience-item');
                const endDateInput = container.querySelector('.end-date-container input');
                endDateInput.disabled = e.target.checked;
                if (e.target.checked) {
                    endDateInput.value = '';
                }
            }
        });

        // Add education
        document.getElementById('addEducation').addEventListener('click', function() {
            const container = document.getElementById('educationContainer');
            const count = container.querySelectorAll('.education-item').length;
            
            const template = `
                <div class="education-item space-y-4 rounded-2xl border border-slate-200 bg-slate-50 p-4 mb-4">
                    <div class="flex items-center justify-between">
                        <h3 class="text-sm font-semibold text-slate-700">Education ${count + 1}</h3>
                        <button type="button" class="remove-education text-xs text-rose-600 hover:text-rose-700">Remove</button>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Education Level <span class="text-rose-500">*</span></label>
                            <select name="education[${count}][level]" required class="education-level w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200" data-index="${count}">
                                ${educationLevelOptions}
                            </select>
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Degree/Qualification <span class="text-rose-500">*</span></label>
                            <select name="education[${count}][degree]" required class="education-degree w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200" data-index="${count}">
                                ${educationDegreeOptions}
                            </select>
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Specialization</label>
                            <select name="education[${count}][specialization]" class="education-specialization w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200" data-index="${count}">
                                ${educationSpecializationOptions}
                            </select>
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Institution <span class="text-rose-500">*</span></label>
                            <input type="text" name="education[${count}][institution]" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Passing Year <span class="text-rose-500">*</span></label>
                            <input type="number" name="education[${count}][passing_year]" min="1950" max="{{ date('Y') + 10 }}" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Percentage/CGPA</label>
                            <input type="number" name="education[${count}][percentage]" min="0" max="100" step="0.01"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                    </div>
                </div>
            `;
            
            container.insertAdjacentHTML('beforeend', template);
        });

        // Remove education
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-education')) {
                e.target.closest('.education-item').remove();
            }
        });

        // Cascading dropdown logic for education
        document.addEventListener('change', function(e) {
            // When education level changes, filter degrees
            if (e.target.classList.contains('education-level')) {
                const levelId = e.target.value;
                const index = e.target.dataset.index;
                const degreeSelect = document.querySelector(`.education-degree[data-index="${index}"]`);
                const specializationSelect = document.querySelector(`.education-specialization[data-index="${index}"]`);
                
                if (degreeSelect) {
                    // Reset and filter degree options
                    const allDegreeOptions = degreeSelect.querySelectorAll('option');
                    allDegreeOptions.forEach(option => {
                        if (option.value === '') {
                            option.style.display = 'block';
                        } else if (!levelId || option.dataset.level === levelId) {
                            option.style.display = 'block';
                        } else {
                            option.style.display = 'none';
                        }
                    });
                    degreeSelect.value = '';
                }
                
                if (specializationSelect) {
                    specializationSelect.value = '';
                    const allSpecOptions = specializationSelect.querySelectorAll('option');
                    allSpecOptions.forEach(option => {
                        option.style.display = option.value === '' ? 'block' : 'none';
                    });
                }
            }
            
            // When degree changes, filter specializations
            if (e.target.classList.contains('education-degree')) {
                const degreeId = e.target.value;
                const index = e.target.dataset.index;
                const specializationSelect = document.querySelector(`.education-specialization[data-index="${index}"]`);
                
                if (specializationSelect) {
                    // Reset and filter specialization options
                    const allSpecOptions = specializationSelect.querySelectorAll('option');
                    allSpecOptions.forEach(option => {
                        if (option.value === '') {
                            option.style.display = 'block';
                        } else if (!degreeId || option.dataset.degree === degreeId) {
                            option.style.display = 'block';
                        } else {
                            option.style.display = 'none';
                        }
                    });
                    specializationSelect.value = '';
                }
            }
        });

        // Initialize filters on page load for existing education items
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.education-level').forEach(function(levelSelect) {
                if (levelSelect.value) {
                    levelSelect.dispatchEvent(new Event('change'));
                }
            });
            document.querySelectorAll('.education-degree').forEach(function(degreeSelect) {
                if (degreeSelect.value) {
                    degreeSelect.dispatchEvent(new Event('change'));
                }
            });
        });

        // File upload
        document.getElementById('selectFileBtn').addEventListener('click', function() {
            document.getElementById('resume').click();
        });

        document.getElementById('resume').addEventListener('change', function() {
            const fileName = this.files[0]?.name;
            if (fileName) {
                document.getElementById('fileNameText').textContent = fileName;
                document.getElementById('fileName').classList.remove('hidden');
            }
        });

        // Initialize
        showStep(1);
    </script>
@endsection
