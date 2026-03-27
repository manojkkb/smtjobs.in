{{-- Candidate Navigation Menu --}}
{{-- Desktop Navigation (Top) - Visible on md and up --}}
<div class="hidden md:block border-b border-slate-200 fixed top-0 z-40 shadow-sm w-full bg-white">
    <div class="mx-auto max-w-6xl px-3 sm:px-6 lg:px-8">
        <nav class="flex gap-2 sm:gap-6 lg:gap-8 overflow-x-auto scrollbar-hide py-3 sm:py-4" aria-label="Candidate menu">
            <a href="/" class="group inline-flex flex-row items-center gap-2 border-b-2 border-transparent text-slate-600 hover:border-slate-300 hover:text-slate-900 px-1 text-sm font-semibold transition whitespace-nowrap flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Home</span>
            </a>
            <a href="/#jobs" class="group inline-flex flex-row items-center gap-2 border-b-2 border-transparent text-slate-600 hover:border-slate-300 hover:text-slate-900 px-1 text-sm font-semibold transition whitespace-nowrap flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
                <span>Search</span>
            </a>
            <a href="{{ route('candidate.profile') }}" class="group inline-flex flex-row items-center gap-2 border-b-2 {{ request()->routeIs('candidate.profile') ? 'border-slate-900 text-slate-900' : 'border-transparent text-slate-600 hover:border-slate-300 hover:text-slate-900' }} px-1 text-sm font-semibold transition whitespace-nowrap flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profile</span>
            </a>
            <a href="{{ route('candidate.applied-jobs') }}" class="group inline-flex flex-row items-center gap-2 border-b-2 {{ request()->routeIs('candidate.applied-jobs') ? 'border-slate-900 text-slate-900' : 'border-transparent text-slate-600 hover:border-slate-300 hover:text-slate-900' }} px-1 text-sm font-semibold transition whitespace-nowrap flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span>Applied</span>
            </a>
            <a href="{{ route('candidate.messages') }}" class="group inline-flex flex-row items-center gap-2 border-b-2 {{ request()->routeIs('candidate.messages') ? 'border-slate-900 text-slate-900' : 'border-transparent text-slate-600 hover:border-slate-300 hover:text-slate-900' }} px-1 text-sm font-semibold transition whitespace-nowrap flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <span>Messages</span>
            </a>
            <a href="{{ route('candidate.saved-jobs') }}" class="group inline-flex flex-row items-center gap-2 border-b-2 {{ request()->routeIs('candidate.saved-jobs') ? 'border-slate-900 text-slate-900' : 'border-transparent text-slate-600 hover:border-slate-300 hover:text-slate-900' }} px-1 text-sm font-semibold transition whitespace-nowrap flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                </svg>
                <span>Saved</span>
            </a>
            <a href="{{ route('candidate.settings') }}" class="group inline-flex flex-row items-center gap-2 border-b-2 {{ request()->routeIs('candidate.settings') ? 'border-slate-900 text-slate-900' : 'border-transparent text-slate-600 hover:border-slate-300 hover:text-slate-900' }} px-1 text-sm font-semibold transition whitespace-nowrap flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span>Settings</span>
            </a>
        </nav>
    </div>
</div>

{{-- Mobile Bottom Navigation - Visible below md (hidden when hideBottomNav section is defined) --}}
@if(!View::hasSection('hideBottomNav'))
<div class="md:hidden fixed bottom-0 left-0 right-0 z-50 bg-white border-t border-slate-200 shadow-lg" x-data="{ menuOpen: false }">
    <nav class="flex items-center justify-around py-2 px-2">
        {{-- Home --}}
        <a href="/" class="flex flex-col items-center justify-center py-2 px-3 min-w-0 {{ request()->is('/') ? 'text-slate-900' : 'text-slate-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
            </svg>
            <span class="text-[10px] font-semibold mt-0.5">Home</span>
        </a>

        {{-- Messages --}}
        <a href="{{ route('candidate.messages') }}" class="flex flex-col items-center justify-center py-2 px-3 min-w-0 {{ request()->routeIs('candidate.messages') ? 'text-slate-900' : 'text-slate-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span class="text-[10px] font-semibold mt-0.5">Messages</span>
        </a>

        {{-- Applied --}}
        <a href="{{ route('candidate.applied-jobs') }}" class="flex flex-col items-center justify-center py-2 px-3 min-w-0 {{ request()->routeIs('candidate.applied-jobs') ? 'text-slate-900' : 'text-slate-600' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
            <span class="text-[10px] font-semibold mt-0.5">Applied</span>
        </a>

        {{-- Menu (with dropdown) --}}
        <div class="relative">
            <button @click="menuOpen = !menuOpen" class="flex flex-col items-center justify-center py-2 px-3 min-w-0 {{ request()->routeIs('candidate.profile', 'candidate.saved-jobs', 'candidate.settings') ? 'text-slate-900' : 'text-slate-600' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <span class="text-[10px] font-semibold mt-0.5">Menu</span>
            </button>

            {{-- Dropdown Menu --}}
            <div x-show="menuOpen" 
                 @click.away="menuOpen = false"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform translate-y-2"
                 class="absolute bottom-full right-0 mb-2 w-48 bg-white rounded-xl shadow-xl border border-slate-200 py-2"
                 style="display: none;">
                <a href="{{ route('candidate.profile') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium {{ request()->routeIs('candidate.profile') ? 'text-slate-900 bg-slate-50' : 'text-slate-700 hover:bg-slate-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                    <span>Profile</span>
                </a>
                <a href="{{ route('candidate.saved-jobs') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium {{ request()->routeIs('candidate.saved-jobs') ? 'text-slate-900 bg-slate-50' : 'text-slate-700 hover:bg-slate-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                    </svg>
                    <span>Saved Jobs</span>
                </a>
                <a href="{{ route('candidate.settings') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium {{ request()->routeIs('candidate.settings') ? 'text-slate-900 bg-slate-50' : 'text-slate-700 hover:bg-slate-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span>Settings</span>
                </a>
                <div class="border-t border-slate-200 my-2"></div>
                <a href="/#jobs" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-slate-700 hover:bg-slate-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <span>Search Jobs</span>
                </a>
            </div>
        </div>
    </nav>
</div>
@endif
