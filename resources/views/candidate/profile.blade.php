@extends('website.layouts.app')

@section('title', 'Candidate profile · SMTJobs')

@section('content')
    @php
        $profile = [
            'name' => 'Manoj KKB',
            'email' => 'manoj.kkb@gmail.com',
            'phone' => '6261808707',
            'dob' => '1st Jan 1988',
            'gender' => 'Male',
            'location' => 'Indore',
            'photo' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?auto=format&fit=crop&w=400&q=80',
            'cover' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1600&q=80'
        ];
    @endphp

    <div class="mx-auto w-full max-w-5xl space-y-6 px-4 sm:px-0">
        <section class="relative rounded-[28px] border border-slate-200 bg-white">
            <div class="grid  px-2 py-2 lg:grid-cols-[0.7fr_3.3fr]">
                <div class="flex items-center justify-start">
                    <div class="relative h-36 w-36 overflow-hidden rounded-[26px] border border-slate-200 bg-slate-100 p-1">
                        <img src="{{ $profile['photo'] }}" alt="Profile photo" class="h-full w-full rounded-[22px] object-cover" />
                        <span class="absolute bottom-2 left-2 rounded-full border border-white bg-white/90 px-2 py-1 text-[0.6rem] font-semibold uppercase tracking-[0.3em] text-slate-700">Live</span>
                    </div>
                </div>
                <div class="space-y-1">
                    <div>
                        <h1 class="text-xl font-semibold text-slate-900">{{ $profile['name'] }}</h1>
                        <p class="text-xs uppercase tracking-[0.5em] text-slate-400">Php Developer</p>
                    </div>
                    <div class="flex flex-wrap gap-5 text-sm text-slate-600">
                        <div>
                            <p class="text-[0.6rem] uppercase tracking-[0.4em] text-slate-400">Email</p>
                            <p class="font-semibold text-slate-900">{{ $profile['email'] }}</p>
                        </div>
                        <div>
                            <p class="text-[0.6rem] uppercase tracking-[0.4em] text-slate-400">Phone</p>
                            <p class="font-semibold text-slate-900">{{ $profile['phone'] }}</p>
                        </div>
                    </div>
                    <div class="grid gap-4 text-sm text-slate-700 sm:grid-cols-3">
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                            <p class="text-[0.6rem] uppercase tracking-[0.4em] text-slate-400">Date of birth</p>
                            <p class="font-semibold text-slate-900">{{ $profile['dob'] }}</p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                            <p class="text-[0.6rem] uppercase tracking-[0.4em] text-slate-400">Gender</p>
                            <p class="font-semibold text-slate-900">{{ $profile['gender'] }}</p>
                        </div>
                        <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                            <p class="text-[0.6rem] uppercase tracking-[0.4em] text-slate-400">Location</p>
                            <p class="font-semibold text-slate-900">{{ $profile['location'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <button
                type="button"
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
                <span class="inline-flex items-center justify-center rounded-full bg-slate-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">84%</span>
            </div>
            <div class="mt-4 space-y-3">
                <div class="h-2 w-full rounded-full bg-slate-100">
                    <div class="h-full rounded-full bg-gradient-to-r from-emerald-500 to-slate-800" style="width: 84%;"></div>
                </div>
                <div class="grid gap-3 text-xs font-semibold uppercase tracking-[0.3em] text-slate-400 sm:grid-cols-3">
                    <span class="flex items-center gap-1">
                        <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                        Education
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="h-2 w-2 rounded-full bg-amber-500"></span>
                        Experience
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="h-2 w-2 rounded-full bg-slate-300"></span>
                        Projects
                    </span>
                </div>
            </div>
            <div class="mt-4 grid gap-3 text-sm text-slate-600 sm:grid-cols-3">
                <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                    <p class="text-[0.6rem] uppercase tracking-[0.3em] text-slate-400">Completed</p>
                    <p class="text-base font-semibold text-slate-900">4 / 5</p>
                </div>
                <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                    <p class="text-[0.6rem] uppercase tracking-[0.3em] text-slate-400">Next step</p>
                    <p class="text-base font-semibold text-slate-900">Add portfolio</p>
                </div>
                <div class="rounded-2xl border border-slate-100 bg-slate-50 px-4 py-3">
                    <p class="text-[0.6rem] uppercase tracking-[0.3em] text-slate-400">Last updated</p>
                    <p class="text-base font-semibold text-slate-900">2 days ago</p>
                </div>
            </div>
                
        </section>
        <section class="mt-6">

            <div class="mt-6 flex flex-col gap-3 rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold text-slate-900">Upload your resume</p>
                        <p class="text-sm text-slate-600">Share a PDF so recruiters get a quick snapshot of everything in one place.</p>
                    </div>
                    <button type="button" class="inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-slate-700 transition hover:border-slate-400 hover:text-slate-900">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v12m0 0l-3-3m3 3l3-3" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 21h14a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2z" />
                        </svg>
                        Upload
                    </button>
                </div>
        </section>
     
        <section class="mt-6">
            <div class="space-y-4">
                <div class="flex items-center justify-between gap-2">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Education</h3>
                    </div>
                    <div class="flex flex-1 items-center justify-end gap-2">
                        <button
                            type="button"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1 text-[0.65rem] font-semibold tracking-[0.3em] text-slate-700 transition hover:border-slate-400 hover:text-slate-900"
                        >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                            </svg>
                            Add
                        </button>
                       
                    </div>
                </div>
                <div class="space-y-3">
                    <article class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-xs uppercase tracking-[0.4em] text-slate-400">2022 – 2024</p>
                                <p class="text-base font-semibold text-slate-900">MSc. in Computer Science</p>
                                <p class="text-sm text-slate-600">University of Indore</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-100 p-2 text-slate-600 hover:bg-slate-200"
                                    aria-label="Edit education">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 17.25V21h3.75L17.81 10.94l-3.75-3.75L4 17.25z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.71 7.04a1.004 1.004 0 0 0 0-1.42l-2.34-2.34a1.004 1.004 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/>
                                    </svg>
                                </button>
                                <button class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-100 p-2 text-rose-600 hover:bg-rose-50"
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
                    <article class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-xs uppercase tracking-[0.4em] text-slate-400">2006 – 2010</p>
                                <p class="text-base font-semibold text-slate-900">BSc. in Information Technology</p>
                                <p class="text-sm text-slate-600">City College, Indore</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-100 p-2 text-slate-600 hover:bg-slate-200"
                                    aria-label="Edit education">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 17.25V21h3.75L17.81 10.94l-3.75-3.75L4 17.25z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.71 7.04a1.004 1.004 0 0 0 0-1.42l-2.34-2.34a1.004 1.004 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/>
                                    </svg>
                                </button>
                                <button class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-100 p-2 text-rose-600 hover:bg-rose-50"
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
                </div>
            </div>
        </section>
        <section class="mt-6">
            <div class="space-y-4">
                <div class="flex items-center justify-between gap-2">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">Experience</h3>
                    </div>
                    <div class="flex flex-1 items-center justify-end gap-2">
                        <button
                            type="button"
                            class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1 text-[0.65rem] font-semibold tracking-[0.3em] text-slate-700 transition hover:border-slate-400 hover:text-slate-900"
                        >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 5v14m-7-7h14" />
                            </svg>
                            Add
                        </button>
                    </div>
                </div>
                <div class="space-y-3">
                    <article class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-xs uppercase tracking-[0.4em] text-slate-400">2021 – Present</p>
                                <p class="text-base font-semibold text-slate-900">Senior PHP Engineer</p>
                                <p class="text-sm text-slate-600">Nimbus Softworks · Remote</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-100 p-2 text-slate-600 hover:bg-slate-200"
                                    aria-label="Edit experience">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 17.25V21h3.75L17.81 10.94l-3.75-3.75L4 17.25z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.71 7.04a1.004 1.004 0 0 0 0-1.42l-2.34-2.34a1.004 1.004 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/>
                                    </svg>
                                </button>
                                <button class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-100 p-2 text-rose-600 hover:bg-rose-50"
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
                    <article class="rounded-2xl border border-slate-100 bg-slate-50 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-xs uppercase tracking-[0.4em] text-slate-400">2018 – 2021</p>
                                <p class="text-base font-semibold text-slate-900">PHP Developer</p>
                                <p class="text-sm text-slate-600">Lumen Labs · Indore</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-100 p-2 text-slate-600 hover:bg-slate-200"
                                    aria-label="Edit experience">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 17.25V21h3.75L17.81 10.94l-3.75-3.75L4 17.25z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.71 7.04a1.004 1.004 0 0 0 0-1.42l-2.34-2.34a1.004 1.004 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/>
                                    </svg>
                                </button>
                                <button class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-slate-100 p-2 text-rose-600 hover:bg-rose-50"
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
                </div>
            </div>
        </section>
      
    </div>
@endsection