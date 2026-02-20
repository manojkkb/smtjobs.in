@extends('website.layouts.app')

@section('title', 'Join as a candidate · SMTJobs')

@section('content')
    @php
        $registerUrl = route('candidate.register');
        $submitUrl = route('candidate.register.submit');
    @endphp

    <div class="mx-auto max-w-5xl space-y-8">
        <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="space-y-2">
                <p class="text-xs uppercase tracking-[0.5em] text-slate-400">Candidate registration</p>
                <h1 class="text-3xl font-semibold text-slate-900">Create your SMTJobs profile</h1>
                <p class="text-sm text-slate-500">Share the dynamic link below whenever you want to invite someone to register as a candidate.</p>
            </div>
            <div class="mt-4 rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-600">
                <p class="font-semibold text-slate-900">Public form URL</p>
                <p class="font-mono text-xs text-slate-500">{{ $registerUrl }}</p>
                <p class="mt-1 text-xs text-slate-400">This link always points to the latest candidate registration details.</p>
            </div>
        </section>

        <section class="grid gap-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="space-y-2">
                <p class="text-xs uppercase tracking-[0.5em] text-slate-400">Tell us about yourself</p>
                <h2 class="text-2xl font-semibold text-slate-900">We will use these details to build your profile</h2>
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
                            placeholder="e.g. Anika Fernando"
                            required
                        />
                    </label>
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Phone or email</span>
                        <input
                            type="text"
                            name="identifier"
                            value="{{ old('identifier') }}"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            placeholder="Phone number or email"
                            required
                        />
                    </label>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Current role</span>
                        <input
                            type="text"
                            name="role"
                            value="{{ old('role') }}"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            placeholder="Current position"
                        />
                    </label>
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Location</span>
                        <input
                            type="text"
                            name="location"
                            value="{{ old('location') }}"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            placeholder="City, state or remote"
                        />
                    </label>
                </div>
                <div class="space-y-2 text-sm text-slate-600">
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Tell us about your goals</span>
                        <textarea
                            name="notes"
                            rows="4"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            placeholder="Share what you are looking for"
                        >{{ old('notes') }}</textarea>
                    </label>
                </div>
                <div class="space-y-2">
                    <p class="text-xs text-slate-400">You can always update this information later from your candidate dashboard.</p>
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