@extends('website.layouts.app')

@section('title', 'Explore jobs | SMTJobs')

@section('content')
    @php
        $popularFilters = ['Remote', 'Hybrid', 'Senior', 'Entry-level', 'Engineering', 'Product', 'Design'];
        $jobCategories = [
            ['label' => 'Product / Design', 'roles' => '320 roles', 'color' => 'text-orange-600'],
            ['label' => 'Engineering', 'roles' => '680 roles', 'color' => 'text-cyan-600'],
            ['label' => 'Operations', 'roles' => '190 roles', 'color' => 'text-violet-600'],
            ['label' => 'People & Culture', 'roles' => '145 roles', 'color' => 'text-amber-600'],
        ];
    @endphp

    <div class="mx-auto max-w-6xl space-y-10 px-4 pb-16 sm:px-6 lg:px-0">
        <section class="rounded-3xl border border-slate-200 bg-white/60 p-6 lg:p-8">
           
            <form method="GET" action="{{ route('jobs') }}" class="mt-6">
                <div class="grid gap-6 md:grid-cols-3 items-end">
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Keyword</span>
                        <div class="relative" data-suggestion-wrapper>
                            <input
                                autocomplete="off"
                                name="keyword"
                                value="{{ request('keyword') }}"
                                class="w-full rounded-2xl border border-slate-200 bg-[#e7e7e7] px-4 py-3 text-base font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                                placeholder="Role · Company · Skill"
                                data-suggestion-input="keyword"
                            />
                            <div
                                class="pointer-events-none invisible absolute inset-x-0 top-full mt-1 max-h-64 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-900/10"
                                data-suggestion-menu="keyword"
                            >
                                <div class="max-h-56 overflow-y-auto text-sm text-slate-700"></div>
                            </div>
                        </div>
                    </label>
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Location</span>
                        <div class="relative" data-suggestion-wrapper>
                            <input
                                autocomplete="off"
                                name="location"
                                value="{{ request('location') }}"
                                class="w-full rounded-2xl border border-slate-200 bg-[#e7e7e7] px-4 py-3 text-base font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                                placeholder="City · Area · Pincode"
                                data-suggestion-input="location"
                            />
                            <div
                                class="pointer-events-none invisible absolute inset-x-0 top-full mt-1 max-h-64 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-xl shadow-slate-900/10"
                                data-suggestion-menu="location"
                            >
                                <div class="max-h-56 overflow-y-auto text-sm text-slate-700"></div>
                            </div>
                        </div>
                    </label>
                    <button
                        type="submit"
                        class="w-full rounded-2xl border border-slate-900 bg-transparent px-6 py-3 text-sm font-semibold text-slate-900 shadow-none transition hover:bg-slate-900 hover:text-white"
                    >
                        Search jobs
                    </button>
                </div>
                @php
                    $searchPreserve = request()->except(['keyword', 'location', 'page']);
                @endphp
                @foreach ($searchPreserve as $param => $value)
                    @if (is_array($value))
                        @foreach ($value as $entry)
                            <input type="hidden" name="{{ $param }}[]" value="{{ $entry }}" />
                        @endforeach
                    @else
                        <input type="hidden" name="{{ $param }}" value="{{ $value }}" />
                    @endif
                @endforeach
            </form>

            <div class="mt-6 lg:hidden">
                <details class="rounded-3xl border border-slate-200 bg-slate-50/80 p-4">
                    <summary class="flex cursor-pointer items-center justify-between text-sm font-semibold text-slate-900">
                        <span class="flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-900" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5h18M6 12h12M10 19h4" />
                            </svg>
                            Filters
                        </span>
                        <span class="text-xs uppercase tracking-[0.3em] text-slate-500">Show</span>
                    </summary>
                        <div class="mt-4">
                            @include('website.partials.job-filters', ['formClass' => 'space-y-4 text-sm text-slate-600'])
                        </div>
                    </details>
                </div>

        </section>

        <section class="grid grid-cols-1 gap-6 lg:grid-cols-[1fr_1.4fr_1fr] items-start">
            <aside class="hidden lg:flex lg:w-full lg:flex-col lg:space-y-5 rounded-3xl border border-slate-200 bg-white p-6">
                <div class="space-y-2">
                    <p class="text-xs uppercase tracking-[0.4em] text-slate-400">Filters</p>
                    <h2 class="text-xl font-semibold text-slate-900">Focus the feed</h2>
                </div>
                <div>
                    @include('website.partials.job-filters')
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50/60 p-4 text-sm text-slate-500">
                    <p class="text-xs uppercase tracking-[0.3em]">Talent touch</p>
                    <p class="font-semibold text-slate-900">Recruiter support</p>
                    <p>Need guidance on the right role? We’ll match you to a recruiter instantly.</p>
                </div>
            </aside>
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs uppercase tracking-[0.4em] text-slate-400">Open opportunities</p>
                        <h2 class="text-3xl font-semibold text-slate-900">Fresh roles waiting for you</h2>
                    </div>
                    <button class="text-sm font-semibold text-slate-600 transition hover:text-slate-900">Sort by latest</button>
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

                            $jobTitle = $profile->title ?? ($category?->label ?? 'Open role');
                            $locationLabel = $jobPost->city?->name ?? 'Remote';
                            $salaryLabel = ($jobPost->min_salary && $jobPost->max_salary)
                                ? 'LKR ' . number_format($jobPost->min_salary) . ' - ' . number_format($jobPost->max_salary)
                                : 'Competitive';
                            $experienceLabel = $experienceRange?->name ?? $experienceRange?->label ?? 'Experience';
                            $tags = array_values(array_unique(array_filter([
                                $industry?->label ?? $industry?->name,
                                $category?->label ?? $category?->name,
                                $employmentType?->label ?? $employmentType?->name,
                                $experienceLabel,
                            ])));
                            $badgeLabel = $jobPost->is_featured ? 'Featured' : ($jobPost->is_remote ? 'Remote' : 'Open role');
                            $typeLabel = $employmentType?->label ?? $employmentType?->name ?? 'Full-time';
                            $companyInitials = strtoupper(substr($company->name ?? 'SM', 0, 2));
                            $postedAgo = $jobPost->published_at?->diffForHumans() ?? 'Recently';
                        @endphp
                        <article class="space-y-4 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-900/5 transition hover:-translate-y-1">
                            <div class="flex items-center justify-between text-xs uppercase tracking-[0.3em] text-slate-400">
                                <span class="rounded-full border border-slate-200 px-3 py-1 text-[0.65rem]">{{ $badgeLabel }}</span>
                                <span class="text-[0.65rem] font-semibold text-slate-500">{{ $typeLabel }}</span>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900/5 text-lg font-semibold text-slate-900">
                                    {{ $companyInitials }}
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-slate-900">{{ $jobTitle }}</h3>
                                    <p class="text-sm text-slate-500">{{ $company->name }}</p>
                                </div>
                            </div>
                            <div class="flex flex-wrap items-center gap-4 text-sm text-slate-600">
                                <span class="flex items-center gap-1 text-slate-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="1.2">
                                        <path d="M12 2c-4 0-7 3-7 7 0 5.25 7 13 7 13s7-7.75 7-13c0-4-3-7-7-7z" />
                                        <circle cx="12" cy="9" r="2" />
                                    </svg>
                                    {{ $locationLabel }}
                                </span>
                                <span>{{ $salaryLabel }}</span>
                                <span>Experience: {{ $experienceLabel }}</span>
                            </div>
                            <div class="flex flex-wrap gap-2 text-[0.65rem] uppercase tracking-[0.35em] text-slate-400">
                                @foreach ($tags as $tag)
                                    <span class="rounded-full border border-slate-200 px-3 py-1">{{ $tag }}</span>
                                @endforeach
                            </div>
                            <div class="flex items-center justify-between text-sm font-semibold text-slate-900">
                                <span class="text-xs text-slate-400">{{ $postedAgo }}</span>
                                <span class="inline-flex items-center gap-2 text-xs font-semibold uppercase tracking-[0.3em] text-slate-900">
                                    View job
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </span>
                            </div>
                        </article>
                    @endforeach
                </div>
                @if ($jobPosts->hasPages())
                    <div class="mt-6 space-y-3 rounded-2xl border border-slate-200 bg-white/80 p-4 shadow-sm shadow-slate-900/5">
                        <p class="text-sm text-slate-500">
                            Showing {{ $jobPosts->firstItem() ?? 0 }}&ndash;{{ $jobPosts->lastItem() ?? 0 }} of {{ $jobPosts->total() }} roles
                        </p>
                        <div class="flex justify-center">
                            {{ $jobPosts->links('pagination::tailwind') }}
                        </div>
                    </div>
                @endif
            </div>
            <aside class="space-y-5 rounded-3xl border border-slate-200 bg-white p-6">
                <div class="space-y-2">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Similar roles</p>
                    <h3 class="text-lg font-semibold text-slate-900">You might also like</h3>
                </div>
                <div class="space-y-4 text-sm text-slate-600">
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
                        <div class="flex items-center justify-between rounded-2xl border border-slate-100 bg-slate-50/60 p-3">
                            <div>
                                <p class="text-xs uppercase tracking-[0.3em] text-slate-400">{{ $company->name }}</p>
                                <p class="text-sm font-semibold text-slate-900">{{ $title }}</p>
                                <p class="text-xs text-slate-500">{{ $locationLabel }} · {{ $experienceLabel }}</p>
                                <p class="text-xs text-slate-500">Salary {{ $salaryLabel }}</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-4 w-4 text-slate-500">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </div>
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