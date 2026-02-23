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

        @include('recruiter.layouts.sidebar')

        <div id="mainContent" class="flex flex-1 flex-col transition-all duration-300">
            @include('recruiter.layouts.header')

            <main class="flex-1 overflow-y-auto px-4 py-6 sm:px-6 lg:px-8">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('adminSidebar');
            const backdrop = document.getElementById('sidebarBackdrop');
            const mainContent = document.getElementById('mainContent');
            const openBtn = document.getElementById('sidebarToggle');
            const closeBtn = document.getElementById('sidebarClose');
            
            let isDesktopCollapsed = false;

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

            const updateMainContentPadding = () => {
                if (window.innerWidth >= 1024) {
                    const isHidden = sidebar?.classList.contains('-translate-x-full');
                    if (isHidden) {
                        mainContent?.classList.remove('lg:pl-64');
                    } else {
                        mainContent?.classList.add('lg:pl-64');
                    }
                } else {
                    mainContent?.classList.remove('lg:pl-64');
                }
            };

            const openSidebar = () => {
                sidebar?.classList.remove('-translate-x-full');
                if (window.innerWidth < 1024) {
                    showBackdrop();
                }
                updateMainContentPadding();
            };

            const closeSidebar = () => {
                sidebar?.classList.add('-translate-x-full');
                hideBackdrop();
                updateMainContentPadding();
            };

            const toggleSidebar = () => {
                const isHidden = sidebar?.classList.contains('-translate-x-full');
                if (window.innerWidth >= 1024) {
                    isDesktopCollapsed = !isDesktopCollapsed;
                    if (isDesktopCollapsed) {
                        closeSidebar();
                    } else {
                        openSidebar();
                    }
                } else {
                    if (isHidden) {
                        openSidebar();
                    } else {
                        closeSidebar();
                    }
                }
            };

            openBtn?.addEventListener('click', toggleSidebar);
            closeBtn?.addEventListener('click', closeSidebar);
            backdrop?.addEventListener('click', closeSidebar);

            const syncSidebar = () => {
                if (window.innerWidth >= 1024) {
                    hideBackdrop();
                    if (!isDesktopCollapsed) {
                        sidebar?.classList.remove('-translate-x-full');
                    }
                } else {
                    sidebar?.classList.add('-translate-x-full');
                    isDesktopCollapsed = false;
                }
                updateMainContentPadding();
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
        });
    </script>
</body>
</html>