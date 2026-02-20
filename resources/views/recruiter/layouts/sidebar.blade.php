<aside
    id="adminSidebar"
    class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full transform overflow-y-auto border border-slate-200 bg-white px-5 py-7 shadow-lg transition duration-300 lg:static lg:translate-x-0 lg:shadow-none"
>
    <div class="flex items-center justify-between">
        <div>
            <p class="text-lg font-semibold text-slate-900">SMT Recruiter</p>
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
        $menuItems = [
            [
                'label' => 'Dashboard',
                'route' => 'recruiter.dashboard',
                'active' => ['recruiter.dashboard'],
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75 12 3l9 6.75M4.5 10.5v9.75h3.75v-6h6v6h3.75V10.5" />',
            ],
            [
                'label' => 'Jobs',
                'route' => 'recruiter.job-posts.index',
                'active' => ['recruiter.job-posts.*'],
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7" />',
            ],
            [
                'label' => 'Applications',
                'route' => 'recruiter.job-applications',
                'active' => ['recruiter.job-applications'],
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 14s1.5 2 4 2 4-2 4-2" /> <path stroke-linecap="round" stroke-linejoin="round" d="M12 12a4 4 0 100-8 4 4 0 000 8z" />',
            ],
            [
                'label' => 'Interviews',
                'route' => '#',
                'active' => [],
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8 7h8M8 11h8M8 15h4" /> <path stroke-linecap="round" stroke-linejoin="round" d="M5 5h14v14H5z" />',
            ],
            [
                'label' => 'Messages',
                'route' => '#',
                'active' => [],
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 4h16v12H6l-2 2V4z" />',
            ],
            [
                'label' => 'Resume Database',
                'route' => '#',
                'active' => [],
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 11c2.761 0 5-1.12 5-2.5S14.761 6 12 6s-5 1.12-5 2.5S9.239 11 12 11z" /> <path stroke-linecap="round" stroke-linejoin="round" d="M6 18c0-1.657 2.686-3 6-3s6 1.343 6 3" />',
            ],
             [
                'label' => 'Subscription & Billing',
                'route' => '#',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M7 16V4h10v12H7z" /> <path stroke-linecap="round" stroke-linejoin="round" d="M5 20h14" />',
            ],
            [
                'label' => 'Reports',
                'route' => '#',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M4 17h16M8 13V7m4 6v-4m4 4v-2" />',
            ],
            [
                'label' => 'Notifications',
                'route' => '#',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M6 9v.01M6 5v2M18 9v.01M18 5v2" /> <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v5m0 4h.01" /> <path stroke-linecap="round" stroke-linejoin="round" d="M13 17h1.5a1.5 1.5 0 01-3 0H11" />',
            ],
            [
                'label' => 'Settings',
                'route' => '#',
                'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5z" /> <path stroke-linecap="round" stroke-linejoin="round" d="M20.38 10.3l-1.5-.26a6.99 6.99 0 00-.54-1.07l.98-1.1-1.2-1.2-1.1.98a6.99 6.99 0 00-1.07-.54l-.26-1.5h-1.7l-.26 1.5a6.99 6.99 0 00-1.07.54l-1.1-.98-1.2 1.2.98 1.1a6.99 6.99 0 00-.54 1.07l-1.5.26v1.7l1.5.26c.1.38.25.74.45 1.06l-.98 1.1 1.2 1.2 1.1-.98c.32.2.68.35 1.06.45l.26 1.5h1.7l.26-1.5c.38-.1.74-.25 1.06-.45l1.1.98 1.2-1.2-.98-1.1c.2-.32.35-.68.45-1.06l1.5-.26v-1.7z" />',
            ],
        ];

     
    @endphp

    <div class="mt-8 space-y-3">
        <div>
            <nav class="mt-2 text-sm">
                @foreach ($menuItems as $item)
                    @php
                        $activePatterns = $item['active'] ?? [];
                        $isActive = collect($activePatterns)->contains(fn ($pattern) => request()->routeIs($pattern));
                        $url = $item['route'] === '#' ? '#' : route($item['route']);
                    @endphp
                    <a
                        href="{{ $url }}"
                        class="flex items-center gap-2 rounded-xl px-3 py-2 font-semibold transition {{ $isActive ? 'border border-slate-200 bg-slate-50 text-slate-900' : 'text-slate-700 hover:bg-slate-50' }}"
                    >
                        <span class="flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                {!! $item['icon'] !!}
                            </svg>
                            {{ $item['label'] }}
                        </span>
                    </a>
                @endforeach
            </nav>
        </div>


    </div>

    <div class="mt-6 rounded-xl border border-slate-200/60 bg-slate-50 px-4 py-3 text-sm text-slate-600 shadow-inner shadow-slate-900/5">
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