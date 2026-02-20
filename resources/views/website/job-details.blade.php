@extends('website.layouts.app')

@section('title', 'Job detail | SMTJobs')

@section('content')
    @php
        $job = [
            'title' => 'Senior Product Designer',
            'company' => 'Lanka Labs',
            'location' => 'Colombo · Hybrid',
            'type' => 'Full-time · Leadership',
            'salary' => 'LKR 380k - 470k',
            'experience' => '6+ years',
            'posted' => 'Posted 3 days ago',
            'badge' => 'Hiring now',
        ];

        $sections = [
            ['heading' => 'Role overview', 'content' => 'You will shape the next generation of fintech dashboards, balancing clarity, delight, and measurable impact while mentoring a team of designers and working closely with product and data leads.'],
            ['heading' => 'What you will do', 'items' => ['Lead multidisciplinary discovery and prototyping sprints.', 'Translate complex data models into intuitive products.', 'Coach mid-senior designers and uplift the craft of the team.', 'Partner with engineering to ship pixel-perfect experiences.']],
            ['heading' => 'What we look for', 'items' => ['6+ years in product design with enterprise SaaS experience.', 'Strong sense of visual systems and component-based thinking.', 'Experience managing stakeholders across design, product, and analytics.', 'Portfolio demonstrating measurable outcomes.']],
        ];

        $perks = ['Flexible hours', 'Quarterly learning stipend', 'Health coverage', 'Wellness retreats', 'Home office budget'];
        $companyHighlights = [
            ['label' => 'Team size', 'value' => '12 cross-functional designers'],
            ['label' => 'Product', 'value' => 'Fintech insights platform'],
            ['label' => 'Location', 'value' => 'Hybrid · Colombo 7 hub'],
        ];
        $cultureNotes = ['Ownership of measurable product outcomes', 'Collaborative critique rituals', 'Pairing with analytics and research teams', 'Monthly learning stipend + book budget'];
        $processSteps = [
            ['title' => 'Apply', 'detail' => 'Share your CV, portfolio, and a short note about your favorite product problem.'],
            ['title' => 'Meet leadership', 'detail' => 'One conversation with product and design leadership to align on impact and culture.'],
            ['title' => 'Deep dive', 'detail' => 'A live design exercise focused on analytics dashboards followed by a debrief.'],
            ['title' => 'Offer', 'detail' => 'We send a thoughtful offer within 3 days of the final interview.'],
        ];
        $similarJobs = [
            ['title' => 'Staff Product Designer', 'company' => 'Ceylon Creative', 'location' => 'Colombo · Hybrid', 'posted' => 'Posted 5 days ago'],
            ['title' => 'Senior UX Researcher', 'company' => 'Respira Labs', 'location' => 'Galle · Remote', 'posted' => 'Posted 3 days ago'],
            ['title' => 'Design Systems Lead', 'company' => 'Synthetix', 'location' => 'Kandy · Onsite', 'posted' => 'Posted 1 week ago'],
        ];
    @endphp

    <div class="mx-auto max-w-6xl space-y-10 px-4 pb-16 sm:px-6 lg:px-0">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-lg shadow-slate-900/5 lg:p-10">
            <div class="flex flex-col gap-2 text-center lg:text-left">
                <p class="text-xs uppercase tracking-[0.4em] text-slate-400">{{ $job['badge'] }}</p>
                <h1 class="text-4xl font-semibold text-slate-900">{{ $job['title'] }}</h1>
                <p class="text-lg text-slate-500">{{ $job['company'] }} · {{ $job['location'] }}</p>
            </div>
            <div class="mt-6 grid gap-4 border-t border-b border-slate-100 py-6 text-sm text-slate-600 md:grid-cols-4 text-center md:text-left">
                <span class="font-semibold text-slate-900">{{ $job['type'] }}</span>
                <span>{{ $job['salary'] }}</span>
                <span>{{ $job['experience'] }} experience</span>
                <span class="text-xs uppercase tracking-[0.4em] text-slate-400">{{ $job['posted'] }}</span>
            </div>
            <div class="mt-6 grid gap-3 sm:grid-cols-2">
                <a href="#" class="w-full rounded-2xl bg-slate-900 px-6 py-3 text-center text-sm font-semibold text-white transition hover:-translate-y-0.5">
                    Apply job
                </a>
                <button class="w-full rounded-2xl border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-900 transition hover:border-slate-400">
                    Save job
                </button>
                <button class="w-full rounded-2xl border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-900 transition hover:border-slate-400">
                    Report
                </button>
                <button class="w-full rounded-2xl border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-900 transition hover:border-slate-400">
                    Share
                </button>
            </div>
            <div class="mt-6 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($companyHighlights as $highlight)
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/80 px-4 py-3 text-sm text-slate-700">
                        <p class="text-xs uppercase tracking-[0.4em] text-slate-400">{{ $highlight['label'] }}</p>
                        <p class="mt-1 font-semibold text-slate-900">{{ $highlight['value'] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="grid gap-6 lg:grid-cols-[0.85fr_0.6fr]">
            <div class="space-y-10 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm shadow-slate-900/5">
                @foreach ($sections as $block)
                    <div class="space-y-4">
                        <h2 class="text-2xl font-semibold text-slate-900">{{ $block['heading'] }}</h2>
                        @if (isset($block['content']))
                            <p class="text-sm text-slate-600">{{ $block['content'] }}</p>
                        @endif
                        @if (isset($block['items']))
                            <ul class="space-y-3 text-sm text-slate-600">
                                @foreach ($block['items'] as $item)
                                    <li class="flex items-start gap-2">
                                        <span class="mt-1 h-2 w-2 rounded-full bg-slate-900"></span>
                                        <span>{{ $item }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
                <div class="space-y-4 rounded-2xl border border-slate-200 bg-slate-50/70 p-6">
                    <h3 class="text-xs uppercase tracking-[0.4em] text-slate-400">Why you’ll love this role</h3>
                    <div class="grid gap-3 text-sm text-slate-600 sm:grid-cols-2">
                        @foreach ($cultureNotes as $note)
                            <p class="rounded-2xl border border-slate-200 bg-white px-4 py-3 font-semibold text-slate-900">{{ $note }}</p>
                        @endforeach
                    </div>
                    <p class="text-sm text-slate-500">You will shape product outcomes, mentor the craft, and collaborate with research, analytics, and engineering while the leadership team clears the runway for your ideas.</p>
                </div>
                <div class="space-y-4 rounded-2xl border border-slate-200 bg-white/70 p-6 text-sm text-slate-500">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Interview process</p>
                    <ol class="space-y-3 text-slate-700">
                        @foreach ($processSteps as $step)
                            <li class="flex flex-col gap-1 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3">
                                <p class="text-sm font-semibold text-slate-900">{{ $step['title'] }}</p>
                                <p class="text-sm text-slate-500">{{ $step['detail'] }}</p>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <aside class="space-y-4 rounded-3xl border border-slate-200 bg-gradient-to-b from-slate-900/5 to-white p-6 text-sm">
                <h3 class="text-xs uppercase tracking-[0.4em] text-slate-400">Similar jobs</h3>
                <div class="space-y-3">
                    @foreach ($similarJobs as $similar)
                        <div class="rounded-2xl border border-slate-100 bg-white/80 p-4">
                            <p class="text-sm font-semibold text-slate-900">{{ $similar['title'] }}</p>
                            <p class="text-xs uppercase tracking-[0.3em] text-slate-400">{{ $similar['company'] }}</p>
                            <p class="text-xs text-slate-500">{{ $similar['location'] }}</p>
                            <p class="text-xs font-semibold text-slate-900">{{ $similar['posted'] }}</p>
                        </div>
                    @endforeach
                </div>
            </aside>
        </section>
    </div>
@endsection