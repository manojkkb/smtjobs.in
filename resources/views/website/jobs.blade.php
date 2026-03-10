@extends('website.layouts.app')

@section('title', 'Explore jobs | SMTJobs')

@section('content')
    <div class="mx-auto max-w-7xl space-y-10 px-4 pb-16 sm:px-6 lg:px-8">
        <section class="rounded-[32px] border-2 border-slate-200 bg-white p-6 lg:p-8 shadow-xl">
           
            @include('website.components.search')

            <div class="mt-6 lg:hidden">
                <details class="rounded-3xl border-2 border-slate-200 bg-white p-4 shadow-lg">
                    <summary class="flex cursor-pointer items-center justify-between text-sm font-bold text-black">
                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h18M6 12h12M10 19h4" />
                            </svg>
                            Filters
                        </span>
                        <span class="text-xs uppercase tracking-wider text-slate-500">Show</span>
                    </summary>
                        <div class="mt-4">
                            @include('website.partials.job-filters', ['formClass' => 'space-y-4 text-sm text-slate-600'])
                        </div>
                    </details>
                </div>

        </section>

        <section class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_2fr_1fr] items-start">
            <aside class="hidden lg:flex lg:w-full lg:flex-col lg:space-y-6 rounded-[32px] border-2 border-slate-200 bg-white p-6 shadow-xl sticky top-6">
                <div class="space-y-3">
                    <div class="inline-flex items-center gap-2 rounded-full bg-black px-3 py-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h18M6 12h12M10 19h4" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-white">Filters</span>
                    </div>
                    <h2 class="text-2xl font-bold text-black">Refine Search</h2>
                </div>
                <div>
                    @include('website.partials.job-filters')
                </div>
                <div class="rounded-3xl border-2 border-black bg-slate-50 p-5 text-sm">
                    <div class="mb-3 inline-flex items-center gap-2 rounded-full bg-black px-3 py-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-white">Support</span>
                    </div>
                    <p class="text-base font-bold text-black mb-2">Need Guidance?</p>
                    <p class="text-slate-700 leading-relaxed">We'll match you with a recruiter for personalized job recommendations.</p>
                </div>
            </aside>
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="inline-flex items-center gap-2 rounded-full bg-black px-4 py-2 mb-3">
                            <span class="text-xs font-bold uppercase tracking-wider text-white">Live Jobs</span>
                        </div>
                        <h2 class="text-4xl font-bold text-black">Available Opportunities</h2>
                    </div>
                </div>
                <div class="grid gap-6">
                    @foreach ($jobPosts as $jobPost)
                        @php
                            $company = $jobPost->company;
                            $profile = $jobPost->profile;
                            $industry = $jobPost->industry;
                            $category = $jobPost->category;
                            $employmentType = $jobPost->employmentType;
                            $experienceRange = $jobPost->experienceRange;

                            $jobTitle = $jobPost->title ?? ($category?->label ?? 'Open role');
                            $locationLabel = $jobPost->city?->name ?? 'Remote';
                            $salaryLabel = ($jobPost->min_salary && $jobPost->max_salary)
                                ? 'LKR ' . number_format($jobPost->min_salary) . ' - ' . number_format($jobPost->max_salary)
                                : 'Competitive';
                            $experienceLabel = $experienceRange?->name ?? $experienceRange?->label ?? 'Experience';
                           
                            $badgeLabel = $jobPost->is_featured ? 'Featured' : ($jobPost->is_remote ? 'Remote' : 'Open role');
                            $typeLabel = $employmentType?->label ?? $employmentType?->name ?? 'Full-time';
                            $companyInitials = strtoupper(substr($company->name ?? 'SM', 0, 2));
                            $postedAgo = $jobPost->published_at?->diffForHumans() ?? 'Recently';
                        @endphp
                        <article class="group relative space-y-5 rounded-3xl border-2 border-slate-200 bg-white p-6 shadow-lg transition-all hover:border-black hover:-translate-y-2 hover:shadow-2xl">
                            <div class="flex items-center justify-between text-xs">
                                <span class="rounded-full border-2 border-black bg-black px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-white">{{ $badgeLabel }}</span>
                                <span class="rounded-full border-2 border-slate-200 bg-white px-4 py-1.5 text-xs font-bold uppercase tracking-wider text-slate-700">{{ $typeLabel }}</span>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-black text-lg font-bold text-white shadow-xl">
                                    {{ $companyInitials }}
                                </div>
                                <div>
                                    <h3 class="text-2xl font-bold text-black group-hover:text-slate-700 transition">{{ $jobTitle }}</h3>
                                    <p class="text-base text-slate-600 font-semibold">{{ $company->name }}</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center gap-4 text-sm text-slate-700">
                                <span class="flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4 text-black" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M12 2c-4 0-7 3-7 7 0 5.25 7 13 7 13s7-7.75 7-13c0-4-3-7-7-7z" />
                                        <circle cx="12" cy="9" r="2" />
                                    </svg>
                                    <span class="font-semibold">{{ $locationLabel }}</span>
                                </span>
                                <span class="flex items-center gap-2">
                                    <svg class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="font-semibold">{{ $salaryLabel }}</span>
                                </span>
                                <span class="flex items-center gap-2">
                                    <svg class="h-4 w-4 text-black" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    <span class="font-semibold">{{ $experienceLabel }}</span>
                                </span>
                            </div>
                          
                            <div class="flex items-center justify-between border-t-2 border-slate-200 pt-4">
                                <span class="flex items-center gap-2 text-xs text-slate-500 font-semibold">
                                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $postedAgo }}
                                </span>
                                <a href="{{ route('job.show', ['city' => $jobPost->city_slug, 'slug' => $jobPost->slug]) }}" class="relative z-20 inline-flex items-center gap-2 rounded-full bg-black px-6 py-3 text-sm font-bold text-white transition-all hover:bg-slate-800 hover:shadow-xl hover:-translate-y-1 group">
                                    Apply Now
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 transition-transform group-hover:translate-x-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
                @if ($jobPosts->hasPages())
                    <div class="mt-6 space-y-4 rounded-3xl border-2 border-slate-200 bg-white p-6 shadow-lg">
                        <p class="text-sm text-slate-600 font-semibold">
                            Showing {{ $jobPosts->firstItem() ?? 0 }}–{{ $jobPosts->lastItem() ?? 0 }} of {{ $jobPosts->total() }} roles
                        </p>
                        <div class="flex justify-center">
                            {{ $jobPosts->links('pagination::tailwind') }}
                        </div>
                    </div>
                @endif
            </div>
            <aside class="space-y-6 rounded-[32px] border-2 border-slate-200 bg-white p-6 shadow-xl sticky top-6">
                <div class="space-y-3">
                    <div class="inline-flex items-center gap-2 rounded-full bg-black px-3 py-1.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-white">Recommended</span>
                    </div>
                    <h3 class="text-2xl font-bold text-black">Similar Roles</h3>
                    <p class="text-sm text-slate-600">Jobs matching your search</p>
                </div>
                <div class="space-y-4">
                    @foreach ($jobPosts->take(3) as $similar)
                        @php
                            $company = $similar->company;
                            $profile = $similar->profile;
                            $title = $profile->title ?? 'Open role';
                            $locationLabel = $similar->city?->name ?? 'Any';
                            $experienceLabel = $similar->experienceRange?->name ?? 'Experience';
                            $salaryLabel = ($similar->min_salary && $similar->max_salary)
                                ? 'LKR ' . number_format($similar->min_salary) . ' - ' . number_format($similar->max_salary)
                                : 'Competitive';
                        @endphp
                        <a href="{{ route('job.show', ['city' => $similar->city_slug, 'slug' => $similar->slug]) }}" class="group flex flex-col gap-3 rounded-3xl border-2 border-slate-200 bg-white p-4 transition-all hover:border-black hover:shadow-lg hover:-translate-y-1">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <p class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-1">{{ $company->name }}</p>
                                    <p class="text-base font-bold text-black group-hover:text-slate-700 transition mb-2">{{ $title }}</p>
                                    <div class="space-y-1">
                                        <p class="text-xs text-slate-600 font-semibold flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path d="M12 2c-4 0-7 3-7 7 0 5.25 7 13 7 13s7-7.75 7-13c0-4-3-7-7-7z" />
                                                <circle cx="12" cy="9" r="2" />
                                            </svg>
                                            {{ $locationLabel }}
                                        </p>
                                        <p class="text-xs text-slate-600 font-semibold">{{ $experienceLabel }}</p>
                                        <p class="text-xs text-black font-bold">{{ $salaryLabel }}</p>
                                    </div>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 text-slate-400 transition-all group-hover:text-black group-hover:translate-x-1 flex-shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg>
                            </div>
                        </a>
                    @endforeach
                </div>
            </aside>
        </section>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const suggestionUrl = '{{ route('jobs.suggestions') }}';
            const cache = {};
            const containers = document.querySelectorAll('[data-suggestion-wrapper]');

            const fetchSuggestions = async (type, query) => {
                const key = `${type}:${query}`;
                if (cache[key]) {
                    return cache[key];
                }

                const params = new URLSearchParams({ type, q: query });
                const response = await fetch(`${suggestionUrl}?${params}`);
                if (!response.ok) {
                    return [];
                }

                const payload = await response.json();
                cache[key] = payload.suggestions ?? [];
                return cache[key];
            };

            const closeMenu = (menu) => {
                menu.classList.add('pointer-events-none', 'invisible');
            };

            const openMenu = (menu) => {
                menu.classList.remove('pointer-events-none', 'invisible');
            };

            containers.forEach((wrapper) => {
                const input = wrapper.querySelector('[data-suggestion-input]');
                const type = input ? input.dataset.suggestionInput : null;
                if (!type) {
                    return;
                }

                const menu = wrapper.querySelector(`[data-suggestion-menu="${type}"]`);
                const list = menu?.querySelector('div');

                const render = async (query) => {
                    if (!menu || !list) {
                        return;
                    }

                    const trimmed = query.trim();
                    const matches = await fetchSuggestions(type, trimmed);

                    if (!matches.length) {
                        list.innerHTML = '<p class="px-4 py-2 text-xs text-slate-400">No matches</p>';
                        closeMenu(menu);
                        return;
                    }

                    list.innerHTML = matches
                        .map(item => `<button type="button" class="w-full text-left px-4 py-2 hover:bg-slate-100" data-suggestion-item="${type}" data-value="${item}">${item}</button>`)
                        .join('');

                    openMenu(menu);
                };

                input.addEventListener('focus', () => render(input.value));
                input.addEventListener('input', () => render(input.value));

                input.addEventListener('keydown', (event) => {
                    if (event.key === 'Escape') {
                        closeMenu(menu);
                    }
                });

                menu.addEventListener('click', (event) => {
                    const button = event.target.closest('[data-suggestion-item]');
                    if (!button) {
                        return;
                    }

                    input.value = button.dataset.value;
                    closeMenu(menu);
                    input.focus();
                });

                document.addEventListener('click', (event) => {
                    if (!wrapper.contains(event.target)) {
                        closeMenu(menu);
                    }
                });
            });
        });
    </script>
@endsection