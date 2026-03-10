<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="theme-color" content="#ffffff" />

    <title>@yield('title', 'Candidate Dashboard - SMTJobs')</title>

    <meta name="description" content="@yield('meta_description', 'Manage your job applications and profile on SMTJobs.')">
    <meta name="robots" content="noindex, nofollow">
    <meta name="author" content="SMTJobs">

    {{-- Vite CSS + JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    {{-- Alpine.js for interactive components --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    {{-- Alpine.js cloak style --}}
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-['Space_Grotesk'] bg-[#f5f5f5] text-slate-900 antialiasing">
    <div class="min-h-screen bg-[#f5f5f5]">
        @include('candidate.layouts.navigation')
        
        <main>
            @yield('content')
        </main>
    </div>
    @stack('scripts')
</body>
</html>
