@extends('website.layouts.app')

@section('title', 'Find your next tech role | SMTJobs')

@section('content')
    <div class="mx-auto w-full max-w-6xl space-y-10 px-0 sm:px-6 lg:px-0">
        <section class="rounded-3xl border border-slate-200  p-6">
            <div class="space-y-2">
                <p class="text-xs uppercase tracking-[0.5em] text-slate-500">🇮🇳 India-Focused</p>
                <h2 class="text-2xl font-semibold text-slate-900">Explore Opportunities That Match Your Skills</h2>
                <p class="text-sm text-slate-500">Smart filters. Precise location. Better matches.</p>
            </div>

            @include('website.components.search')
        </section>

        <section class="rounded-3xl border border-slate-200 bg-gradient-to-br from-blue-50 to-white p-6 lg:p-10">
            <div class="grid gap-8 lg:grid-cols-2 items-center">
                <div class="space-y-4">
                    <p class="text-xs uppercase tracking-[0.4em] text-blue-600">For employers</p>
                    <h2 class="text-3xl font-semibold text-slate-900 md:text-4xl">Post a job and find your next great hire</h2>
                    <p class="text-lg text-slate-600">Connect with skilled professionals actively seeking opportunities. Get quality applications from candidates who match your requirements.</p>
                    <div class="flex flex-wrap gap-4 pt-2">
                        <a
                            href="{{ route('recruiter.job-posts.create') }}"
                            class="inline-flex items-center rounded-full bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:-translate-y-0.5 hover:bg-blue-700"
                        >
                            Post a Job
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <a
                            href="{{ route('recruiter.dashboard') }}"
                            class="inline-flex items-center rounded-full border border-slate-300 px-6 py-3 text-sm font-semibold text-slate-900 transition hover:border-slate-400 hover:bg-slate-50"
                        >
                            Employer Dashboard
                        </a>
                    </div>
                </div>
                <div class="grid gap-6 sm:grid-cols-2">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6">
                        <div class="mb-3 inline-flex rounded-full bg-blue-100 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900">Quality Candidates</h3>
                        <p class="mt-2 text-sm text-slate-600">Access a pool of verified and skilled professionals</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-6">
                        <div class="mb-3 inline-flex rounded-full bg-green-100 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900">Fast Hiring</h3>
                        <p class="mt-2 text-sm text-slate-600">Post jobs in minutes and start receiving applications instantly</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-6">
                        <div class="mb-3 inline-flex rounded-full bg-purple-100 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900">Analytics</h3>
                        <p class="mt-2 text-sm text-slate-600">Track your job performance with detailed insights</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-6">
                        <div class="mb-3 inline-flex rounded-full bg-orange-100 p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-orange-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-slate-900">Cost Effective</h3>
                        <p class="mt-2 text-sm text-slate-600">Competitive pricing with flexible plans for all company sizes</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-[32px] border border-slate-200 bg-gradient-to-br from-slate-50 to-white p-6 lg:p-10">
            <div class="grid gap-10 lg:grid-cols-[1.3fr]">
                <div class="space-y-4">
                    <p class="text-xs uppercase tracking-[0.4em] text-slate-400">APN inspired · light design</p>
                    <h1 class="text-4xl font-semibold leading-tight text-slate-900 md:text-5xl">Own the next chapter of your tech journey</h1>
                    <p class="text-lg text-slate-500">Curated roles, transparent pay bands, and a resume builder all within one modern experience.</p>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a
                        href="#jobs"
                        class="inline-flex items-center rounded-full bg-slate-900 px-6 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition hover:-translate-y-0.5"
                    >
                        Browse jobs
                    </a>
                    <a
                        href="#resume"
                        class="inline-flex items-center rounded-full border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-900 transition hover:border-slate-400"
                    >
                        Try resume maker
                    </a>
                </div>
                <div class="grid gap-6 sm:grid-cols-3">
                    <div>
                        <p class="text-3xl font-bold text-slate-900">{{ number_format($stats['total_jobs']) }}+</p>
                        <p class="text-sm uppercase tracking-[0.4em] text-slate-400">roles listed</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-slate-900">{{ number_format($stats['total_companies']) }}</p>
                        <p class="text-sm uppercase tracking-[0.4em] text-slate-400">verified companies</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-slate-900">{{ $stats['total_cities'] }}</p>
                        <p class="text-sm uppercase tracking-[0.4em] text-slate-400">cities hiring</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="jobs" class="space-y-8">
            <div class="flex flex-col items-center text-center gap-3">
                <div>
                    <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Trending now</p>
                    <h2 class="text-3xl font-semibold text-slate-900">Roles companies are racing to fill</h2>
                </div>
                <a href="{{ route('jobs') }}" class="text-sm font-semibold text-slate-900 transition hover:text-slate-600">See all curated roles →</a>
            </div>
            <div class="grid gap-6 md:grid-cols-2">
                @forelse ($trendingJobs as $job)
                    <article class="flex flex-col gap-5 rounded-3xl border border-slate-200 bg-white p-6 transition hover:-translate-y-1">
                        <div class="flex items-center justify-between text-xs uppercase tracking-[0.3em] text-slate-400">
                            <span class="rounded-full border border-dashed border-slate-200 px-3 py-1 text-[0.6rem]">
                                @if($job->is_featured)
                                    Featured
                                @elseif($job->published_at && $job->published_at->isToday())
                                    New Today
                                @elseif($job->published_at && $job->published_at->diffInDays(now()) <= 3)
                                    Hiring Fast
                                @else
                                    Open
                                @endif
                            </span>
                            <span class="text-[0.7rem] font-semibold text-slate-600">
                                {{ optional($job->employmentType)->label ?? 'Full-time' }}
                                @if($job->is_remote) · Remote friendly @endif
                            </span>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-xl font-semibold text-slate-900">{{ $job->title }}</h3>
                            <p class="text-sm text-slate-500">{{ optional($job->company)->name ?? 'Company' }}</p>
                        </div>
                        <p class="text-sm leading-relaxed text-slate-600">
                            {{ optional($job->city)->name ?? 'Location' }}
                            @if($job->min_salary && $job->max_salary)
                                · ₹{{ number_format($job->min_salary / 1000) }}k - ₹{{ number_format($job->max_salary / 1000) }}k
                            @endif
                        </p>
                        @if($job->detail && $job->detail->description)
                            <p class="text-sm text-slate-600 line-clamp-2">{{ Str::limit(strip_tags($job->detail->description), 100) }}</p>
                        @endif
                        <div class="flex items-center justify-between text-sm font-semibold text-slate-900">
                            <a href="{{ route('job.show', $job->id) }}" class="hover:text-slate-600 transition">Apply now</a>
                            <span class="text-xs text-slate-400">Posted {{ $job->published_at ? $job->published_at->diffForHumans() : 'recently' }}</span>
                        </div>
                    </article>
                @empty
                    <div class="col-span-2 text-center py-12">
                        <p class="text-slate-500">No jobs available at the moment. Check back soon!</p>
                    </div>
                @endforelse
            </div>
        </section>

        <section id="resume" class="grid gap-6 rounded-3xl border border-slate-200 bg-white p-8 sm:grid-cols-[1.2fr_0.8fr]">
            <div class="space-y-4">
                <p class="text-xs uppercase tracking-[0.4em] text-slate-400">Resume Maker</p>
                <h2 class="text-3xl font-semibold text-slate-900">Shape your story</h2>
                <p class="text-sm leading-relaxed text-slate-600">Craft a modern resume that highlights projects, impact, and the soft skills recruiters ask about.</p>
                <div class="flex flex-wrap gap-3 text-xs text-slate-500">
                    <span class="rounded-full border border-slate-200 px-3 py-1">ATS friendly</span>
                    <span class="rounded-full border border-slate-200 px-3 py-1">Portfolio links</span>
                    <span class="rounded-full border border-slate-200 px-3 py-1">Live shareable link</span>
                </div>
            </div>
            <div class="flex flex-col justify-between gap-4 rounded-2xl border border-slate-200 bg-gradient-to-br from-cyan-50 to-violet-50 p-6">
                <div>
                    <p class="text-sm uppercase tracking-[0.5em] text-slate-500">Transform</p>
                    <p class="text-3xl font-semibold text-slate-900">120+ samples</p>
                </div>
                <p class="text-sm text-slate-700">Start with a template, add your projects, and publish a shareable career page instantly.</p>
                <a href="#" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition hover:-translate-y-0.5">Build resume</a>
            </div>
        </section>

        <section class="space-y-10">
            <div class="flex flex-col items-center text-center gap-3">
                <div>
                    <p class="text-sm uppercase tracking-[0.4em] text-slate-500">Top cities</p>
                    <h2 class="text-3xl font-semibold text-slate-900">Where tech teams are hiring</h2>
                </div>
                <span class="text-xs uppercase tracking-[0.4em] text-slate-400">2024 outlook</span>
            </div>
            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                @forelse ($topCities as $city)
                    <article class="rounded-2xl border border-slate-200 bg-white p-6">
                        <p class="text-xs uppercase tracking-[0.4em] text-slate-400">{{ $city->name }}</p>
                        <p class="text-2xl font-semibold text-slate-900">{{ number_format($city->job_posts_count) }} roles</p>
                        <p class="text-xs text-slate-500">Actively hiring</p>
                    </article>
                @empty
                    <div class="col-span-4 text-center py-8">
                        <p class="text-slate-500">No cities data available.</p>
                    </div>
                @endforelse
            </div>
        </section>
    </div>
@endsection