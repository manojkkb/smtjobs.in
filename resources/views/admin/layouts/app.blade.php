<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'SMT Admin · ' . config('app.name', 'Laravel'))</title>

    {{-- Vite CSS + JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#e7e7e7] text-slate-900">

    <div class="relative flex h-screen overflow-hidden bg-[#e7e7e7]">
        <div
            id="sidebarBackdrop"
            class="pointer-events-none fixed inset-0 z-30 hidden bg-slate-900/40 transition-opacity duration-300 lg:hidden"
            aria-hidden="true"
        ></div>

        @include('admin.layouts.sidebar')

        <div class="flex flex-1 flex-col lg:pl-0">
            <header class="sticky top-0 z-20 flex items-center justify-between border-b border-slate-200 bg-white px-4 py-3 shadow-sm lg:hidden">
                <button
                    id="sidebarToggle"
                    class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-1 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                    </svg>
                    Menu
                </button>
                <p class="text-sm font-semibold uppercase tracking-[0.4em] text-slate-500">Admin</p>
                <div class="flex items-center gap-3">
                    <span class="h-8 w-8 rounded-full bg-slate-200"></span>
                    <span class="text-sm font-medium text-slate-600">Hi, Admin</span>
                </div>
            </header>

            <main class="flex-1 overflow-y-auto px-4 py-6 sm:px-6 lg:px-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        (function () {
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            const openBtn = document.getElementById('sidebarToggle');
            const closeBtn = document.getElementById('sidebarClose');

            const hideBackdrop = () => {
                if (!backdrop) return;
                backdrop.classList.add('hidden');
                backdrop.classList.remove('block');
                backdrop.classList.add('pointer-events-none');
                backdrop.classList.remove('pointer-events-auto');
            };

            const showBackdrop = () => {
                if (!backdrop) return;
                backdrop.classList.remove('hidden');
                backdrop.classList.add('block');
                backdrop.classList.remove('pointer-events-none');
                backdrop.classList.add('pointer-events-auto');
            };

            const openSidebar = () => {
                sidebar?.classList.remove('-translate-x-full');
                showBackdrop();
            };

            const closeSidebar = () => {
                sidebar?.classList.add('-translate-x-full');
                hideBackdrop();
            };

            openBtn?.addEventListener('click', openSidebar);
            closeBtn?.addEventListener('click', closeSidebar);
            backdrop?.addEventListener('click', closeSidebar);

            const syncSidebar = () => {
                if (window.innerWidth >= 1024) {
                    hideBackdrop();
                    sidebar?.classList.remove('-translate-x-full');
                } else {
                    sidebar?.classList.add('-translate-x-full');
                }
            };

            window.addEventListener('resize', syncSidebar);
            syncSidebar();

            const submenuButtons = document.querySelectorAll('[data-menu-target]');
            const toggleSubmenu = (button) => {
                const targetId = button.getAttribute('data-menu-target');
                const panel = targetId ? document.getElementById(targetId) : null;
                if (!panel) return;
                const isOpen = button.getAttribute('aria-expanded') === 'true';
                panel.classList.toggle('hidden', isOpen);
                button.setAttribute('aria-expanded', String(!isOpen));
                const chevron = button.querySelector('[data-chevron]');
                chevron?.classList.toggle('rotate-180', !isOpen);
            };

            submenuButtons.forEach((button) => {
                button.addEventListener('click', () => toggleSubmenu(button));
            });
        })();
    </script>
</body>
</html>