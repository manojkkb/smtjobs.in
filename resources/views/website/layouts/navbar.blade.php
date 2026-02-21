<header class="sticky top-0 z-40 border-b border-slate-200 bg-white/90 shadow-sm backdrop-blur">
	<div class="mx-auto flex max-w-6xl items-center justify-between gap-4 px-4 py-4 sm:px-6 lg:px-0">
		<a href="/" class="flex items-center gap-2 text-lg font-semibold tracking-tight text-slate-900">
			<div>
			<! logo image can be placed here if needed, currently using text "S" as a placeholder for the logo.>
				<img src="{{ asset('logos/logo.png') }}" alt="Site Logo" class="h-8 w-auto">
				<span class="sr-only">Site Name</span>
			</div>
		</a>
		<nav class="hidden items-center gap-4 text-sm font-medium text-slate-600 md:flex">
			<a href="#" class="transition hover:text-slate-900">Home</a>
			<a href="#jobs" class="transition hover:text-slate-900">Jobs</a>
			<a href="#resume" class="transition hover:text-slate-900">Resume Maker</a>
			<a href="#cities" class="transition hover:text-slate-900">Cities</a>
		</nav>
		<div class="flex items-center gap-3">
			
			<button
				type="button"
				class="hidden rounded-full border border-slate-300 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:border-slate-500 hover:text-slate-900 md:inline-flex"
				onclick="openOtpModal('recruiter')"
			>
				Recruiter Login
			</button>
			<button
				type="button"
				class="rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800"
				onclick="openOtpModal('candidate')"
			>
				Candidate Login
			</button>
			<button class="md:hidden rounded-full border border-slate-200 bg-white p-2 text-slate-700 shadow-sm">
				<span class="sr-only">Open menu</span>
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
				</svg>
			</button>
		</div>
	</div>
</header>
  