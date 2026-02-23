<aside
    id="adminSidebar"
    class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full transform overflow-y-auto border border-slate-200 bg-white px-5 py-7 shadow-lg transition duration-300 lg:static lg:translate-x-0 lg:shadow-none"
>
    <div class="flex items-center justify-between">
        <div>
            <p class="text-lg font-semibold text-slate-900">SMT Admin</p>
            <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Recruitment</p>
        </div>
        <button
            id="sidebarClose"
            class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-slate-200 bg-slate-50 text-slate-500 transition hover:border-slate-300 lg:hidden"
            aria-label="Close sidebar"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    @php
        $activeDashboard = request()->routeIs('admin.dashboard');
        $activeCandidates = request()->routeIs('admin.candidates.*');
        $activeCandidateList = request()->routeIs('admin.candidates.index');
        $companyMenu = [
            ['label' => 'Companies', 'route' => 'admin.companies.index', 'pattern' => 'admin.companies.*'],
            ['label' => 'Company Types', 'route' => 'admin.company-types.index', 'pattern' => 'admin.company-types.*'],
            ['label' => 'Company Sizes', 'route' => 'admin.company-sizes.index', 'pattern' => 'admin.company-sizes.*'],
        ];
        $activeCompanies = request()->routeIs(array_column($companyMenu, 'pattern'));
        $recruiterMenu = [
            ['label' => 'All Recruiters', 'route' => 'admin.recruiters.index', 'pattern' => 'admin.recruiters.*'],
        ];
        $activeRecruiters = request()->routeIs(array_column($recruiterMenu, 'pattern'));
        $activeMaster = request()->routeIs([
            'admin.industries.*',
            'admin.categories.*',
            'admin.certificates.*',
            'admin.shift-types.*',
            'admin.tags.*',
            'admin.skills.*',
            'admin.employment-types.*',
            'admin.work-modes.*',
            'admin.experience-ranges.*',
            'admin.education-levels.*',
            'admin.salary-ranges.*',
            'admin.notice-periods.*',
            'admin.benefits.*',
            'admin.countries.*',
            'admin.states.*',
            'admin.cities.*',
            'admin.areas.*',
            'admin.languages.*',
            'admin.user-statuses.*',
            'admin.job-levels.*',
            'admin.job-statuses.*',
            'admin.application-statuses.*',
            'admin.subscription-plans.*',
        ]);
        $masterMenu = [
            ['label' => 'Industries', 'route' => 'admin.industries.index', 'pattern' => 'admin.industries.*'],
            ['label' => 'Categories', 'route' => 'admin.categories.index', 'pattern' => 'admin.categories.*'],
            ['label' => 'Certificates', 'route' => 'admin.certificates.index', 'pattern' => 'admin.certificates.*'],
            ['label' => 'Shift Types', 'route' => 'admin.shift-types.index', 'pattern' => 'admin.shift-types.*'],
            ['label' => 'Tags', 'route' => 'admin.tags.index', 'pattern' => 'admin.tags.*'],
            ['label' => 'Skills', 'route' => 'admin.skills.index', 'pattern' => 'admin.skills.*'],
            ['label' => 'Employment Types', 'route' => 'admin.employment-types.index', 'pattern' => 'admin.employment-types.*'],
            ['label' => 'Work Modes', 'route' => 'admin.work-modes.index', 'pattern' => 'admin.work-modes.*'],
            ['label' => 'Experience Ranges', 'route' => 'admin.experience-ranges.index', 'pattern' => 'admin.experience-ranges.*'],
            ['label' => 'Education Levels', 'route' => 'admin.education-levels.index', 'pattern' => 'admin.education-levels.*'],
            ['label' => 'Salary Ranges', 'route' => 'admin.salary-ranges.index', 'pattern' => 'admin.salary-ranges.*'],
            ['label' => 'Notice Periods', 'route' => 'admin.notice-periods.index', 'pattern' => 'admin.notice-periods.*'],
            ['label' => 'Benefits', 'route' => 'admin.benefits.index', 'pattern' => 'admin.benefits.*'],
            ['label' => 'Countries', 'route' => 'admin.countries.index', 'pattern' => 'admin.countries.*'],
            ['label' => 'States', 'route' => 'admin.states.index', 'pattern' => 'admin.states.*'],
            ['label' => 'Cities', 'route' => 'admin.cities.index', 'pattern' => 'admin.cities.*'],
            ['label' => 'Areas', 'route' => 'admin.areas.index', 'pattern' => 'admin.areas.*'],
            ['label' => 'Languages', 'route' => 'admin.languages.index', 'pattern' => 'admin.languages.*'],
            ['label' => 'User Statuses', 'route' => 'admin.user-statuses.index', 'pattern' => 'admin.user-statuses.*'],
            ['label' => 'Job Statuses', 'route' => 'admin.job-statuses.index', 'pattern' => 'admin.job-statuses.*'],
            ['label' => 'Job Levels', 'route' => 'admin.job-levels.index', 'pattern' => 'admin.job-levels.*'],
            ['label' => 'Application Statuses', 'route' => 'admin.application-statuses.index', 'pattern' => 'admin.application-statuses.*'],
            ['label' => 'Subscription Plans', 'route' => 'admin.subscription-plans.index', 'pattern' => 'admin.subscription-plans.*'],
        ];
    @endphp

    <div class="mt-8 space-y-2">
        <p class="text-[0.65rem] uppercase tracking-[0.3em] text-slate-400">Main Menu</p>
        <nav class="space-y-1 text-sm">
            <a
                href="{{ route('admin.dashboard') }}"
                class="flex items-center justify-between rounded-xl px-3 py-2 text-sm font-semibold transition {{ $activeDashboard ? 'border border-slate-200 bg-slate-50 text-slate-900' : 'text-slate-700 hover:bg-slate-50' }}"
            >
                <span class="flex items-center gap-2">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75 12 3l9 6.75M4.5 10.5v9.75h3.75v-6h6v6h3.75V10.5" />
                    </svg>
                    Dashboard
                </span>
                <span class="text-[0.55rem] uppercase tracking-[0.3em] text-slate-400">Live</span>
            </a>

            <div class="space-y-1">
                <button
                    type="button"
                    class="flex w-full items-center justify-between rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 {{ $activeCandidates ? 'border border-slate-200 bg-slate-50 text-slate-900' : 'border border-transparent' }}"
                    data-menu-target="submenu-candidates"
                    aria-expanded="{{ $activeCandidates ? 'true' : 'false' }}"
                >
                    <span class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-cyan-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a4 4 0 0 0-4-4h-1M12 20h-5v-2a4 4 0 0 1 4-4h1m0 0a4 4 0 1 1-4-4" />
                        </svg>
                        Candidates
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" data-chevron class="h-3 w-3 transition-transform duration-200" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m6 8 4 4 4-4" />
                    </svg>
                </button>
                <div id="submenu-candidates" class="space-y-1 rounded-xl border border-slate-100 bg-slate-50 px-3 py-2 text-sm text-slate-600 shadow-inner shadow-slate-900/5 {{ $activeCandidates ? 'block' : 'hidden' }}">
                    <a
                        href="{{ route('admin.candidates.index') }}"
                        class="block rounded-lg px-2 py-1 transition {{ $activeCandidateList ? 'bg-slate-900/5 text-slate-900 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}"
                    >
                        Candidate List
                    </a>
                    <a href="#" class="block rounded-lg px-2 py-1 text-slate-600 transition hover:bg-slate-50">Applications</a>
                </div>
            </div>

            <div class="space-y-1">
                <button
                    type="button"
                    class="flex w-full items-center justify-between rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 {{ $activeCompanies ? 'border border-slate-200 bg-slate-50 text-slate-900' : 'border border-transparent' }}"
                    data-menu-target="submenu-companies"
                    aria-expanded="{{ $activeCompanies ? 'true' : 'false' }}"
                >
                    <span class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13h18M3 7h18M7 21h10V7H7z" />
                        </svg>
                        Companies
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" data-chevron class="h-3 w-3 transition-transform duration-200" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m6 8 4 4 4-4" />
                    </svg>
                </button>
                <div id="submenu-companies" class="space-y-1 rounded-xl border border-slate-100 bg-slate-50 px-3 py-2 text-sm text-slate-600 shadow-inner shadow-slate-900/5 {{ $activeCompanies ? 'block' : 'hidden' }}">
                    @foreach ($companyMenu as $item)
                        <a
                            href="{{ route($item['route']) }}"
                            class="block rounded-lg px-2 py-1 {{ request()->routeIs($item['pattern']) ? 'bg-slate-900/5 text-slate-900 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}"
                        >
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="space-y-1">
                <button
                    type="button"
                    class="flex w-full items-center justify-between rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 {{ $activeRecruiters ? 'border border-slate-200 bg-slate-50 text-slate-900' : 'border border-transparent' }}"
                    data-menu-target="submenu-recruiters"
                    aria-expanded="{{ $activeRecruiters ? 'true' : 'false' }}"
                >
                    <span class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 12c1.38 0 2.5-1.12 2.5-2.5S15.63 7 14.25 7 11.75 8.12 11.75 9.5 12.87 12 14.25 12zm-4.25 2.25A4.25 4.25 0 0 0 6 18.5v.25a1.5 1.5 0 0 0 1.5 1.5h9a1.5 1.5 0 0 0 1.5-1.5v-.25a4.25 4.25 0 0 0-4-4.25" />
                        </svg>
                        Recruiters
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" data-chevron class="h-3 w-3 transition-transform duration-200" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m6 8 4 4 4-4" />
                    </svg>
                </button>
                <div id="submenu-recruiters" class="space-y-1 rounded-xl border border-slate-100 bg-slate-50 px-3 py-2 text-sm text-slate-600 shadow-inner shadow-slate-900/5 {{ $activeRecruiters ? 'block' : 'hidden' }}">
                    @foreach ($recruiterMenu as $item)
                        <a
                            href="{{ route($item['route']) }}"
                            class="block rounded-lg px-2 py-1 {{ request()->routeIs($item['pattern']) ? 'bg-slate-900/5 text-slate-900 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}"
                        >
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="space-y-1">
                <button
                    type="button"
                    class="flex w-full items-center justify-between rounded-xl px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 {{ $activeMaster ? 'border border-slate-200 bg-slate-50 text-slate-900' : 'border border-transparent' }}"
                    data-menu-target="submenu-master"
                    aria-expanded="{{ $activeMaster ? 'true' : 'false' }}"
                >
                    <span class="flex items-center gap-2">
                        <svg class="h-4 w-4 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9.25a2.75 2.75 0 1 0 0 5.5 2.75 2.75 0 0 0 0-5.5zm0-2.5V4m0 16v-2.75M4.25 12H2m20 0h-2.25" />
                        </svg>
                        Master Setting
                    </span>
                    <svg xmlns="http://www.w3.org/2000/svg" data-chevron class="h-3 w-3 transition-transform duration-200" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m6 8 4 4 4-4" />
                    </svg>
                </button>
                <div id="submenu-master" class="space-y-1 rounded-xl border border-slate-100 bg-slate-50 px-3 py-2 text-sm text-slate-600 shadow-inner shadow-slate-900/5 {{ $activeMaster ? 'block' : 'hidden' }}">
                    @foreach ($masterMenu as $item)
                        <a
                            href="{{ route($item['route']) }}"
                            class="block rounded-lg px-2 py-1 {{ request()->routeIs($item['pattern']) ? 'bg-slate-900/5 text-slate-900 font-semibold' : 'text-slate-600 hover:bg-slate-50' }}"
                        >
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </div>
            </div>
        </nav>
    </div>

    <div class="mt-10 rounded-xl border border-slate-200/60 bg-slate-50 px-4 py-3 text-sm text-slate-600 shadow-inner shadow-slate-900/5">
        <p class="text-[0.65rem] uppercase tracking-[0.3em] text-slate-400">Need help?</p>
        <p class="mt-2 text-slate-900">Contact the support desk for urgent hiring questions.</p>
        <a href="#" class="mt-3 inline-flex items-center gap-2 text-xs font-semibold text-cyan-500">
            Get assistance
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />
            </svg>
        </a>
    </div>
</aside>