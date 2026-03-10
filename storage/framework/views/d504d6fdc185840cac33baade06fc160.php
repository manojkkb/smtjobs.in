

<?php $__env->startSection('title', 'SMTJobs - Find & Apply for Jobs in India | IT & Corporate Hiring'); ?>

<?php $__env->startSection('meta_description', 'Find latest IT, Finance & Corporate jobs in India. Browse 50000+ job openings from verified companies. Apply online today with SMTJobs.'); ?>

<?php $__env->startSection('meta_keywords', 'latest jobs in India, IT jobs India, corporate jobs India'); ?>

<?php $__env->startPush('schema'); ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "SMTJobs",
  "url": "<?php echo e(url('/')); ?>",
  "logo": "<?php echo e(asset('logos/logo.png')); ?>",
  "description": "India's leading job portal connecting talented professionals with top companies",
  "sameAs": [],
  "contactPoint": {
    "@type": "ContactPoint",
    "contactType": "Customer Service",
    "availableLanguage": "English"
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "SMTJobs",
  "url": "<?php echo e(url('/')); ?>",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "<?php echo e(url('/jobs')); ?>?keyword={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="mx-auto w-full max-w-7xl space-y-16 px-4 sm:px-6 lg:px-8">
        <!-- Hero Section with Black & White Design -->
        <section class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-slate-900 via-slate-800 to-black p-6 sm:p-8 lg:p-12 shadow-2xl">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PHBhdGggZD0iTTM2IDE2djI4YTQgNCAwIDAgMS00IDRIMTZhNCA0IDAgMCAxLTQtNFYxNmE0IDQgMCAwIDEgNC00aDhtNCA0aDRtMCA0aDQiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
            
            <div class="relative space-y-6">
                <div class="inline-flex items-center gap-2 rounded-full bg-white px-4 py-2 shadow-lg">
                    <span class="text-2xl">🇮🇳</span>
                    <span class="text-xs font-semibold uppercase tracking-wider text-black">India's Premier Job Portal</span>
                </div>
                
                <div class="space-y-3 max-w-3xl">
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight">
                        Find Your Dream Job in 
                        <span class="text-slate-300">India</span>
                    </h1>
                    <p class="text-base sm:text-lg text-slate-300 leading-relaxed">Discover thousands of verified opportunities from top companies. Smart filters, precise location matching, and better career outcomes.</p>
                </div>

                <?php echo $__env->make('website.components.search', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <!-- Quick Stats -->
                <div class="grid grid-cols-3 gap-3 pt-4">
                    <div class="rounded-2xl bg-white p-3 text-center shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1 hover:bg-slate-50">
                        <p class="text-xl sm:text-2xl font-bold text-black"><?php echo e(number_format($stats['total_jobs'])); ?>+</p>
                        <p class="text-xs text-slate-600 font-medium mt-1">Active Jobs</p>
                    </div>
                    <div class="rounded-2xl bg-white p-3 text-center shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1 hover:bg-slate-50">
                        <p class="text-xl sm:text-2xl font-bold text-black"><?php echo e(number_format($stats['total_companies'])); ?>+</p>
                        <p class="text-xs text-slate-600 font-medium mt-1">Companies</p>
                    </div>
                    <div class="rounded-2xl bg-white p-3 text-center shadow-xl hover:shadow-2xl transition-all hover:-translate-y-1 hover:bg-slate-50">
                        <p class="text-xl sm:text-2xl font-bold text-black"><?php echo e($stats['total_cities']); ?>+</p>
                        <p class="text-xs text-slate-600 font-medium mt-1">Cities</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- For Employers Section -->
        <section class="relative overflow-hidden rounded-[32px] bg-white p-8 lg:p-12 shadow-2xl border-2 border-slate-200">
            <div class="absolute top-0 right-0 w-64 h-64 bg-slate-100 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-slate-50 rounded-full blur-3xl opacity-50"></div>
            
            <div class="relative grid gap-10 lg:grid-cols-2 items-center">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-2 rounded-full bg-black px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-white">For Employers</span>
                    </div>
                    
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black leading-tight">
                        Hire Top Talent <span class="text-slate-600">Faster</span>
                    </h2>
                    
                    <p class="text-lg text-slate-700 leading-relaxed">
                        Connect with skilled professionals actively seeking opportunities. Get quality applications from pre-verified candidates who match your requirements.
                    </p>
                    
                    <div class="flex flex-wrap gap-4 pt-4">
                        <a
                            href="<?php echo e(route('recruiter.job-posts.create')); ?>"
                            class="group inline-flex items-center gap-2 rounded-full bg-black px-8 py-4 text-base font-semibold text-white shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl hover:bg-slate-800"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Post a Job
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        <a
                            href="<?php echo e(route('recruiter.dashboard')); ?>"
                            class="group inline-flex items-center gap-2 rounded-full bg-white border-2 border-black px-8 py-4 text-base font-semibold text-black transition-all hover:-translate-y-1 hover:bg-slate-50 hover:shadow-lg"
                        >
                            Dashboard
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
                
                <div class="grid gap-5 sm:grid-cols-2">
                    <div class="group rounded-3xl bg-white p-6 shadow-lg transition-all hover:-translate-y-2 hover:shadow-2xl border-2 border-slate-200 hover:border-black">
                        <div class="mb-4 inline-flex rounded-2xl bg-black p-3 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-black mb-2">Quality Candidates</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">Access verified professionals with proven skills and experience</p>
                    </div>
                    
                    <div class="group rounded-3xl bg-white p-6 shadow-lg transition-all hover:-translate-y-2 hover:shadow-2xl border-2 border-slate-200 hover:border-black">
                        <div class="mb-4 inline-flex rounded-2xl bg-slate-800 p-3 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-black mb-2">Quick Hiring</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">Post jobs in minutes and receive applications instantly</p>
                    </div>
                    
                    <div class="group rounded-3xl bg-white p-6 shadow-lg transition-all hover:-translate-y-2 hover:shadow-2xl border-2 border-slate-200 hover:border-black">
                        <div class="mb-4 inline-flex rounded-2xl bg-slate-700 p-3 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-black mb-2">Smart Analytics</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">Track performance with real-time insights and metrics</p>
                    </div>
                    
                    <div class="group rounded-3xl bg-white p-6 shadow-lg transition-all hover:-translate-y-2 hover:shadow-2xl border-2 border-slate-200 hover:border-black">
                        <div class="mb-4 inline-flex rounded-2xl bg-slate-600 p-3 shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-black mb-2">Cost Effective</h3>
                        <p class="text-sm text-slate-600 leading-relaxed">Affordable plans for startups to enterprises</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Career Journey Section -->
        <section class="relative overflow-hidden rounded-[32px] bg-gradient-to-br from-slate-100 to-white p-8 lg:p-16 shadow-2xl border-2 border-slate-200">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiMwMDAiIGZpbGwtb3BhY2l0eT0iMC4wMiI+PHBhdGggZD0iTTM2IDE2djI4YTQgNCAwIDAgMS00IDRIMTZhNCA0IDAgMCAxLTQtNFYxNmE0IDQgMCAwIDEgNC00aDhtNCA0aDRtMCA0aDQiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-40"></div>
            
            <div class="relative space-y-10">
                <div class="space-y-6 max-w-3xl">
                    <div class="inline-flex items-center gap-2 rounded-full bg-black px-4 py-2">
                        <span class="text-xs font-bold uppercase tracking-wider text-white">Your Career Path</span>
                    </div>
                    
                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-black leading-tight">
                        Own the next chapter of your 
                        <span class="text-slate-600">professional journey</span>
                    </h2>
                    
                    <p class="text-lg sm:text-xl text-slate-700 leading-relaxed">
                        Discover curated roles with transparent salary bands, work from home options, and career growth opportunities—all in one modern experience.
                    </p>
                </div>
                
                <div class="flex flex-wrap gap-4">
                    <a
                        href="#jobs"
                        class="group inline-flex items-center gap-2 rounded-full bg-black px-8 py-4 text-base font-semibold text-white shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl hover:bg-slate-800"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Browse Jobs
                        <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a
                        href="#resume"
                        class="group inline-flex items-center gap-2 rounded-full bg-white border-2 border-black px-8 py-4 text-base font-semibold text-black transition-all hover:-translate-y-1 hover:bg-slate-50"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Build Resume
                    </a>
                </div>
            </div>
        </section>

        <!-- Trending Jobs Section -->
        <section id="jobs" class="space-y-10">
            <div class="text-center space-y-4">
                <div class="inline-flex items-center gap-2 rounded-full bg-black px-5 py-2 shadow-lg">
                    <span class="text-sm font-bold uppercase tracking-wider text-white">Trending Now</span>
                </div>
                
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black">
                    Roles Companies Are <span class="text-slate-600">Racing to Fill</span>
                </h2>
                
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Discover the hottest opportunities from India's fastest-growing companies
                </p>
                
                <a href="<?php echo e(route('jobs')); ?>" class="inline-flex items-center gap-2 text-base font-semibold text-black hover:text-slate-600 transition group">
                    View all <?php echo e(number_format($stats['total_jobs'])); ?>+ jobs
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
            
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-2">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $trendingJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <article class="group relative flex flex-col gap-6 rounded-3xl border-2 border-slate-200 bg-white p-8 transition-all hover:border-black hover:-translate-y-2 hover:shadow-2xl" itemscope itemtype="https://schema.org/JobPosting">
                        <meta itemprop="datePosted" content="<?php echo e(optional($job->published_at)->toIso8601String() ?? now()->toIso8601String()); ?>">
                        <meta itemprop="validThrough" content="<?php echo e(optional($job->expires_at)->toIso8601String() ?? now()->addMonths(3)->toIso8601String()); ?>">
                        <meta itemprop="employmentType" content="<?php echo e(optional($job->employmentType)->label ?? 'FULL_TIME'); ?>">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($job->company): ?>
                        <div itemprop="hiringOrganization" itemscope itemtype="https://schema.org/Organization" style="display:none;">
                            <meta itemprop="name" content="<?php echo e($job->company->name); ?>">
                            <meta itemprop="url" content="<?php echo e(url('/')); ?>">
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($job->city): ?>
                        <div itemprop="jobLocation" itemscope itemtype="https://schema.org/Place" style="display:none;">
                            <div itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                                <meta itemprop="addressLocality" content="<?php echo e($job->city->name); ?>">
                                <meta itemprop="addressCountry" content="IN">
                            </div>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($job->min_salary && $job->max_salary): ?>
                        <div itemprop="baseSalary" itemscope itemtype="https://schema.org/MonetaryAmount" style="display:none;">
                            <meta itemprop="currency" content="INR">
                            <div itemprop="value" itemscope itemtype="https://schema.org/QuantitativeValue">
                                <meta itemprop="minValue" content="<?php echo e($job->min_salary); ?>">
                                <meta itemprop="maxValue" content="<?php echo e($job->max_salary); ?>">
                                <meta itemprop="unitText" content="YEAR">
                            </div>
                        </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <!-- Job Badge & Meta -->
                        <div class="flex items-center justify-between">
                            <span class="inline-flex items-center gap-2 rounded-full 
                                <?php if($job->is_featured): ?>
                                    bg-black text-white border-2 border-black
                                <?php elseif($job->published_at && $job->published_at->isToday()): ?>
                                    bg-slate-800 text-white border-2 border-slate-800
                                <?php elseif($job->published_at && $job->published_at->diffInDays(now()) <= 3): ?>
                                    bg-slate-700 text-white border-2 border-slate-700
                                <?php else: ?>
                                    bg-slate-100 text-slate-600 border-2 border-slate-200
                                <?php endif; ?>
                                px-4 py-2 text-xs font-bold uppercase tracking-wider shadow-sm">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($job->is_featured): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    Featured
                                <?php elseif($job->published_at && $job->published_at->isToday()): ?>
                                    New Today
                                <?php elseif($job->published_at && $job->published_at->diffInDays(now()) <= 3): ?>
                                    Hiring Fast
                                <?php else: ?>
                                    Open
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </span>
                            
                            <div class="flex items-center gap-2 text-xs font-semibold text-slate-500">
                                <span class="px-3 py-1 rounded-full bg-slate-100 border border-slate-200"><?php echo e(optional($job->employmentType)->label ?? 'Full-time'); ?></span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($job->is_remote): ?>
                                    <span class="px-3 py-1 rounded-full bg-black text-white">Remote</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Job Title & Company -->
                        <div class="space-y-3">
                            <h3 class="text-2xl font-bold text-black group-hover:text-slate-700 transition-colors" itemprop="title">
                                <?php echo e($job->title); ?>

                            </h3>
                            <div class="flex items-center gap-2">
                                <div class="h-10 w-10 rounded-full bg-black flex items-center justify-center text-white font-bold shadow-lg">
                                    <?php echo e(substr(optional($job->company)->name ?? 'C', 0, 1)); ?>

                                </div>
                                <div>
                                    <p class="font-semibold text-slate-900"><?php echo e(optional($job->company)->name ?? 'Company'); ?></p>
                                    <p class="text-sm text-slate-500">
                                        📍 <?php echo e(optional($job->city)->name ?? 'Location'); ?>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($job->min_salary && $job->max_salary): ?>
                                            · ₹<?php echo e(number_format($job->min_salary / 100000, 1)); ?>L - ₹<?php echo e(number_format($job->max_salary / 100000, 1)); ?>L
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Job Description -->
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($job->detail && $job->detail->description): ?>
                            <p class="text-sm text-slate-600 leading-relaxed line-clamp-2" itemprop="description">
                                <?php echo e(Str::limit(strip_tags($job->detail->description), 120)); ?>

                            </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        
                        <!-- Action Footer -->
                        <div class="flex items-center justify-between pt-4 border-t border-slate-100">
                            <a href="<?php echo e(route('job.show', ['city' => $job->city_slug, 'slug' => $job->slug])); ?>" 
                               class="inline-flex items-center gap-2 rounded-full bg-black px-6 py-3 text-sm font-bold text-white shadow-lg transition-all group-hover:-translate-y-1 group-hover:shadow-xl hover:bg-slate-800">
                                Apply Now
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                            <span class="text-xs text-slate-400 font-medium">
                                Posted <?php echo e($job->published_at ? $job->published_at->diffForHumans() : 'recently'); ?>

                            </span>
                        </div>
                    </article>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="col-span-2 rounded-3xl bg-gradient-to-br from-slate-50 to-slate-100 p-16 text-center">
                        <div class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-slate-200 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-700 mb-2">No Jobs Available</h3>
                        <p class="text-slate-500">Check back soon! New opportunities are posted daily.</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </section>

        <!-- Resume Builder Section -->
        <section id="resume" class="relative overflow-hidden rounded-[32px] bg-white p-8 lg:p-12 shadow-2xl border-2 border-slate-200">
            <div class="absolute top-0 right-0 w-96 h-96 bg-slate-100 rounded-full blur-3xl opacity-50"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-slate-50 rounded-full blur-3xl opacity-50"></div>
            
            <div class="relative grid gap-10 lg:grid-cols-2 items-center">
                <div class="space-y-6">
                    <div class="inline-flex items-center gap-2 rounded-full bg-black px-4 py-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span class="text-xs font-bold uppercase tracking-wider text-white">Resume Builder</span>
                    </div>
                    
                    <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black leading-tight">
                        Shape Your Professional <span class="text-slate-600">Story</span>
                    </h2>
                    
                    <p class="text-lg text-slate-700 leading-relaxed">
                        Craft a modern, ATS-friendly resume that highlights your projects, impact, and skills recruiters are looking for.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex items-center gap-2 rounded-2xl bg-slate-50 p-4 shadow-lg border border-slate-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            <span class="text-sm font-semibold text-slate-900">ATS Optimized</span>
                        </div>
                        <div class="flex items-center gap-2 rounded-2xl bg-slate-50 p-4 shadow-lg border border-slate-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            <span class="text-sm font-semibold text-slate-900">Portfolio Links</span>
                        </div>
                        <div class="flex items-center gap-2 rounded-2xl bg-slate-50 p-4 shadow-lg border border-slate-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122" />
                            </svg>
                            <span class="text-sm font-semibold text-slate-900">Quick Setup</span>
                        </div>
                        <div class="flex items-center gap-2 rounded-2xl bg-slate-50 p-4 shadow-lg border border-slate-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                            <span class="text-sm font-semibold text-slate-900">Share Online</span>
                        </div>
                    </div>
                    
                    <a href="#" class="inline-flex items-center gap-3 rounded-full bg-black px-8 py-4 text-base font-bold text-white shadow-xl transition-all hover:-translate-y-1 hover:shadow-2xl hover:bg-slate-800 group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Start Building for Free
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                </div>
                
                <div class="relative rounded-3xl bg-slate-50 p-8 shadow-2xl border-2 border-slate-200">
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div class="inline-flex items-center gap-2 rounded-full bg-black px-4 py-2">
                                <span class="text-xs font-bold uppercase tracking-wider text-white">120+ Templates</span>
                            </div>
                            <div class="flex -space-x-2">
                                <div class="h-8 w-8 rounded-full bg-slate-800 border-2 border-white"></div>
                                <div class="h-8 w-8 rounded-full bg-slate-600 border-2 border-white"></div>
                                <div class="h-8 w-8 rounded-full bg-slate-400 border-2 border-white"></div>
                            </div>
                        </div>
                        
                        <div>
                            <p class="text-4xl font-bold text-black mb-2">Transform Your Career</p>
                            <p class="text-slate-600 leading-relaxed">
                                Choose from professionally designed templates. Add your experience, projects, and skills. Export or share instantly with recruiters.
                            </p>
                        </div>
                        
                        <div class="grid grid-cols-3 gap-3">
                            <div class="rounded-2xl bg-black p-4 shadow-lg">
                                <p class="text-2xl font-bold text-white mb-1">1M+</p>
                                <p class="text-xs text-slate-300 font-medium">Resumes Created</p>
                            </div>
                            <div class="rounded-2xl bg-slate-700 p-4 shadow-lg">
                                <p class="text-2xl font-bold text-white mb-1">4.8★</p>
                                <p class="text-xs text-slate-300 font-medium">User Rating</p>
                            </div>
                            <div class="rounded-2xl bg-slate-500 p-4 shadow-lg">
                                <p class="text-2xl font-bold text-white mb-1">Free</p>
                                <p class="text-xs text-slate-200 font-medium">Forever</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Top Cities Section -->
        <section class="space-y-10">
            <div class="text-center space-y-4">
                <div class="inline-flex items-center gap-2 rounded-full bg-black px-5 py-2 shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="text-sm font-bold uppercase tracking-wider text-white">Top Locations</span>
                </div>
                
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-black">
                    Where India's Best <span class="text-slate-600">Teams Are Hiring</span>
                </h2>
                
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">
                    Explore opportunities across India's fastest-growing tech hubs
                </p>
            </div>
            
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $topCities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <article class="group relative overflow-hidden rounded-3xl bg-white p-8 shadow-lg border-2 border-slate-200 transition-all hover:-translate-y-2 hover:shadow-2xl hover:border-black">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-slate-100 rounded-full blur-2xl group-hover:opacity-100 opacity-0 transition-opacity"></div>
                        
                        <div class="relative space-y-4">
                            <div class="inline-flex items-center justify-center h-12 w-12 rounded-2xl bg-black shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            </div>
                            
                            <div>
                                <p class="text-sm font-semibold uppercase tracking-wider text-slate-500 mb-1"><?php echo e($city->name); ?></p>
                                <p class="text-3xl font-bold text-black">
                                    <?php echo e(number_format($city->job_posts_count)); ?>

                                </p>
                                <p class="text-sm text-slate-600 font-medium mt-1">Active Opportunities</p>
                            </div>
                            
                            <div class="flex items-center gap-2 pt-2">
                                <div class="h-2 w-2 rounded-full bg-black animate-pulse"></div>
                                <span class="text-xs font-semibold text-slate-700">Actively Hiring</span>
                            </div>
                        </div>
                    </article>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <div class="col-span-4 rounded-3xl bg-gradient-to-br from-slate-50 to-slate-100 p-12 text-center">
                        <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-slate-200 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-slate-700 mb-2">No City Data Available</h3>
                        <p class="text-slate-500">City information will be updated soon.</p>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </section>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('website.layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\smtjobs\resources\views/website/home.blade.php ENDPATH**/ ?>