@extends('website.layouts.app')

@section('title', 'Complete Your Profile · SMTJobs')

@section('content')
    <div class="mx-auto w-full max-w-4xl space-y-6 px-4 py-8 sm:px-0">
        <!-- Header -->
        <div class="text-center">
            <h1 class="text-2xl font-semibold text-slate-900">Complete Your Profile</h1>
            <p class="mt-2 text-sm text-slate-600">Fill in your details to get started with your job search</p>
        </div>

        <!-- Progress Bar -->
        <div class="rounded-[28px] border border-slate-200 bg-white px-6 py-5">
            <div class="flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center">
                        <div class="flex w-full items-center">
                            <div class="step-indicator flex w-full items-center" data-step="1">
                                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-slate-900 bg-slate-900 text-white step-circle">
                                    <span class="step-number">1</span>
                                    <svg class="step-check hidden h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div class="flex-1 border-t-2 border-slate-200 step-line"></div>
                            </div>
                            <div class="step-indicator flex w-full items-center" data-step="2">
                                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-slate-300 bg-white text-slate-400 step-circle">
                                    <span class="step-number">2</span>
                                    <svg class="step-check hidden h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div class="flex-1 border-t-2 border-slate-200 step-line"></div>
                            </div>
                            <div class="step-indicator flex w-full items-center" data-step="3">
                                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-slate-300 bg-white text-slate-400 step-circle">
                                    <span class="step-number">3</span>
                                    <svg class="step-check hidden h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div class="flex-1 border-t-2 border-slate-200 step-line"></div>
                            </div>
                            <div class="step-indicator flex w-full items-center" data-step="4">
                                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-slate-300 bg-white text-slate-400 step-circle">
                                    <span class="step-number">4</span>
                                    <svg class="step-check hidden h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                                <div class="flex-1 border-t-2 border-slate-200 step-line"></div>
                            </div>
                            <div class="step-indicator flex items-center" data-step="5">
                                <div class="flex h-10 w-10 flex-shrink-0 items-center justify-center rounded-full border-2 border-slate-300 bg-white text-slate-400 step-circle">
                                    <span class="step-number">5</span>
                                    <svg class="step-check hidden h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3 flex items-center justify-between px-1">
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-700 step-label" data-step="1">Basic</span>
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 step-label" data-step="2">Location</span>
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 step-label" data-step="3">Experience</span>
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 step-label" data-step="4">Education</span>
                        <span class="text-xs font-semibold uppercase tracking-wider text-slate-400 step-label" data-step="5">Resume</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Steps -->
        <div class="rounded-[28px] border border-slate-200 bg-white px-6 py-8 sm:px-8">
            <!-- Step 1: Basic Details -->
            <div class="form-step" data-step="1">
                <h2 class="mb-6 text-xl font-semibold text-slate-900">Basic Details</h2>
                <form id="basicDetailsForm" class="space-y-4">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="first_name" class="mb-1 block text-sm font-semibold text-slate-700">First Name <span class="text-rose-500">*</span></label>
                            <input type="text" id="first_name" name="first_name" value="{{ optional($candidate->profile)->first_name }}" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                        <div>
                            <label for="last_name" class="mb-1 block text-sm font-semibold text-slate-700">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="{{ optional($candidate->profile)->last_name }}"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="date_of_birth" class="mb-1 block text-sm font-semibold text-slate-700">Date of Birth <span class="text-rose-500">*</span></label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ optional($candidate->profile)->date_of_birth?->format('Y-m-d') }}" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
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
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="phone" class="mb-1 block text-sm font-semibold text-slate-700">Phone <span class="text-rose-500">*</span></label>
                            <input type="tel" id="phone" name="phone" value="{{ optional($candidate->profile)->phone ?? $candidate->user->phone }}" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                        <div>
                            <label for="alternate_phone" class="mb-1 block text-sm font-semibold text-slate-700">Alternate Phone</label>
                            <input type="tel" id="alternate_phone" name="alternate_phone" value="{{ optional($candidate->profile)->alternate_phone }}"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                    </div>
                    <div>
                        <label for="headline" class="mb-1 block text-sm font-semibold text-slate-700">Professional Headline</label>
                        <input type="text" id="headline" name="headline" value="{{ optional($candidate->profile)->headline }}" placeholder="e.g., Senior PHP Developer"
                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                    </div>
                </form>
            </div>

            <!-- Step 2: Location -->
            <div class="form-step hidden" data-step="2">
                <h2 class="mb-6 text-xl font-semibold text-slate-900">Location</h2>
                <form id="locationForm" class="space-y-4">
                    @csrf
                    <div>
                        <label for="city_id" class="mb-1 block text-sm font-semibold text-slate-700">Select Your City <span class="text-rose-500">*</span></label>
                        <select id="city_id" name="city_id" required
                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}" {{ $candidate->city_id == $city->id ? 'selected' : '' }}>
                                    {{ $city->name }}{{ optional($city->state)->name ? ', ' . $city->state->name : '' }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-slate-500">This helps us show you relevant job opportunities in your area</p>
                    </div>
                </form>
            </div>

            <!-- Step 3: Experience -->
            <div class="form-step hidden" data-step="3">
                <h2 class="mb-6 text-xl font-semibold text-slate-900">Work Experience</h2>
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
                <h2 class="mb-6 text-xl font-semibold text-slate-900">Education</h2>
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
                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Degree/Qualification <span class="text-rose-500">*</span></label>
                                        <input type="text" name="education[{{ $index }}][degree]" value="{{ $edu->degree }}" required
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Institution <span class="text-rose-500">*</span></label>
                                        <input type="text" name="education[{{ $index }}][institution]" value="{{ $edu->institution }}" required
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
                                <div class="grid gap-4 sm:grid-cols-2">
                                    <div>
                                        <label class="mb-1 block text-sm font-semibold text-slate-700">Degree/Qualification <span class="text-rose-500">*</span></label>
                                        <input type="text" name="education[0][degree]" required
                                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    </div>
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
                <h2 class="mb-6 text-xl font-semibold text-slate-900">Upload Resume</h2>
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
                    <p class="text-xs text-slate-500">Your resume helps recruiters understand your skills and experience better.</p>
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
                <div id="skipBtn"
                    class="text-xs text-slate-500 hover:text-slate-700 cursor-pointer">
                    Skip for now
                </div>
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

    <script>
        let currentStep = 1;
        const totalSteps = 5;

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

        // Next button
        document.getElementById('nextBtn').addEventListener('click', async function() {
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

        // Skip button
        document.getElementById('skipBtn').addEventListener('click', function() {
            if (currentStep < totalSteps) {
                showStep(currentStep + 1);
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
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Degree/Qualification <span class="text-rose-500">*</span></label>
                            <input type="text" name="education[${count}][degree]" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Institution <span class="text-rose-500">*</span></label>
                            <input type="text" name="education[${count}][institution]" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1 block text-sm font-semibold text-slate-700">Passing Year <span class="text-rose-500">*</span></label>
                            <input type="number" name="education[${count}][passing_year]" min="1950" max="{{ date('Y') + 10 }}" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
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
