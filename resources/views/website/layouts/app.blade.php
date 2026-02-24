<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>@yield('title', 'SMT Jobs · ' . config('app.name', 'Laravel'))</title>

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