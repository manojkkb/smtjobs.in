<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta name="google-site-verification" content="wlK6Hnf-df6ux6CKXc9Mmu4RA_ikwVSRggD-63_jWUY" />

    <title>@yield('title', 'SMTJobs  Latest Jobs in India')</title>

    <meta name="description" content="@yield('meta_description', 'Search latest jobs in India on SMTJobs.')">
    <meta name="keywords" content="@yield('meta_keywords', 'latest jobs in India, IT jobs India, corporate jobs India')">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', 'SMTJobs - Latest Jobs in India')">
    <meta property="og:description" content="@yield('og_description', 'Find IT, Finance & Corporate Jobs in India')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('logos/logo.png'))">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('twitter_title', 'SMTJobs - India Job Portal')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Search jobs and apply online.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('logos/logo.png'))">

    @stack('schema')
    {{-- Vite CSS + JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Alpine.js for dropdown functionality --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    {{-- Alpine.js cloak style --}}
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-['Space_Grotesk'] bg-[#e7e7e7] text-slate-900 antialiased">
    <div class="min-h-screen bg-[#e7e7e7]">
        @include('website.layouts.navbar')
        <main class="relative px-4 pb-16 pt-4 sm:px-6 lg:px-8">
            @yield('content')
        </main>
        @include('website.layouts.footer')
        @include('website.components.login-modal')
        @include('website.components.verify-otp-modal')
    </div>
    @stack('scripts')
</body>
</html>