<header class="sticky top-0 z-20 flex flex-col gap-3 border-b border-slate-200 bg-white px-4 py-3 shadow-sm transition duration-200 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-6">
	<div class="flex items-center gap-3">
		<button
			type="button"
			id="sidebarToggle"
			aria-label="Toggle menu"
			class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-1 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300"
		>
			<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
				<path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
			</svg>
			Menu
		</button>

		<div class="flex flex-col leading-tight">
			<p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Recruiter Panel</p>
			<p class="text-xs text-slate-400">Access your hiring workspace</p>
		</div>
	</div>

	<div class="flex flex-wrap items-center gap-3">
		<a
			href="{{ route('recruiter.profile') }}"
			class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-sm font-semibold text-slate-600 transition hover:border-slate-300 hover:bg-slate-100"
		>
			<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
				<path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A12 12 0 0112 15c2.02 0 3.943.453 5.657 1.253m.07-.06A9 9 0 1112 3a9 9 0 015.657 14.194z" />
			</svg>
			Profile
		</a>

		<div class="flex items-center gap-3 rounded-full bg-slate-50 px-3 py-1">
			<div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-50 text-emerald-700">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A12 12 0 0112 15c2.02 0 3.943.453 5.657 1.253" />
					<path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
				</svg>
			</div>
			<div class="text-sm leading-tight">
				<p class="font-semibold text-slate-900">{{ optional(auth()->user())->name ?? 'Recruiter' }}</p>
				<p class="text-xs uppercase tracking-wide text-slate-400">Talent partner</p>
			</div>
		</div>
	</div>
</header>
