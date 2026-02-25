<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <meta name="theme-color" content="#ffffff" />

    <meta name="google-site-verification" content="wlK6Hnf-df6ux6CKXc9Mmu4RA_ikwVSRggD-63_jWUY" />

    <title><?php echo $__env->yieldContent('title', 'SMTJobs - Latest Jobs in India'); ?></title>

    <meta name="description" content="<?php echo $__env->yieldContent('meta_description', 'Search latest jobs in India on SMTJobs.'); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords', 'latest jobs in India, IT jobs India, corporate jobs India'); ?>">
    <meta name="robots" content="<?php echo $__env->yieldContent('meta_robots', 'index, follow'); ?>">
    <meta name="author" content="SMTJobs">

    <link rel="canonical" href="<?php echo e(url()->current()); ?>">

    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="<?php echo $__env->yieldContent('og_title', 'SMTJobs - Latest Jobs in India'); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('og_description', 'Find IT, Finance & Corporate Jobs in India'); ?>">
    <meta property="og:url" content="<?php echo e(url()->current()); ?>">
    <meta property="og:image" content="<?php echo $__env->yieldContent('og_image', asset('logos/logo.png')); ?>">
    <meta property="og:site_name" content="SMTJobs">

    <!-- Twitter -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo $__env->yieldContent('twitter_title', 'SMTJobs - India Job Portal'); ?>">
    <meta name="twitter:description" content="<?php echo $__env->yieldContent('twitter_description', 'Search jobs and apply online.'); ?>">
    <meta name="twitter:image" content="<?php echo $__env->yieldContent('twitter_image', asset('logos/logo.png')); ?>">

    <?php echo $__env->yieldPushContent('schema'); ?>
    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-['Space_Grotesk'] bg-[#e7e7e7] text-slate-900 antialiased">
    <div class="min-h-screen bg-[#e7e7e7]">
        <?php echo $__env->make('website.layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <main class="relative px-4 pb-16 pt-4 sm:px-6 lg:px-8">
            <?php echo $__env->yieldContent('content'); ?>
        </main>
        <?php echo $__env->make('website.layouts.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('website.components.login-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('website.components.verify-otp-modal', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH D:\smtjobs\resources\views/website/layouts/app.blade.php ENDPATH**/ ?>