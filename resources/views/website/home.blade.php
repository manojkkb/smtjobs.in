@extends('website.layouts.app')

@section('title', 'Find your next tech role | SMTJobs')

@section('content')
    @php
        $trendingJobs = [
            [
                'title' => 'Senior Laravel Engineer',
                'company' => 'Horizon Fintech',
                'location' => 'Colombo, Sri Lanka',
                'salary' => 'LKR 450k - 520k',
                'type' => 'Full-time · Remote friendly',
                'tags' => ['Laravel', 'API', 'PostgreSQL'],
                'badge' => 'Hiring fast',
            ],
            [
                'title' => 'Lead UI/UX Designer',
                'company' => 'Ceylon Creative',
                'location' => 'Kandy',
                'salary' => 'LKR 320k - 400k',
                'type' => 'Hybrid',
                'tags' => ['Figma', 'Research', 'Team Lead'],
                'badge' => 'Interviewing this week',
            ],
            [
                'title' => 'Cloud DevOps Specialist',
                'company' => 'Respira Labs',
                'location' => 'Gampaha',
                'salary' => 'LKR 410k - 480k',
                'type' => 'Full-time',
                'tags' => ['AWS', 'Terraform', 'CI/CD'],
                'badge' => 'SSO ready team',
            ],
            [
                'title' => 'Product Data Analyst',
                'company' => 'Slate Academy',
                'location' => 'Jaffna (Remote)',
                'salary' => 'LKR 280k - 360k',
                'type' => 'Contract',
                'tags' => ['SQL', 'Looker', 'Storytelling'],
                'badge' => 'Urgent',
            ],
        ];

        $topCities = [
            ['city' => 'Colombo', 'count' => '2,180 roles', 'growth' => '+14% vs last quarter'],
            ['city' => 'Kandy', 'count' => '640 roles', 'growth' => '+9%'],
            ['city' => 'Galle', 'count' => '410 roles', 'growth' => '+6%'],
            ['city' => 'Jaffna', 'count' => '320 roles', 'growth' => '+8%'],
        ];
    @endphp
    <div class="mx-auto w-full max-w-6xl space-y-10 px-0 sm:px-6 lg:px-0">
        <section class="rounded-3xl border border-slate-200 bg-white/80 p-6">
            <div class="space-y-2">
                <p class="text-xs uppercase tracking-[0.5em] text-slate-500">Search</p>
                <h2 class="text-2xl font-semibold text-slate-900">Find the job that matches your ambition</h2>
                <p class="text-sm text-slate-500">Filter by keywords, companies, and skills with a precise location.</p>
            </div>

            <form class="mt-6">
                <div class="grid gap-6 md:grid-cols-3 items-end">
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Keyword</span>
                        <input
                            class="w-full rounded-2xl border border-slate-200 bg-[#e7e7e7] px-4 py-3 text-base font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            placeholder="Role · Company · Skill"
                        />
                    </label>
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Location</span>
                        <input
                            class="w-full rounded-2xl border border-slate-200 bg-[#e7e7e7] px-4 py-3 text-base font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            placeholder="City · Area · Pincode"
                        />
                    </label>
                    <button
                        type="button"
                        class="w-full rounded-2xl border border-slate-900 bg-transparent px-6 py-3 text-sm font-semibold text-slate-900 shadow-none transition hover:bg-slate-900 hover:text-white"
                    >
                        Search jobs
                    </button>
                </div>
            </form>

            <div class="mt-4 flex flex-wrap gap-3 text-xs text-slate-500">
                <span class="rounded-full border border-slate-200 px-3 py-1">Remote-first</span>
                <span class="rounded-full border border-slate-200 px-3 py-1">Startup ready</span>
                <span class="rounded-full border border-slate-200 px-3 py-1">Senior roles</span>
                <span class="rounded-full border border-slate-200 px-3 py-1">Flexible hours</span>
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
                        <p class="text-3xl font-bold text-slate-900">14K+</p>
                        <p class="text-sm uppercase tracking-[0.4em] text-slate-400">roles listed</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-slate-900">3.5K</p>
                        <p class="text-sm uppercase tracking-[0.4em] text-slate-400">verified companies</p>
                    </div>
                    <div>
                        <p class="text-3xl font-bold text-slate-900">97%</p>
                        <p class="text-sm uppercase tracking-[0.4em] text-slate-400">hired this year</p>
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
                <a href="#resume" class="text-sm font-semibold text-slate-900 transition hover:text-slate-600">See all curated roles →</a>
            </div>
            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($trendingJobs as $job)
                    <article class="flex flex-col gap-5 rounded-3xl border border-slate-200 bg-white p-6 transition hover:-translate-y-1">
                        <div class="flex items-center justify-between text-xs uppercase tracking-[0.3em] text-slate-400">
                            <span class="rounded-full border border-dashed border-slate-200 px-3 py-1 text-[0.6rem]">{{ $job['badge'] }}</span>
                            <span class="text-[0.7rem] font-semibold text-slate-600">{{ $job['type'] }}</span>
                        </div>
                        <div class="space-y-2">
                            <h3 class="text-xl font-semibold text-slate-900">{{ $job['title'] }}</h3>
                            <p class="text-sm text-slate-500">{{ $job['company'] }}</p>
                        </div>
                        <p class="text-sm leading-relaxed text-slate-600">{{ $job['location'] }} · {{ $job['salary'] }}</p>
                        <div class="flex flex-wrap gap-2 text-[0.6rem] uppercase tracking-[0.4em] text-slate-400">
                            @foreach ($job['tags'] as $tag)
                                <span class="rounded-full border border-slate-200 px-3 py-1">{{ $tag }}</span>
                            @endforeach
                        </div>
                        <div class="flex items-center justify-between text-sm font-semibold text-slate-900">
                            <span>Apply now</span>
                            <span class="text-xs text-slate-400">Posted 2 days ago</span>
                        </div>
                    </article>
                @endforeach
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
                @foreach ($topCities as $city)
                    <article class="rounded-2xl border border-slate-200 bg-white p-6">
                        <p class="text-xs uppercase tracking-[0.4em] text-slate-400">{{ $city['city'] }}</p>
                        <p class="text-2xl font-semibold text-slate-900">{{ $city['count'] }}</p>
                        <p class="text-xs text-slate-500">{{ $city['growth'] }}</p>
                    </article>
                @endforeach
            </div>
        </section>
    </div>

   
@endsection