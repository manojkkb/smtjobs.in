<header class="sticky top-0 z-40 border-b border-slate-200 bg-white/90 shadow-sm backdrop-blur" x-data="{ mobileMenuOpen: false }">
	<div class="mx-auto flex max-w-6xl items-center justify-between gap-2 px-3 py-3 sm:gap-4 sm:px-6 sm:py-4 lg:px-8">
		<a href="/" class="flex shrink-0 items-center gap-2 text-base font-semibold tracking-tight text-slate-900 sm:text-lg">
			<div>
			<! logo image can be placed here if needed, currently using text "S" as a placeholder for the logo.>
				<img src="{{ asset('logos/logo.png') }}" alt="Site Logo" class="h-7 w-auto sm:h-8">
				<span class="sr-only">Site Name</span>
			</div>
		</a>
		<nav class="hidden items-center gap-3 text-sm font-semibold text-slate-700 md:flex lg:gap-6">
			<a href="#" class="whitespace-nowrap transition hover:text-slate-900 hover:font-bold">Home</a>
			<a href="#jobs" class="whitespace-nowrap transition hover:text-slate-900 hover:font-bold">Jobs</a>
			<a href="#resume" class="whitespace-nowrap transition hover:text-slate-900 hover:font-bold">Resume Maker</a>
			<a href="#cities" class="whitespace-nowrap transition hover:text-slate-900 hover:font-bold">Cities</a>
		</nav>
		<div class="flex items-center gap-2 sm:gap-3">
			@guest
				<button
					type="button"
					class="hidden rounded-full border-2 border-slate-300 px-3 py-1.5 text-xs font-bold text-slate-700 transition hover:border-slate-900 hover:bg-slate-900 hover:text-white md:px-5 md:py-2 md:text-sm lg:inline-flex"
					onclick="openOtpModal('recruiter')"
				>
					Recruiter Login
				</button>
				<button
					type="button"
					class="hidden rounded-full bg-slate-900 px-3 py-1.5 text-xs font-bold text-white shadow-lg transition hover:bg-slate-700 md:px-5 md:py-2 md:text-sm lg:inline-flex"
					onclick="openOtpModal('candidate')"
				>
					Candidate Login
				</button>
				<!-- Mobile Candidate Login Button -->
				<button
					type="button"
					class="lg:hidden rounded-full bg-slate-900 px-3 py-1.5 text-xs font-bold text-white shadow-md transition hover:bg-slate-700 sm:px-4 sm:py-2"
					onclick="openOtpModal('candidate')"
				>
					Login
				</button>
			@endguest

			@auth
				<div class="relative" x-data="{ open: false }">
					<button
						@click="open = !open"
						@click.away="open = false"
						class="flex items-center gap-1.5 rounded-full border-2 border-slate-200 bg-white px-3 py-1.5 text-slate-700 shadow-md transition hover:border-slate-900 hover:shadow-lg sm:gap-2 sm:px-4 sm:py-2 md:px-5"
					>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
						</svg>
						<span class="hidden text-xs font-bold sm:inline sm:text-sm">Profile</span>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
						</svg>
					</button>

					<div
						x-show="open"
						x-transition:enter="transition ease-out duration-100"
						x-transition:enter-start="transform opacity-0 scale-95"
						x-transition:enter-end="transform opacity-100 scale-100"
						x-transition:leave="transition ease-in duration-75"
						x-transition:leave-start="transform opacity-100 scale-100"
						x-transition:leave-end="transform opacity-0 scale-95"
						class="absolute right-0 z-50 mt-2 w-56 origin-top-right rounded-xl border-2 border-slate-200 bg-white shadow-2xl sm:w-64"
						style="display: none;"
					>
						<div class="p-4 border-b-2 border-slate-100">
							<p class="text-base font-bold text-slate-900">{{ auth()->user()->name }}</p>
							<p class="text-sm text-slate-600">{{ auth()->user()->email ?? auth()->user()->phone }}</p>
						</div>
						
						<div class="py-2">
							@if(auth()->user()->candidate)
								<a href="{{ route('candidate.profile') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-800 transition hover:bg-blue-50 hover:text-blue-900">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
										<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
									</svg>
									Candidate Dashboard
								</a>
							@endif

							@if(auth()->user()->recruiter)
								<a href="{{ route('recruiter.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-800 transition hover:bg-blue-50 hover:text-blue-900">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
										<path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
									</svg>
									Recruiter Dashboard
								</a>
							@endif

							<form action="{{ route('logout') }}" method="POST" class="mt-2 border-t-2 border-slate-100 pt-2">
								@csrf
								<button type="submit" class="flex w-full items-center gap-3 px-4 py-3 text-sm font-bold text-red-600 transition hover:bg-red-50">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
										<path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
									</svg>
									Logout
								</button>
							</form>
						</div>
					</div>
				</div>
			@endauth

			<button 
				@click="mobileMenuOpen = !mobileMenuOpen"
				class="md:hidden rounded-full border-2 border-slate-200 bg-white p-1.5 text-slate-700 shadow-sm transition hover:border-slate-900 sm:p-2"
			>
				<span class="sr-only">Open menu</span>
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
				</svg>
			</button>
		</div>
	</div>

	<!-- Mobile Menu -->
	<div 
		x-show="mobileMenuOpen"
		@click.away="mobileMenuOpen = false"
		x-transition:enter="transition ease-out duration-200"
		x-transition:enter-start="opacity-0 transform -translate-y-2"
		x-transition:enter-end="opacity-100 transform translate-y-0"
		x-transition:leave="transition ease-in duration-150"
		x-transition:leave-start="opacity-100 transform translate-y-0"
		x-transition:leave-end="opacity-0 transform -translate-y-2"
		class="md:hidden border-t-2 border-slate-200 bg-white shadow-lg"
		style="display: none;"
	>
		<div class="mx-auto max-w-6xl px-3 py-3 space-y-2 sm:px-4 sm:py-4 sm:space-y-3">
			<!-- Navigation Links -->
			<nav class="flex flex-col space-y-2">
				<a href="#" class="block px-4 py-3 text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-900 rounded-lg transition">Home</a>
				<a href="#jobs" class="block px-4 py-3 text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-900 rounded-lg transition">Jobs</a>
				<a href="#resume" class="block px-4 py-3 text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-900 rounded-lg transition">Resume Maker</a>
				<a href="#cities" class="block px-4 py-3 text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-900 rounded-lg transition">Cities</a>
			</nav>

			<div class="pt-3 border-t-2 border-slate-200 space-y-2">
				@guest
					<button
						type="button"
						class="w-full rounded-lg border-2 border-slate-300 px-4 py-3 text-sm font-bold text-slate-700 transition hover:border-slate-500 hover:bg-slate-50"
						onclick="openOtpModal('recruiter'); document.querySelector('[x-data]').mobileMenuOpen = false"
					>
						Recruiter Login
					</button>
					<button
						type="button"
						class="w-full rounded-lg bg-slate-900 px-4 py-3 text-sm font-bold text-white shadow-lg transition hover:bg-slate-800"
						onclick="openOtpModal('candidate'); document.querySelector('[x-data]').mobileMenuOpen = false"
					>
						Candidate Login
					</button>
				@endguest

				@auth
					<div class="rounded-lg border-2 border-slate-200 bg-slate-50 p-4">
						<p class="text-base font-bold text-slate-900">{{ auth()->user()->name }}</p>
						<p class="text-sm text-slate-600">{{ auth()->user()->email ?? auth()->user()->phone }}</p>
					</div>

					@if(auth()->user()->candidate)
						<a href="{{ route('candidate.profile') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-900 rounded-lg transition">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
							</svg>
							Candidate Dashboard
						</a>
					@endif

					@if(auth()->user()->recruiter)
						<a href="{{ route('recruiter.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-900 rounded-lg transition">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
							</svg>
							Recruiter Dashboard
						</a>
					@endif

					<form action="{{ route('logout') }}" method="POST" class="pt-2 border-t-2 border-slate-200">
						@csrf
						<button type="submit" class="flex w-full items-center gap-3 px-4 py-3 text-sm font-bold text-red-600 hover:bg-red-50 rounded-lg transition">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
								<path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
							</svg>
							Logout
						</button>
					</form>
				@endauth
			</div>
		</div>
	</div>
</header>
  