@extends('website.layouts.app')

@section('title', 'Recruiter sign-up · SMTJobs')

@section('content')
    @php
        $registerUrl = route('recruiter.register');
        $submitUrl = route('recruiter.register.submit');
    @endphp

    <div class="mx-auto max-w-5xl space-y-8">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="space-y-2">
                <p class="text-xs uppercase tracking-[0.5em] text-slate-400">Recruiter onboarding</p>
                <h1 class="text-3xl font-semibold text-slate-900">List jobs and manage candidates</h1>
                <p class="text-sm text-slate-500">Send this dynamic link to hiring managers or internal teams whenever you need a fresh recruiter account.</p>
            </div>
            <div class="mt-4 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                <p class="font-semibold text-slate-900">Public form URL</p>
                <p class="font-mono text-xs text-slate-500">{{ $registerUrl }}</p>
                <p class="mt-1 text-xs text-slate-400">This link always reflects the latest recruiter onboarding workflow.</p>
            </div>
        </section>

        <section class="grid gap-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="space-y-2">
                <p class="text-xs uppercase tracking-[0.5em] text-slate-400">Team details</p>
                <h2 class="text-2xl font-semibold text-slate-900">Tell us how you hire</h2>
            </div>
            <form action="{{ $submitUrl }}" method="POST" class="space-y-5">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Full name</span>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            placeholder="e.g. Priyantha de Silva"
                            required
                        />
                    </label>
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Company</span>
                        <input
                            type="text"
                            name="company"
                            value="{{ old('company') }}"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            placeholder="Company or agency name"
                        />
                    </label>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Email or phone</span>
                        <input
                            type="text"
                            name="identifier"
                            value="{{ old('identifier') }}"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            placeholder="Contact method for verification"
                            required
                        />
                    </label>
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">City / region</span>
                        <input
                            type="text"
                            name="location"
                            value="{{ old('location') }}"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            placeholder="City or remote"
                        />
                    </label>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Hiring volume</span>
                        <input
                            type="text"
                            name="hiring_volume"
                            value="{{ old('hiring_volume') }}"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            placeholder="e.g. 30+ roles / quarter"
                        />
                    </label>
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Team size</span>
                        <input
                            type="text"
                            name="team_size"
                            value="{{ old('team_size') }}"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            placeholder="Number of recruiters"
                        />
                    </label>
                </div>
                <div class="space-y-2 text-sm text-slate-600">
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Hiring needs</span>
                        <textarea
                            name="notes"
                            rows="4"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            placeholder="Share what roles or challenges you are hiring for"
                        >{{ old('notes') }}</textarea>
                    </label>
                </div>
                <div class="space-y-2">
                    <p class="text-xs text-slate-400">We will use this info to prioritise your recruiter dashboard experience.</p>
                    <button
                        type="submit"
                        class="w-full rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
                    >
                        Continue to verification
                    </button>
                </div>
            </form>
        </section>
    </div>
@endsection