@extends('website.layouts.app')

@section('title', 'Candidate profile · SMTJobs')

@section('content')
    <div class="mx-auto w-full max-w-5xl space-y-2 px-4 sm:px-0">
        <section class="relative rounded-[28px] border border-slate-200 bg-white">
            <div class="grid  px-2 py-2 lg:grid-cols-[0.7fr_3.3fr]">
                <div class="flex items-center justify-start">
                    <div class="relative h-36 w-36 overflow-hidden rounded-[26px] border border-slate-200 bg-slate-100 p-1 group">
                        @if(optional($candidate->profile)->profile_photo)
                            <img src="{{ $candidate->profile->profile_photo_url }}" alt="Profile photo" class="h-full w-full rounded-[22px] object-cover" id="profilePhotoPreview" />
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($candidate->user->name ?? 'User') }}&size=400&background=e7e7e7&color=475569" alt="Profile photo" class="h-full w-full rounded-[22px] object-cover" id="profilePhotoPreview" />
                        @endif
                        <div class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-[22px]">
                            <label for="profilePhotoInput" class="cursor-pointer">
                                <div class="flex flex-col items-center gap-1 text-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-xs font-semibold">
                                        @if(optional($candidate->profile)->profile_photo)
                                            Change
                                        @else
                                            Upload
                                        @endif
                                    </span>
                                </div>
                            </label>
                            <input type="file" id="profilePhotoInput" accept="image/*" class="hidden">
                        </div>
                    </div>
                </div>
                <div class="space-y-1">
                    <div>
                        <h1 class="text-xl font-semibold text-slate-900">
                            {{ optional($candidate->profile)->first_name ?? $candidate->user->name ?? 'Candidate' }}
                            {{ optional($candidate->profile)->last_name }}
                        </h1>
                        <p class="text-xs uppercase tracking-[0.5em] text-slate-400">{{ optional($candidate->profile)->headline ?? 'Professional' }}</p>
                    </div>
                    <div class="flex flex-wrap gap-5 text-sm text-slate-600">
                        <div>
                            <p class="text-[0.6rem] uppercase tracking-[0.4em] text-slate-400">Email</p>
                            <p class="font-semibold text-slate-900">{{ $candidate->user->email ?? 'Not provided' }}</p>
                        </div>
                        <div>
                            <p class="text-[0.6rem] uppercase tracking-[0.4em] text-slate-400">Phone</p>
                            <p class="font-semibold text-slate-900">{{ optional($candidate->profile)->phone ?? $candidate->user->phone ?? 'Not provided' }}</p>
                        </div>
                    </div>
                    <div class="grid gap-4 text-sm text-slate-700 sm:grid-cols-3">
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                            <p class="text-[0.6rem] uppercase tracking-[0.4em] text-slate-400">Date of birth</p>
                            <p class="font-semibold text-slate-900">
                                {{ optional($candidate->profile)->date_of_birth ? $candidate->profile->date_of_birth->format('d M Y') : 'Not provided' }}
                            </p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                            <p class="text-[0.6rem] uppercase tracking-[0.4em] text-slate-400">Gender</p>
                            <p class="font-semibold text-slate-900">{{ ucfirst(optional($candidate->profile)->gender ?? $candidate->user->gender ?? 'Not specified') }}</p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                            <p class="text-[0.6rem] uppercase tracking-[0.4em] text-slate-400">Location</p>
                            <p class="font-semibold text-slate-900">
                                {{ optional($candidate->city)->name ?? 'Not provided' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <button
                type="button"
                id="editBasicProfileBtn"
                class="absolute right-6 top-4 inline-flex items-center gap-2 rounded-full border border-slate-900 bg-slate-900 px-4 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-white transition hover:bg-slate-800"
                aria-label="Edit profile"
            >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 17.25V21h3.75L17.81 10.94l-3.75-3.75L4 17.25z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20.71 7.04a1.004 1.004 0 0 0 0-1.42l-2.34-2.34a1.004 1.004 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z" />
                </svg>
                Edit
            </button>
        </section>
        <section class="rounded-[28px] border border-slate-200 bg-white px-5 py-5 sm:px-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <p class="text-[0.6rem] uppercase tracking-[0.4em] text-slate-400">Profile completion</p>
                    <h2 class="text-xl font-semibold text-slate-900">Keep your profile sharp</h2>
                </div>
                <span class="inline-flex items-center justify-center rounded-full bg-slate-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">{{ $profileCompletion['percentage'] }}%</span>
            </div>
            <div class="mt-4 space-y-3">
                <div class="h-2 w-full rounded-full bg-slate-100">
                    <div class="h-full rounded-full bg-gradient-to-r from-emerald-500 to-slate-800" style="width: {{ $profileCompletion['percentage'] }}%;"></div>
                </div>
                <div class="grid gap-3 text-xs font-semibold uppercase tracking-[0.3em] text-slate-400 sm:grid-cols-3">
                    <span class="flex items-center gap-1">
                        <span class="h-2 w-2 rounded-full {{ $candidate->education && $candidate->education->count() > 0 ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                        Education
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="h-2 w-2 rounded-full {{ $candidate->experiences && $candidate->experiences->count() > 0 ? 'bg-amber-500' : 'bg-slate-300' }}"></span>
                        Experience
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="h-2 w-2 rounded-full {{ $candidate->skills && $candidate->skills->count() > 0 ? 'bg-emerald-500' : 'bg-slate-300' }}"></span>
                        Skills
                    </span>
                </div>
            </div>
            <div class="mt-4 grid gap-3 text-sm text-slate-600 sm:grid-cols-3">
                <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                    <p class="text-[0.6rem] uppercase tracking-[0.3em] text-slate-400">Completed</p>
                    <p class="text-base font-semibold text-slate-900">{{ $profileCompletion['completed'] }} / {{ $profileCompletion['total'] }}</p>
                </div>
                <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                    <p class="text-[0.6rem] uppercase tracking-[0.3em] text-slate-400">Next step</p>
                    <p class="text-base font-semibold text-slate-900">
                        @if($profileCompletion['percentage'] == 100)
                            Complete!
                        @elseif(!$candidate->profile || !$candidate->profile->first_name)
                            Complete profile
                        @elseif(!$candidate->education || $candidate->education->count() == 0)
                            Add education
                        @elseif(!$candidate->experiences || $candidate->experiences->count() == 0)
                            Add experience
                        @elseif(!$candidate->skills || $candidate->skills->count() == 0)
                            Add skills
                        @else
                            Add more details
                        @endif
                    </p>
                </div>
                <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                    <p class="text-[0.6rem] uppercase tracking-[0.3em] text-slate-400">Last updated</p>
                    <p class="text-base font-semibold text-slate-900">
                        {{ optional($candidate->profile)->updated_at ? $candidate->profile->updated_at->diffForHumans() : 'Never' }}
                    </p>
                </div>
            </div>
                
        </section>
        <section class="mt-2">

            <div class="mt-2 flex flex-col gap-3 rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-900">
                            @if(optional($candidate->profile)->resume_path)
                                Resume uploaded
                            @else
                                Upload your resume
                            @endif
                        </p>
                        <p class="text-sm text-slate-600">
                            @if(optional($candidate->profile)->resume_path)
                                {{ basename($candidate->profile->resume_path) }}
                            @else
                                Share a PDF so recruiters get a quick snapshot of everything in one place.
                            @endif
                        </p>
                    </div>
                    <button type="button" class="inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-slate-700 transition hover:border-slate-400 hover:text-slate-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v12m0 0l-3-3m3 3l3-3" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z" />
                        </svg>
                        {{ optional($candidate->profile)->resume_path ? 'Re-upload' : 'Upload' }}
                    </button>
                </div>
        </section>
     
        <section class="mt-2 rounded-[28px] border border-slate-200 bg-white p-4 shadow-sm">
            <div class="space-y-4">
                <div class="flex items-center justify-between gap-2">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Education</h3>
                    </div>
                    <div class="flex flex-1 items-center justify-end gap-2">
                        <button
                            type="button"
                            id="addEducationBtn"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-900 bg-slate-900 px-3 py-1 text-[0.65rem] font-semibold tracking-[0.3em] text-white transition hover:bg-slate-800"
                        >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                            </svg>
                            Add
                        </button>
                       
                    </div>
                </div>
                <div class="space-y-3" id="educationList">
                    @forelse($candidate->education ?? [] as $education)
                        <article class="rounded-2xl border border-slate-100 bg-slate-50 p-4" data-education-id="{{ $education->id }}">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.4em] text-slate-400">
                                        {{ $education->passing_year ? $education->passing_year : 'Year not specified' }}
                                        @if($education->is_current)
                                            <span class="ml-2 text-emerald-600">• Current</span>
                                        @endif
                                    </p>
                                    <p class="text-base font-semibold text-slate-900">
                                        {{ $education->degree?->label ?? 'Degree not specified' }}
                                        @if($education->specialization)
                                            <span class="text-slate-600">- {{ $education->specialization->label }}</span>
                                        @endif
                                    </p>
                                    <p class="text-sm text-slate-600">{{ $education->institute_name }}</p>
                                    @if($education->board_university)
                                        <p class="text-xs text-slate-500">{{ $education->board_university }}</p>
                                    @endif
                                    <div class="flex gap-3 text-xs text-slate-500 mt-1">
                                        @if($education->percentage)
                                            <span>{{ $education->percentage }}%</span>
                                        @endif
                                        @if($education->cgpa)
                                            <span>CGPA: {{ $education->cgpa }}{{ $education->cgpa_scale ? '/' . $education->cgpa_scale : '' }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button class="edit-education-btn inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-100 p-2 text-slate-600 hover:bg-slate-200"
                                        data-id="{{ $education->id }}"
                                        data-level-id="{{ $education->education_level_id }}"
                                        data-degree-id="{{ $education->education_degree_id }}"
                                        data-specialization-id="{{ $education->education_specialization_id }}"
                                        data-institute="{{ $education->institute_name }}"
                                        data-board="{{ $education->board_university }}"
                                        data-year="{{ $education->passing_year }}"
                                        data-percentage="{{ $education->percentage }}"
                                        data-cgpa="{{ $education->cgpa }}"
                                        data-cgpa-scale="{{ $education->cgpa_scale }}"
                                        data-is-current="{{ $education->is_current ? '1' : '0' }}"
                                        aria-label="Edit education">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 17.25V21h3.75L17.81 10.94l-3.75-3.75L4 17.25z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.71 7.04a1.004 1.004 0 0 0 0-1.42l-2.34-2.34a1.004 1.004 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/>
                                        </svg>
                                    </button>
                                    <button class="delete-education-btn inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-100 p-2 text-rose-600 hover:bg-rose-50"
                                        data-id="{{ $education->id }}"
                                        aria-label="Delete education">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 6V4h8v2" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 11v6" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 11v6" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 6l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-6 text-center">
                            <p class="text-sm text-slate-500">No education added yet. Click the Add button to add your education details.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
        <section class="mt-2 rounded-[28px] border border-slate-200 bg-white p-4 shadow-sm">
            <div class="space-y-4">
                <div class="flex items-center justify-between gap-2">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Experience</h3>
                    </div>
                    <div class="flex flex-1 items-center justify-end gap-2">
                        <button
                            type="button"
                            id="addExperienceBtn"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-900 bg-slate-900 px-3 py-1 text-[0.65rem] font-semibold tracking-[0.3em] text-white transition hover:bg-slate-800"
                        >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                            </svg>
                            Add
                        </button>
                    </div>
                </div>
                <div class="space-y-3" id="experienceList">
                    @forelse($candidate->experiences ?? [] as $experience)
                        <article class="rounded-2xl border border-slate-100 bg-slate-50 p-4" data-experience-id="{{ $experience->id }}">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="text-xs uppercase tracking-[0.4em] text-slate-400">
                                        {{ $experience->start_date->format('Y') }} – {{ $experience->is_current ? 'Present' : ($experience->end_date ? $experience->end_date->format('Y') : 'N/A') }}
                                    </p>
                                    <p class="text-base font-semibold text-slate-900">{{ $experience->designation }}</p>
                                    <p class="text-sm text-slate-600">{{ $experience->company_name }}</p>
                                    @if($experience->is_current)
                                        <span class="mt-1 inline-flex items-center rounded-full bg-emerald-50 px-2 py-0.5 text-xs font-semibold text-emerald-700">Currently working</span>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2">
                                    <button class="edit-experience-btn inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-100 p-2 text-slate-600 hover:bg-slate-200"
                                        data-id="{{ $experience->id }}"
                                        data-company="{{ $experience->company_name }}"
                                        data-designation="{{ $experience->designation }}"
                                        data-start="{{ $experience->start_date->format('Y-m-d') }}"
                                        data-end="{{ $experience->end_date ? $experience->end_date->format('Y-m-d') : '' }}"
                                        data-current="{{ $experience->is_current ? '1' : '0' }}"
                                        aria-label="Edit experience">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 17.25V21h3.75L17.81 10.94l-3.75-3.75L4 17.25z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.71 7.04a1.004 1.004 0 0 0 0-1.42l-2.34-2.34a1.004 1.004 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/>
                                        </svg>
                                    </button>
                                    <button class="delete-experience-btn inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-100 p-2 text-rose-600 hover:bg-rose-50"
                                        data-id="{{ $experience->id }}"
                                        aria-label="Delete experience">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 6h18" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 6V4h8v2" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 11v6" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 11v6" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 6l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2l1-12" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-6 text-center">
                            <p class="text-sm text-slate-500">No experience added yet. Click the Add button to add your work experience.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Skills Section -->
        <section class="mt-2 rounded-[28px] border border-slate-200 bg-white p-4 shadow-sm">
            <div class="space-y-4">
                <div class="flex items-center justify-between gap-2">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Skills</h3>
                    </div>
                    <div class="flex flex-1 items-center justify-end gap-2">
                        <button
                            type="button"
                            id="addSkillBtn"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-900 bg-slate-900 px-3 py-1 text-[0.65rem] font-semibold tracking-[0.3em] text-white transition hover:bg-slate-800"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                            </svg>
                            Add
                        </button>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2" id="skillsList">
                    @forelse($candidate->skills ?? [] as $candidateSkill)
                        <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-4 py-2" data-skill-id="{{ $candidateSkill->id }}">
                            <span class="text-sm font-medium text-slate-900">{{ $candidateSkill->skill->label }}</span>
                            @if($candidateSkill->experience_years > 0)
                                <span class="text-xs text-slate-500">• {{ $candidateSkill->experience_years }} {{ $candidateSkill->experience_years == 1 ? 'yr' : 'yrs' }}</span>
                            @endif
                            <div class="flex items-center gap-1 ml-2">
                                <button class="edit-skill-btn inline-flex items-center justify-center rounded-full bg-slate-200 p-1 text-slate-600 hover:bg-slate-300"
                                    data-id="{{ $candidateSkill->id }}"
                                    data-skill-id="{{ $candidateSkill->skill_id }}"
                                    data-experience-years="{{ $candidateSkill->experience_years }}"
                                    aria-label="Edit skill">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 17.25V21h3.75L17.81 10.94l-3.75-3.75L4 17.25z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.71 7.04a1.004 1.004 0 0 0 0-1.42l-2.34-2.34a1.004 1.004 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/>
                                    </svg>
                                </button>
                                <button class="delete-skill-btn inline-flex items-center justify-center rounded-full bg-rose-100 p-1 text-rose-600 hover:bg-rose-200"
                                    data-id="{{ $candidateSkill->id }}"
                                    aria-label="Delete skill">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="w-full rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-6 text-center">
                            <p class="text-sm text-slate-500">No skills added yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        <!-- Languages Section -->
        <section class="mt-2 rounded-[28px] border border-slate-200 bg-white p-4 shadow-sm">
            <div class="space-y-4">
                <div class="flex items-center justify-between gap-2">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Languages</h3>
                    </div>
                    <div class="flex flex-1 items-center justify-end gap-2">
                        <button
                            type="button"
                            id="addLanguageBtn"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-900 bg-slate-900 px-3 py-1 text-[0.65rem] font-semibold tracking-[0.3em] text-white transition hover:bg-slate-800"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                            </svg>
                            Add
                        </button>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2" id="languagesList">
                    @forelse($candidate->languages ?? [] as $candidateLanguage)
                        <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-4 py-2" data-language-id="{{ $candidateLanguage->id }}">
                            <span class="text-sm font-medium text-slate-900">{{ $candidateLanguage->language->name }}</span>
                            @if($candidateLanguage->proficiency)
                                <span class="text-xs text-slate-500">• {{ $candidateLanguage->proficiency }}</span>
                            @endif
                            <div class="flex items-center gap-1 ml-2">
                                <button class="edit-language-btn inline-flex items-center justify-center rounded-full bg-slate-200 p-1 text-slate-600 hover:bg-slate-300"
                                    data-id="{{ $candidateLanguage->id }}"
                                    data-language-id="{{ $candidateLanguage->language_id }}"
                                    data-proficiency="{{ $candidateLanguage->proficiency }}"
                                    aria-label="Edit language">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 17.25V21h3.75L17.81 10.94l-3.75-3.75L4 17.25z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.71 7.04a1.004 1.004 0 0 0 0-1.42l-2.34-2.34a1.004 1.004 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/>
                                    </svg>
                                </button>
                                <button class="delete-language-btn inline-flex items-center justify-center rounded-full bg-rose-100 p-1 text-rose-600 hover:bg-rose-200"
                                    data-id="{{ $candidateLanguage->id }}"
                                    aria-label="Delete language">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="w-full rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-6 text-center">
                            <p class="text-sm text-slate-500">No languages added yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Certifications Section --}}
        <section class="rounded-[28px] border border-slate-200 bg-white p-4 shadow-sm">
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Certifications</h3>
                    </div>
                    <div class="flex flex-1 items-center justify-end gap-2">
                        <button
                            type="button"
                            id="addCertificationBtn"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-900 bg-slate-900 px-3 py-1 text-[0.65rem] font-semibold tracking-[0.3em] text-white transition hover:bg-slate-800"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                            </svg>
                            Add
                        </button>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2" id="certificationsList">
                    @forelse($candidate->certifications ?? [] as $candidateCertification)
                        <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-4 py-2" data-certification-id="{{ $candidateCertification->id }}">
                            <span class="text-sm font-medium text-slate-900">{{ $candidateCertification->certificate->label }}</span>
                            @if($candidateCertification->issued_at || $candidateCertification->expires_at)
                                <span class="text-xs text-slate-500">
                                    @if($candidateCertification->issued_at)
                                        • {{ \Carbon\Carbon::parse($candidateCertification->issued_at)->format('M Y') }}
                                    @endif
                                    @if($candidateCertification->expires_at)
                                        - {{ \Carbon\Carbon::parse($candidateCertification->expires_at)->format('M Y') }}
                                    @endif
                                </span>
                            @endif
                            <div class="flex items-center gap-1 ml-2">
                                <button class="edit-certification-btn inline-flex items-center justify-center rounded-full bg-slate-200 p-1 text-slate-600 hover:bg-slate-300"
                                    data-id="{{ $candidateCertification->id }}"
                                    data-certificate-id="{{ $candidateCertification->certificate_id }}"
                                    data-issued-at="{{ $candidateCertification->issued_at }}"
                                    data-expires-at="{{ $candidateCertification->expires_at }}"
                                    aria-label="Edit certification">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 17.25V21h3.75L17.81 10.94l-3.75-3.75L4 17.25z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.71 7.04a1.004 1.004 0 0 0 0-1.42l-2.34-2.34a1.004 1.004 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/>
                                    </svg>
                                </button>
                                <button class="delete-certification-btn inline-flex items-center justify-center rounded-full bg-rose-100 p-1 text-rose-600 hover:bg-rose-200"
                                    data-id="{{ $candidateCertification->id }}"
                                    aria-label="Delete certification">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="w-full rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-6 text-center">
                            <p class="text-sm text-slate-500">No certifications added yet.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
      
    </div>

    <!-- Education Modal -->
    <div id="educationModal" class="fixed inset-0 z-50 hidden" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-[28px] border border-slate-200 bg-white p-6 shadow-xl">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-xl font-semibold text-slate-900" id="educationModalTitle">Add Education</h3>
                <button type="button" class="close-modal text-slate-400 hover:text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="educationForm">
                @csrf
                <input type="hidden" id="education_id" name="id">
                <div class="space-y-4">
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="education_level_id" class="mb-1 block text-sm font-semibold text-slate-700">Education Level <span class="text-rose-500">*</span></label>
                            <select id="education_level_id" name="education_level_id" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                <option value="">Select Education Level</option>
                                @foreach($educationLevels as $level)
                                    <option value="{{ $level->id }}">{{ $level->label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="education_degree_id" class="mb-1 block text-sm font-semibold text-slate-700">Degree <span class="text-rose-500">*</span></label>
                            <select id="education_degree_id" name="education_degree_id" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                <option value="">Select Degree First</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="education_specialization_id" class="mb-1 block text-sm font-semibold text-slate-700">Specialization</label>
                        <select id="education_specialization_id" name="education_specialization_id"
                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                            <option value="">Select Specialization (Optional)</option>
                        </select>
                    </div>
                    <div>
                        <label for="institute_name" class="mb-1 block text-sm font-semibold text-slate-700">Institute Name <span class="text-rose-500">*</span></label>
                        <input type="text" id="institute_name" name="institute_name" required
                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                    </div>
                    <div>
                        <label for="board_university" class="mb-1 block text-sm font-semibold text-slate-700">Board/University</label>
                        <input type="text" id="board_university" name="board_university"
                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="passing_year" class="mb-1 block text-sm font-semibold text-slate-700">Passing Year <span class="text-rose-500">*</span></label>
                            <input type="number" id="passing_year" name="passing_year" min="1950" max="{{ date('Y') + 10 }}" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                        <div>
                            <label for="percentage" class="mb-1 block text-sm font-semibold text-slate-700">Percentage</label>
                            <input type="number" id="percentage" name="percentage" min="0" max="100" step="0.01"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="cgpa" class="mb-1 block text-sm font-semibold text-slate-700">CGPA</label>
                            <input type="number" id="cgpa" name="cgpa" min="0" max="10" step="0.01"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                        <div>
                            <label for="cgpa_scale" class="mb-1 block text-sm font-semibold text-slate-700">CGPA Scale</label>
                            <input type="number" id="cgpa_scale" name="cgpa_scale" min="0" max="10" step="0.01"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="education_is_current" name="is_current" value="1"
                            class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-2 focus:ring-slate-200">
                        <label for="education_is_current" class="ml-2 text-sm text-slate-700">Currently Pursuing</label>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-3">
                    <button type="button" class="close-modal rounded-full border border-slate-300 bg-white px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-slate-700 transition hover:border-slate-400">
                        Cancel
                    </button>
                    <button type="submit" class="rounded-full border border-slate-900 bg-slate-900 px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-white transition hover:bg-slate-800">
                        Save
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Experience Modal -->
    <div id="experienceModal" class="fixed inset-0 z-50 hidden" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-[28px] border border-slate-200 bg-white p-6 shadow-xl">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-xl font-semibold text-slate-900" id="experienceModalTitle">Add Experience</h3>
                <button type="button" class="close-modal text-slate-400 hover:text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="experienceForm">
                @csrf
                <input type="hidden" id="experience_id" name="id">
                <div class="space-y-4">
                    <div>
                        <label for="company_name" class="mb-1 block text-sm font-semibold text-slate-700">Company Name <span class="text-rose-500">*</span></label>
                        <input type="text" id="company_name" name="company_name" required
                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                    </div>
                    <div>
                        <label for="designation" class="mb-1 block text-sm font-semibold text-slate-700">Designation <span class="text-rose-500">*</span></label>
                        <input type="text" id="designation" name="designation" required
                            class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="start_date" class="mb-1 block text-sm font-semibold text-slate-700">Start Date <span class="text-rose-500">*</span></label>
                            <input type="date" id="start_date" name="start_date" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                        <div id="endDateContainer">
                            <label for="end_date" class="mb-1 block text-sm font-semibold text-slate-700">End Date</label>
                            <input type="date" id="end_date" name="end_date"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" id="experience_is_current" name="is_current" value="1"
                                class="mr-2 h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-2 focus:ring-slate-200">
                            <span class="text-sm text-slate-700">I currently work here</span>
                        </label>
                    </div>
                </div>
                <div class="mt-6 flex items-center justify-end gap-3">
                    <button type="button" class="close-modal rounded-full border border-slate-300 bg-white px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-slate-700 transition hover:border-slate-400">
                        Cancel
                    </button>
                    <button type="submit" class="rounded-full border border-slate-900 bg-slate-900 px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-white transition hover:bg-slate-800">
                        Save
                    </button>
                </div>
            </form>
            </div>
        </div>
    </div>

    <!-- Skill Modal -->
    <div id="skillModal" class="fixed inset-0 z-50 hidden" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-[28px] border border-slate-200 bg-white p-6 shadow-xl">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-slate-900" id="skillModalTitle">Add Skill</h3>
                    <button type="button" class="close-modal text-slate-400 hover:text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="skillForm">
                    @csrf
                    <input type="hidden" id="skill_item_id" name="id">
                    <div class="space-y-4">
                        <div>
                            <label for="skill_id" class="mb-1 block text-sm font-semibold text-slate-700">Skill <span class="text-rose-500">*</span></label>
                            <select id="skill_id" name="skill_id" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                <option value="">Select Skill</option>
                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="skill_experience_years" class="mb-1 block text-sm font-semibold text-slate-700">Years of Experience</label>
                            <input type="number" id="skill_experience_years" name="experience_years" min="0" max="50"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200"
                                placeholder="Optional">
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-3">
                        <button type="button" class="close-modal rounded-full border border-slate-300 bg-white px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-slate-700 transition hover:border-slate-400">
                            Cancel
                        </button>
                        <button type="submit" class="rounded-full border border-slate-900 bg-slate-900 px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-white transition hover:bg-slate-800">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Language Modal -->
    <div id="languageModal" class="fixed inset-0 z-50 hidden" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-[28px] border border-slate-200 bg-white p-6 shadow-xl">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-slate-900" id="languageModalTitle">Add Language</h3>
                    <button type="button" class="close-modal text-slate-400 hover:text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="languageForm">
                    @csrf
                    <input type="hidden" id="language_item_id" name="id">
                    <div class="space-y-4">
                        <div>
                            <label for="language_id" class="mb-1 block text-sm font-semibold text-slate-700">Language <span class="text-rose-500">*</span></label>
                            <select id="language_id" name="language_id" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                <option value="">Select Language</option>
                                @foreach($languages as $language)
                                    <option value="{{ $language->id }}">{{ $language->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="language_proficiency" class="mb-1 block text-sm font-semibold text-slate-700">Proficiency Level</label>
                            <select id="language_proficiency" name="proficiency"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                <option value="">Select Proficiency (Optional)</option>
                                <option value="Beginner">Beginner</option>
                                <option value="Elementary">Elementary</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Advanced">Advanced</option>
                                <option value="Fluent">Fluent</option>
                                <option value="Native">Native</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-3">
                        <button type="button" class="close-modal rounded-full border border-slate-300 bg-white px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-slate-700 transition hover:border-slate-400">
                            Cancel
                        </button>
                        <button type="submit" class="rounded-full border border-slate-900 bg-slate-900 px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-white transition hover:bg-slate-800">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Certification Modal -->
    <div id="certificationModal" class="fixed inset-0 z-50 hidden" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-[28px] border border-slate-200 bg-white p-6 shadow-xl">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-slate-900" id="certificationModalTitle">Add Certification</h3>
                    <button type="button" class="close-modal text-slate-400 hover:text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="certificationForm">
                    @csrf
                    <input type="hidden" id="certification_item_id" name="id">
                    <div class="space-y-4">
                        <div>
                            <label for="certificate_id" class="mb-1 block text-sm font-semibold text-slate-700">Certification <span class="text-rose-500">*</span></label>
                            <select id="certificate_id" name="certificate_id" required
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                <option value="">Select Certification</option>
                                @foreach($certificates as $certificate)
                                    <option value="{{ $certificate->id }}">{{ $certificate->label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="issued_at" class="mb-1 block text-sm font-semibold text-slate-700">Issue Date</label>
                            <input type="date" id="issued_at" name="issued_at"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                        <div>
                            <label for="expires_at" class="mb-1 block text-sm font-semibold text-slate-700">Expiration Date</label>
                            <input type="date" id="expires_at" name="expires_at"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-3">
                        <button type="button" class="close-modal rounded-full border border-slate-300 bg-white px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-slate-700 transition hover:border-slate-400">
                            Cancel
                        </button>
                        <button type="submit" class="rounded-full border border-slate-900 bg-slate-900 px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-white transition hover:bg-slate-800">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Basic Profile Edit Modal -->
    <div id="basicProfileModal" class="fixed inset-0 z-50 hidden" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="w-full max-w-lg max-h-[90vh] overflow-y-auto rounded-[28px] border border-slate-200 bg-white p-6 shadow-xl">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-slate-900">Edit Basic Details</h3>
                    <button type="button" class="close-modal text-slate-400 hover:text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <form id="basicProfileForm">
                    @csrf
                    <div class="space-y-4">
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="first_name" class="mb-1 block text-sm font-semibold text-slate-700">First Name <span class="text-rose-500">*</span></label>
                                <input type="text" id="first_name" name="first_name" required
                                    value="{{ optional($candidate->profile)->first_name }}"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                            </div>
                            <div>
                                <label for="last_name" class="mb-1 block text-sm font-semibold text-slate-700">Last Name</label>
                                <input type="text" id="last_name" name="last_name"
                                    value="{{ optional($candidate->profile)->last_name }}"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                            </div>
                        </div>
                        <div>
                            <label for="headline" class="mb-1 block text-sm font-semibold text-slate-700">Headline</label>
                            <input type="text" id="headline" name="headline"
                                value="{{ optional($candidate->profile)->headline }}"
                                placeholder="e.g., Senior Software Engineer"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                        <div>
                            <label for="phone" class="mb-1 block text-sm font-semibold text-slate-700">Phone</label>
                            <input type="tel" id="phone" name="phone"
                                value="{{ optional($candidate->profile)->phone ?? $candidate->user->phone }}"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                        </div>
                        <div class="grid gap-4 sm:grid-cols-2">
                            <div>
                                <label for="date_of_birth" class="mb-1 block text-sm font-semibold text-slate-700">Date of Birth</label>
                                <input type="date" id="date_of_birth" name="date_of_birth"
                                    value="{{ optional($candidate->profile)->date_of_birth?->format('Y-m-d') }}"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                            </div>
                            <div>
                                <label for="gender" class="mb-1 block text-sm font-semibold text-slate-700">Gender</label>
                                <select id="gender" name="gender"
                                    class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{ optional($candidate->profile)->gender == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ optional($candidate->profile)->gender == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ optional($candidate->profile)->gender == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="city_id" class="mb-1 block text-sm font-semibold text-slate-700">City</label>
                            <select id="city_id" name="city_id"
                                class="w-full rounded-2xl border border-slate-300 px-4 py-2.5 text-sm text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-200">
                                <option value="">Select City</option>
                                @foreach($cities ?? [] as $city)
                                    <option value="{{ $city->id }}" {{ $candidate->city_id == $city->id ? 'selected' : '' }}>
                                        {{ $city->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-end gap-3">
                        <button type="button" class="close-modal rounded-full border border-slate-300 bg-white px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-slate-700 transition hover:border-slate-400">
                            Cancel
                        </button>
                        <button type="submit" class="rounded-full border border-slate-900 bg-slate-900 px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-white transition hover:bg-slate-800">
                            Save
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Image Crop Modal -->
    <div id="imageCropModal" class="fixed inset-0 z-50 hidden" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="flex min-h-screen items-center justify-center p-4">
            <div class="w-full max-w-2xl rounded-[28px] border border-slate-200 bg-white p-6 shadow-xl">
                <div class="mb-4 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-slate-900">Crop Profile Photo</h3>
                    <button type="button" id="closeCropModal" class="text-slate-400 hover:text-slate-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <div class="space-y-4">
                    <div class="max-h-[60vh] overflow-hidden rounded-2xl border border-slate-200">
                        <img id="imageToCrop" style="max-width: 100%;" />
                    </div>
                    <div class="flex items-center justify-end gap-3">
                        <button type="button" id="cancelCropBtn" class="rounded-full border border-slate-300 bg-white px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-slate-700 transition hover:border-slate-400">
                            Cancel
                        </button>
                        <button type="button" id="cropAndUploadBtn" class="rounded-full border border-slate-900 bg-slate-900 px-6 py-2.5 text-xs font-semibold uppercase tracking-wider text-white transition hover:bg-slate-800">
                            Crop & Upload
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Cropper.js CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" />
    <!-- Cropper.js JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

    <script>
        // Modal functions
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
            modal.style.display = 'block';
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
            modal.style.display = 'none';
            // Reset form
            document.querySelector(`#${modalId} form`).reset();
            // Clear hidden ID fields
            if (modalId === 'educationModal') {
                document.getElementById('education_id').value = '';
                document.getElementById('educationModalTitle').textContent = 'Add Education';
            } else if (modalId === 'experienceModal') {
                document.getElementById('experience_id').value = '';
                document.getElementById('experienceModalTitle').textContent = 'Add Experience';
                document.getElementById('end_date').disabled = false;
            } else if (modalId === 'skillModal') {
                document.getElementById('skill_item_id').value = '';
                document.getElementById('skillModalTitle').textContent = 'Add Skill';
            } else if (modalId === 'languageModal') {
                document.getElementById('language_item_id').value = '';
                document.getElementById('languageModalTitle').textContent = 'Add Language';
            } else if (modalId === 'certificationModal') {
                document.getElementById('certification_item_id').value = '';
                document.getElementById('certificationModalTitle').textContent = 'Add Certification';
            }
        }

        // Close modal when clicking outside
        document.querySelectorAll('.close-modal').forEach(btn => {
            btn.addEventListener('click', function() {
                const modal = this.closest('[id$="Modal"]');
                closeModal(modal.id);
            });
        });

        // Education handlers
        document.getElementById('addEducationBtn').addEventListener('click', function() {
            openModal('educationModal');
        });

        // Cascading dropdown for education level -> degrees
        document.getElementById('education_level_id').addEventListener('change', async function() {
            const levelId = this.value;
            const degreeSelect = document.getElementById('education_degree_id');
            const specializationSelect = document.getElementById('education_specialization_id');
            
            // Reset degree and specialization dropdowns
            degreeSelect.innerHTML = '<option value="">Select Degree</option>';
            specializationSelect.innerHTML = '<option value="">Select Specialization (Optional)</option>';
            
            if (levelId) {
                try {
                    const response = await fetch(`/candidate/education-degrees/${levelId}`);
                    const degrees = await response.json();
                    
                    degrees.forEach(degree => {
                        const option = document.createElement('option');
                        option.value = degree.id;
                        option.textContent = degree.label;
                        degreeSelect.appendChild(option);
                    });
                } catch (error) {
                    console.error('Failed to load degrees:', error);
                }
            }
        });

        // Cascading dropdown for degree -> specializations
        document.getElementById('education_degree_id').addEventListener('change', async function() {
            const degreeId = this.value;
            const specializationSelect = document.getElementById('education_specialization_id');
            
            // Reset specialization dropdown
            specializationSelect.innerHTML = '<option value="">Select Specialization (Optional)</option>';
            
            if (degreeId) {
                try {
                    const response = await fetch(`/candidate/education-specializations/${degreeId}`);
                    const specializations = await response.json();
                    
                    specializations.forEach(specialization => {
                        const option = document.createElement('option');
                        option.value = specialization.id;
                        option.textContent = specialization.label;
                        specializationSelect.appendChild(option);
                    });
                } catch (error) {
                    console.error('Failed to load specializations:', error);
                }
            }
        });

        document.querySelectorAll('.edit-education-btn').forEach(btn => {
            btn.addEventListener('click', async function() {
                document.getElementById('education_id').value = this.dataset.id;
                document.getElementById('education_level_id').value = this.dataset.levelId;
                document.getElementById('passing_year').value = this.dataset.year;
                document.getElementById('percentage').value = this.dataset.percentage;
                document.getElementById('cgpa').value = this.dataset.cgpa;
                document.getElementById('cgpa_scale').value = this.dataset.cgpaScale;
                document.getElementById('institute_name').value = this.dataset.institute;
                document.getElementById('board_university').value = this.dataset.board;
                document.getElementById('education_is_current').checked = this.dataset.isCurrent === '1';
                
                // Load degrees for selected level
                const levelId = this.dataset.levelId;
                if (levelId) {
                    try {
                        const response = await fetch(`/candidate/education-degrees/${levelId}`);
                        const degrees = await response.json();
                        const degreeSelect = document.getElementById('education_degree_id');
                        degreeSelect.innerHTML = '<option value="">Select Degree</option>';
                        
                        degrees.forEach(degree => {
                            const option = document.createElement('option');
                            option.value = degree.id;
                            option.textContent = degree.label;
                            if (degree.id == this.dataset.degreeId) {
                                option.selected = true;
                            }
                            degreeSelect.appendChild(option);
                        });
                    } catch (error) {
                        console.error('Failed to load degrees:', error);
                    }
                }
                
                // Load specializations for selected degree
                const degreeId = this.dataset.degreeId;
                if (degreeId) {
                    try {
                        const response = await fetch(`/candidate/education-specializations/${degreeId}`);
                        const specializations = await response.json();
                        const specializationSelect = document.getElementById('education_specialization_id');
                        specializationSelect.innerHTML = '<option value="">Select Specialization (Optional)</option>';
                        
                        specializations.forEach(specialization => {
                            const option = document.createElement('option');
                            option.value = specialization.id;
                            option.textContent = specialization.label;
                            if (specialization.id == this.dataset.specializationId) {
                                option.selected = true;
                            }
                            specializationSelect.appendChild(option);
                        });
                    } catch (error) {
                        console.error('Failed to load specializations:', error);
                    }
                }
                
                document.getElementById('educationModalTitle').textContent = 'Edit Education';
                openModal('educationModal');
            });
        });

        document.getElementById('educationForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = document.getElementById('education_id').value;
            const url = id ? `/candidate/education/${id}` : '/candidate/education';
            const method = id ? 'PUT' : 'POST';

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });

                if (response.ok) {
                    location.reload();
                } else {
                    alert('Failed to save education');
                }
            } catch (error) {
                alert('An error occurred');
            }
        });

        document.querySelectorAll('.delete-education-btn').forEach(btn => {
            btn.addEventListener('click', async function() {
                if (!confirm('Are you sure you want to delete this education?')) return;

                try {
                    const response = await fetch(`/candidate/education/${this.dataset.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (response.ok) {
                        location.reload();
                    } else {
                        alert('Failed to delete education');
                    }
                } catch (error) {
                    alert('An error occurred');
                }
            });
        });

        // Experience handlers
        document.getElementById('addExperienceBtn').addEventListener('click', function() {
            openModal('experienceModal');
        });

        document.querySelectorAll('.edit-experience-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('experience_id').value = this.dataset.id;
                document.getElementById('company_name').value = this.dataset.company;
                document.getElementById('designation').value = this.dataset.designation;
                document.getElementById('start_date').value = this.dataset.start;
                document.getElementById('end_date').value = this.dataset.end;
                document.getElementById('experience_is_current').checked = this.dataset.current === '1';
                document.getElementById('end_date').disabled = this.dataset.current === '1';
                document.getElementById('experienceModalTitle').textContent = 'Edit Experience';
                openModal('experienceModal');
            });
        });

        // Handle "currently working" checkbox
        document.getElementById('experience_is_current').addEventListener('change', function() {
            document.getElementById('end_date').disabled = this.checked;
            if (this.checked) {
                document.getElementById('end_date').value = '';
            }
        });

        document.getElementById('experienceForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = document.getElementById('experience_id').value;
            const url = id ? `/candidate/experience/${id}` : '/candidate/experience';

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });

                if (response.ok) {
                    location.reload();
                } else {
                    alert('Failed to save experience');
                }
            } catch (error) {
                alert('An error occurred');
            }
        });

        document.querySelectorAll('.delete-experience-btn').forEach(btn => {
            btn.addEventListener('click', async function() {
                if (!confirm('Are you sure you want to delete this experience?')) return;

                try {
                    const response = await fetch(`/candidate/experience/${this.dataset.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (response.ok) {
                        location.reload();
                    } else {
                        alert('Failed to delete experience');
                    }
                } catch (error) {
                    alert('An error occurred');
                }
            });
        });

        // Skill handlers
        document.getElementById('addSkillBtn').addEventListener('click', function() {
            openModal('skillModal');
        });

        document.querySelectorAll('.edit-skill-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('skill_item_id').value = this.dataset.id;
                document.getElementById('skill_id').value = this.dataset.skillId;
                document.getElementById('skill_experience_years').value = this.dataset.experienceYears;
                document.getElementById('skillModalTitle').textContent = 'Edit Skill';
                openModal('skillModal');
            });
        });

        document.getElementById('skillForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = document.getElementById('skill_item_id').value;
            const url = id ? `/candidate/skill/${id}` : '/candidate/skill';

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });

                const result = await response.json();

                if (response.ok) {
                    location.reload();
                } else {
                    alert(result.message || 'Failed to save skill');
                }
            } catch (error) {
                alert('An error occurred');
            }
        });

        document.querySelectorAll('.delete-skill-btn').forEach(btn => {
            btn.addEventListener('click', async function() {
                if (!confirm('Are you sure you want to delete this skill?')) return;

                try {
                    const response = await fetch(`/candidate/skill/${this.dataset.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (response.ok) {
                        location.reload();
                    } else {
                        alert('Failed to delete skill');
                    }
                } catch (error) {
                    alert('An error occurred');
                }
            });
        });

        // Language handlers
        document.getElementById('addLanguageBtn').addEventListener('click', function() {
            openModal('languageModal');
        });

        document.querySelectorAll('.edit-language-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('language_item_id').value = this.dataset.id;
                document.getElementById('language_id').value = this.dataset.languageId;
                document.getElementById('language_proficiency').value = this.dataset.proficiency;
                document.getElementById('languageModalTitle').textContent = 'Edit Language';
                openModal('languageModal');
            });
        });

        document.getElementById('languageForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = document.getElementById('language_item_id').value;
            const url = id ? `/candidate/language/${id}` : '/candidate/language';

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });

                const result = await response.json();

                if (response.ok) {
                    location.reload();
                } else {
                    alert(result.message || 'Failed to save language');
                }
            } catch (error) {
                alert('An error occurred');
            }
        });

        document.querySelectorAll('.delete-language-btn').forEach(btn => {
            btn.addEventListener('click', async function() {
                if (!confirm('Are you sure you want to delete this language?')) return;

                try {
                    const response = await fetch(`/candidate/language/${this.dataset.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (response.ok) {
                        location.reload();
                    } else {
                        alert('Failed to delete language');
                    }
                } catch (error) {
                    alert('An error occurred');
                }
            });
        });

        // Certification handlers
        document.getElementById('addCertificationBtn').addEventListener('click', function() {
            openModal('certificationModal');
        });

        document.querySelectorAll('.edit-certification-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.getElementById('certification_item_id').value = this.dataset.id;
                document.getElementById('certificate_id').value = this.dataset.certificateId;
                document.getElementById('issued_at').value = this.dataset.issuedAt;
                document.getElementById('expires_at').value = this.dataset.expiresAt;
                document.getElementById('certificationModalTitle').textContent = 'Edit Certification';
                openModal('certificationModal');
            });
        });

        document.getElementById('certificationForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const id = document.getElementById('certification_item_id').value;
            const url = id ? `/candidate/certification/${id}` : '/candidate/certification';

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });

                const result = await response.json();

                if (response.ok) {
                    location.reload();
                } else {
                    alert(result.message || 'Failed to save certification');
                }
            } catch (error) {
                alert('An error occurred');
            }
        });

        document.querySelectorAll('.delete-certification-btn').forEach(btn => {
            btn.addEventListener('click', async function() {
                if (!confirm('Are you sure you want to delete this certification?')) return;

                try {
                    const response = await fetch(`/candidate/certification/${this.dataset.id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (response.ok) {
                        location.reload();
                    } else {
                        alert('Failed to delete certification');
                    }
                } catch (error) {
                    alert('An error occurred');
                }
            });
        });

        // Basic Profile Edit handlers
        document.getElementById('editBasicProfileBtn').addEventListener('click', function() {
            openModal('basicProfileModal');
        });

        document.getElementById('basicProfileForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            try {
                const response = await fetch('/candidate/profile/update', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                });

                const result = await response.json();

                if (response.ok) {
                    location.reload();
                } else {
                    alert(result.message || 'Failed to update profile');
                }
            } catch (error) {
                alert('An error occurred');
            }
        });

        // Profile Photo Upload with Cropper
        let cropper = null;
        let selectedFile = null;

        document.getElementById('profilePhotoInput').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (!file) return;

            // Validate file type
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            if (!allowedTypes.includes(file.type)) {
                alert('Invalid file type. Please select a JPEG, PNG, or GIF image.');
                this.value = '';
                return;
            }

            // Validate file size (max 5MB)
            const maxSize = 5 * 1024 * 1024; // 5MB in bytes
            if (file.size > maxSize) {
                const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                alert(`Image size (${fileSizeMB}MB) exceeds the 5MB limit. Please choose a smaller image.`);
                this.value = '';
                return;
            }

            // Validate minimum size (prevent too small images)
            if (file.size < 1024) { // Less than 1KB
                alert('Image file is too small or corrupted. Please select a valid image.');
                this.value = '';
                return;
            }

            selectedFile = file;

            // Show crop modal
            const reader = new FileReader();
            
            reader.onerror = function() {
                alert('Failed to read the image file. Please try a different image.');
                document.getElementById('profilePhotoInput').value = '';
                selectedFile = null;
            };
            
            reader.onload = function(event) {
                try {
                    const imageToCrop = document.getElementById('imageToCrop');
                    imageToCrop.src = event.target.result;

                    // Show modal
                    document.getElementById('imageCropModal').classList.remove('hidden');
                    document.getElementById('imageCropModal').style.display = 'block';

                    // Destroy previous cropper if exists
                    if (cropper) {
                        cropper.destroy();
                    }
                    
                    // Wait for image to load before initializing cropper
                    imageToCrop.onload = function() {
                        try {
                            // Initialize cropper
                            cropper = new Cropper(imageToCrop, {
                                aspectRatio: 1,
                                viewMode: 2,
                                dragMode: 'move',
                                autoCropArea: 1,
                                restore: false,
                                guides: true,
                                center: true,
                                highlight: false,
                                cropBoxMovable: true,
                                cropBoxResizable: true,
                                toggleDragModeOnDblclick: false,
                            });
                        } catch (error) {
                            console.error('Cropper initialization error:', error);
                            alert('Failed to initialize image editor. Please refresh and try again.');
                            closeCropModal();
                        }
                    };
                    
                    imageToCrop.onerror = function() {
                        alert('Failed to load the image. Please try a different image.');
                        closeCropModal();
                    };
                } catch (error) {
                    console.error('Image loading error:', error);
                    alert('Error loading image: ' + error.message);
                    closeCropModal();
                }
            };
            
            reader.readAsDataURL(file);
        });

        // Close crop modal
        document.getElementById('closeCropModal').addEventListener('click', function() {
            closeCropModal();
        });

        document.getElementById('cancelCropBtn').addEventListener('click', function() {
            closeCropModal();
        });

        function closeCropModal() {
            document.getElementById('imageCropModal').classList.add('hidden');
            document.getElementById('imageCropModal').style.display = 'none';
            if (cropper) {
                cropper.destroy();
                cropper = null;
            }
            document.getElementById('profilePhotoInput').value = '';
            selectedFile = null;
        }

        // Crop and upload
        document.getElementById('cropAndUploadBtn').addEventListener('click', async function() {
            if (!cropper) return;

            const uploadButton = this;
            const originalText = uploadButton.textContent;
            
            // Disable button and show loading state
            uploadButton.disabled = true;
            uploadButton.textContent = 'Uploading...';

            try {
                // Get cropped canvas
                const canvas = cropper.getCroppedCanvas({
                    width: 200,
                    height: 200,
                    imageSmoothingEnabled: true,
                    imageSmoothingQuality: 'high',
                });

                // Validate canvas
                if (!canvas) {
                    throw new Error('Failed to process image');
                }

                // Convert canvas to blob
                canvas.toBlob(async function(blob) {
                    if (!blob) {
                        uploadButton.disabled = false;
                        uploadButton.textContent = originalText;
                        alert('Failed to process image. Please try again.');
                        return;
                    }

                    // Validate blob size
                    if (blob.size > 5242880) { // 5MB
                        uploadButton.disabled = false;
                        uploadButton.textContent = originalText;
                        alert('Processed image is too large. Please try a different image.');
                        return;
                    }

                    const formData = new FormData();
                    formData.append('profile_photo', blob, selectedFile.name);

                    try {
                        const response = await fetch('/candidate/profile/upload-photo', {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        });

                        const result = await response.json();

                        if (response.ok && result.success) {
                            // Show success message
                            alert(result.message || 'Profile photo uploaded successfully!');
                            closeCropModal();
                            location.reload();
                        } else {
                            // Handle specific errors
                            uploadButton.disabled = false;
                            uploadButton.textContent = originalText;
                            
                            if (result.errors) {
                                // Validation errors
                                const errorMessages = Object.values(result.errors).flat().join('\n');
                                alert('Validation Error:\n' + errorMessages);
                            } else {
                                alert(result.message || 'Failed to upload photo. Please try again.');
                            }
                        }
                    } catch (error) {
                        uploadButton.disabled = false;
                        uploadButton.textContent = originalText;
                        console.error('Upload error:', error);
                        alert('Network error: Could not connect to server. Please check your internet connection and try again.');
                    }
                }, 'image/jpeg', 0.9);
            } catch (error) {
                uploadButton.disabled = false;
                uploadButton.textContent = originalText;
                console.error('Processing error:', error);
                alert('Error processing image: ' + error.message);
            }
        });
    </script>
@endsection