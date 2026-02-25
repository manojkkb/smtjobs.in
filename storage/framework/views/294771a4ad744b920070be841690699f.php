<header class="sticky top-0 z-40 border-b border-slate-200 bg-white/90 shadow-sm backdrop-blur" x-data="{ mobileMenuOpen: false }">
	<div class="mx-auto flex max-w-6xl items-center justify-between gap-2 px-3 py-3 sm:gap-4 sm:px-6 sm:py-4 lg:px-8">
		<!-- Left Side: Menu Button + Logo -->
		<div class="flex items-center gap-2 sm:gap-3">
			<button 
				@click="mobileMenuOpen = !mobileMenuOpen"
				class="md:hidden rounded-full border-2 border-slate-200 bg-white p-1.5 text-slate-700 shadow-sm transition hover:border-slate-900 sm:p-2"
			>
				<span class="sr-only">Open menu</span>
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 sm:h-6 sm:w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16" />
				</svg>
			</button>
			
			<a href="/" class="flex shrink-0 items-center gap-2 text-base font-semibold tracking-tight text-slate-900 sm:text-lg">
				<div>
				<! logo image can be placed here if needed, currently using text "S" as a placeholder for the logo.>
					<img src="<?php echo e(asset('logos/logo.png')); ?>" alt="SMTJobs - Find Jobs in India" class="h-7 w-auto sm:h-8">
					<span class="sr-only">SMTJobs - Job Portal India</span>
				</div>
			</a>
		</div>

		<!-- Center: Navigation (Desktop Only) -->
		<nav class="hidden items-center gap-3 text-sm font-semibold text-slate-700 md:flex lg:gap-6">
			<a href="#" class="whitespace-nowrap transition hover:text-slate-900 hover:font-bold">Home</a>
			<a href="#jobs" class="whitespace-nowrap transition hover:text-slate-900 hover:font-bold">Jobs</a>
			<a href="#resume" class="whitespace-nowrap transition hover:text-slate-900 hover:font-bold">Resume Maker</a>
			<a href="#cities" class="whitespace-nowrap transition hover:text-slate-900 hover:font-bold">Cities</a>
		</nav>

		<!-- Right Side: Auth Buttons -->
		<div class="flex items-center gap-2 sm:gap-3">
			<?php if(auth()->guard()->guest()): ?>
				<div class="relative" x-data="{ open: false }">
					<button
						@click="open = !open"
						@click.away="open = false"
						class="flex items-center gap-1.5 rounded-full border-2 border-slate-200 bg-white px-3 py-1.5 text-slate-700 shadow-md transition hover:border-slate-900 hover:shadow-lg sm:gap-2 sm:px-4 sm:py-2 md:px-5"
					>
					<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
						</svg>
						<span class="text-xs font-bold sm:text-sm">Login</span>
					<svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
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
						<div class="py-2">
							<button
								type="button"
								class="flex w-full items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-800 transition hover:bg-blue-50 hover:text-blue-900"
								onclick="openOtpModal('candidate')"
								@click="open = false"
							>
								<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
								</svg>
								Candidate Login
							</button>
							<button
								type="button"
								class="flex w-full items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-800 transition hover:bg-blue-50 hover:text-blue-900"
								onclick="openOtpModal('recruiter')"
								@click="open = false"
							>
								<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
								</svg>
								Recruiter Login
							</button>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php if(auth()->guard()->check()): ?>
				<div class="relative" x-data="{ open: false }">
					<button
						@click="open = !open"
						@click.away="open = false"
						class="flex items-center gap-1.5 rounded-full border-2 border-slate-200 bg-white px-3 py-1.5 text-slate-700 shadow-md transition hover:border-slate-900 hover:shadow-lg sm:gap-2 sm:px-4 sm:py-2 md:px-5"
					>
					<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
						</svg>
						<span class="text-xs font-bold sm:text-sm">Profile</span>
					<svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 sm:h-4 sm:w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
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
							<p class="text-base font-bold text-slate-900"><?php echo e(auth()->user()->name); ?></p>
							<p class="text-sm text-slate-600"><?php echo e(auth()->user()->email ?? auth()->user()->phone); ?></p>
						</div>
						
						<div class="py-2">
							<?php if(auth()->user()->candidate): ?>
								<a href="<?php echo e(route('candidate.profile')); ?>" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-800 transition hover:bg-blue-50 hover:text-blue-900">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
									</svg>
									Candidate Dashboard
								</a>
							<?php endif; ?>

							<?php if(auth()->user()->recruiter): ?>
								<a href="<?php echo e(route('recruiter.dashboard')); ?>" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-800 transition hover:bg-blue-50 hover:text-blue-900">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
									</svg>
									Recruiter Dashboard
								</a>
							<?php endif; ?>

							<form action="<?php echo e(route('logout')); ?>" method="POST" class="mt-2 border-t-2 border-slate-100 pt-2">
								<?php echo csrf_field(); ?>
								<button type="submit" class="flex w-full items-center gap-3 px-4 py-3 text-sm font-bold text-red-600 transition hover:bg-red-50">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
										<path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
									</svg>
									Logout
								</button>
							</form>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<!-- Mobile Menu Backdrop -->
	<div 
		x-show="mobileMenuOpen"
		@click="mobileMenuOpen = false"
		x-transition:enter="transition ease-out duration-300"
		x-transition:enter-start="opacity-0"
		x-transition:enter-end="opacity-100"
		x-transition:leave="transition ease-in duration-200"
		x-transition:leave-start="opacity-100"
		x-transition:leave-end="opacity-0"
		class="md:hidden fixed inset-0 z-40 h-screen w-screen bg-black/50 backdrop-blur-sm"
		x-cloak
	></div>

	<!-- Mobile Menu -->
	<div 
		x-show="mobileMenuOpen"
		x-transition:enter="transition ease-out duration-300"
		x-transition:enter-start="transform -translate-x-full"
		x-transition:enter-end="transform translate-x-0"
		x-transition:leave="transition ease-in duration-200"
		x-transition:leave-start="transform translate-x-0"
		x-transition:leave-end="transform -translate-x-full"
		class="md:hidden fixed inset-y-0 left-0 z-50 h-screen w-72 sm:w-80 bg-white shadow-2xl overflow-y-auto"
		x-cloak
	>
		<div class="h-full flex flex-col">
			<!-- Menu Header -->
			<div class="flex items-center justify-between px-4 py-4 border-b-2 border-slate-200">
				<h2 class="text-lg font-bold text-slate-900">Menu</h2>
				<button 
					@click="mobileMenuOpen = false"
					class="rounded-full p-2 text-slate-700 hover:bg-slate-100 transition"
				>
					<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>
			</div>

			<!-- Menu Content -->
			<div class="flex-1 overflow-y-auto px-4 py-4">
				<!-- Navigation Links -->
				<nav class="space-y-1 mb-4">
					<a href="#" @click="mobileMenuOpen = false" class="block px-4 py-3 text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-900 rounded-lg transition">Home</a>
					<a href="#jobs" @click="mobileMenuOpen = false" class="block px-4 py-3 text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-900 rounded-lg transition">Jobs</a>
					<a href="#resume" @click="mobileMenuOpen = false" class="block px-4 py-3 text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-900 rounded-lg transition">Resume Maker</a>
					<a href="#cities" @click="mobileMenuOpen = false" class="block px-4 py-3 text-base font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-900 rounded-lg transition">Cities</a>
				</nav>

				</nav>

				<!-- Auth Section -->
				<div class="pt-4 border-t-2 border-slate-200 space-y-2">
					<?php if(auth()->guard()->guest()): ?>
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
					<?php endif; ?>

					<?php if(auth()->guard()->check()): ?>
						<div class="rounded-lg border-2 border-slate-200 bg-slate-50 p-4">
							<p class="text-base font-bold text-slate-900"><?php echo e(auth()->user()->name); ?></p>
							<p class="text-sm text-slate-600"><?php echo e(auth()->user()->email ?? auth()->user()->phone); ?></p>
						</div>

						<?php if(auth()->user()->candidate): ?>
							<a href="<?php echo e(route('candidate.profile')); ?>" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-900 rounded-lg transition">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
								</svg>
								Candidate Dashboard
							</a>
						<?php endif; ?>

						<?php if(auth()->user()->recruiter): ?>
							<a href="<?php echo e(route('recruiter.dashboard')); ?>" class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-800 hover:bg-blue-50 hover:text-blue-900 rounded-lg transition">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
								</svg>
								Recruiter Dashboard
							</a>
						<?php endif; ?>

						<form action="<?php echo e(route('logout')); ?>" method="POST" class="pt-2 border-t-2 border-slate-200">
							<?php echo csrf_field(); ?>
							<button type="submit" class="flex w-full items-center gap-3 px-4 py-3 text-sm font-bold text-red-600 hover:bg-red-50 rounded-lg transition">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
								</svg>
								Logout
							</button>
						</form>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</header>
  <?php /**PATH D:\smtjobs\resources\views/website/layouts/navbar.blade.php ENDPATH**/ ?>