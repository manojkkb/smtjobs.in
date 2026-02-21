<header class="sticky top-0 z-20 flex flex-row items-center justify-between gap-3 border-b border-slate-200 bg-white px-4 py-3 shadow-sm transition duration-200 sm:px-6 lg:px-6">
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

		<div class="hidden flex-col leading-tight lg:flex lg:flex-col">
			<p class="text-sm font-semibold uppercase tracking-[0.3em] text-slate-500">Recruiter Panel</p>
			<p class="text-xs text-slate-400">Access your hiring workspace</p>
		</div>
	</div>

	<div class="flex items-center gap-3">
		<div class="relative" data-profile-menu>
			<button
				type="button"
				data-profile-menu-button
				aria-controls="recruiterProfileMenu"
				aria-expanded="false"
				class="flex items-center gap-3 rounded-full bg-slate-50 px-3 py-1 text-sm font-semibold tracking-wide text-slate-700 transition hover:border-slate-300 hover:bg-slate-100 focus:outline-none focus:ring-1 focus:ring-slate-300"
			>
				<div class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-50 text-emerald-700">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A12 12 0 0112 15c2.02 0 3.943.453 5.657 1.253" />
						<path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
					</svg>
				</div>
				<div class="flex-1 text-left leading-tight">
					<p class="font-semibold text-slate-900">{{ optional(auth()->user())->name ?? 'Recruiter' }}</p>
					<p class="text-xs uppercase tracking-wide text-slate-400">Talent partner</p>
				</div>
				<svg data-chevron xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-slate-500 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
					<path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
				</svg>
			</button>
			<div
				id="recruiterProfileMenu"
				data-profile-menu-panel
				class="hidden absolute right-0 top-full z-50 mt-2 w-48 origin-top-right rounded-2xl border border-slate-200 bg-white shadow-lg"
			>
				<div class="flex flex-col divide-y divide-slate-100">
					<a
						href="{{ route('recruiter.profile') }}"
						class="block px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
					>
						Profile
					</a>
					<a
						href="#"
						class="block px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
					>
						Settings
					</a>
				</div>
				<form method="POST" action="{{ route('logout') }}" class="border-t border-slate-100">
					@csrf
					<button
						type="submit"
						class="flex w-full items-center gap-2 px-4 py-3 text-sm font-semibold text-rose-600 transition hover:bg-slate-50"
					>
						<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
							<path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7" />
							<path stroke-linecap="round" stroke-linejoin="round" d="M7 8v8" />
						</svg>
						Logout
					</button>
				</form>
			</div>
		</div>
	</div>
</header>

<script>
	(function () {
		const initProfileMenu = () => {
			const container = document.querySelector('[data-profile-menu]');
			if (!container) return;
			const button = container.querySelector('[data-profile-menu-button]');
			const panel = container.querySelector('[data-profile-menu-panel]');
			if (!button || !panel) return;

			const openMenu = () => {
				panel.classList.remove('hidden');
				button.setAttribute('aria-expanded', 'true');
			};

			const closeMenu = () => {
				panel.classList.add('hidden');
				button.setAttribute('aria-expanded', 'false');
			};

			const toggleMenu = (event) => {
				event.stopPropagation();
				if (panel.classList.contains('hidden')) {
					openMenu();
				} else {
					closeMenu();
				}
			};

			button.addEventListener('click', toggleMenu);

			document.addEventListener('click', (event) => {
				if (!container.contains(event.target)) {
					closeMenu();
				}
			});

			document.addEventListener('keydown', (event) => {
				if (event.key === 'Escape') {
					closeMenu();
				}
			});
		};

		if (document.readyState === 'loading') {
			document.addEventListener('DOMContentLoaded', initProfileMenu);
		} else {
			initProfileMenu();
		}
	})();
</script>
