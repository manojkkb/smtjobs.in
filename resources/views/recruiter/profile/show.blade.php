@extends('recruiter.layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="space-y-6">
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="flex flex-col gap-2 px-6 py-5 sm:flex-row sm:items-end sm:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Profile</p>
                    <h1 class="text-2xl font-semibold text-slate-900">Your recruiter presence</h1>
                    <p class="text-sm text-slate-500">Double-check your contact details and keep your account in sync.</p>
                </div>
                <a
                    href="#edit"
                    class="inline-flex items-center gap-2 rounded-full border border-emerald-200 bg-emerald-50 px-4 py-2 text-sm font-semibold text-emerald-600 transition hover:border-emerald-300 hover:bg-emerald-100"
                >
                    <span>Edit profile</span>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5h6M11 9h4M11 13h2" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 21v-6a9 9 0 019-9h6" />
                    </svg>
                </a>
            </div>

            <div class="grid gap-6 border-t border-slate-100 px-6 py-6 md:grid-cols-2">
                <div class="space-y-1">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Name</p>
                    <p class="text-lg font-semibold text-slate-900">{{ optional(auth()->user())->name ?? 'Recruiter Name' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Email</p>
                    <p class="text-lg font-semibold text-slate-900">{{ optional(auth()->user())->email ?? 'recruiter@example.com' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Phone</p>
                    <p class="text-lg font-semibold text-slate-900">{{ optional(auth()->user())->phone ?? 'Not added yet' }}</p>
                </div>
                <div class="space-y-1">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Joined</p>
                    <p class="text-lg font-semibold text-slate-900">
                        {{ optional(optional(auth()->user())->created_at)->format('F j, Y') ?? '—' }}
                    </p>
                </div>
            </div>
        </section>

        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
            <div class="px-6 py-5 border-b border-slate-100">
                <h2 class="text-lg font-semibold text-slate-900">Account summary</h2>
                <p class="text-sm text-slate-500">Use this space to describe how you work with candidates and employers.</p>
            </div>
            <div class="px-6 py-6">
                <p class="text-sm text-slate-700">
                    This account is connected to your recruiter profile, where you can manage job postings, conversations with candidates, and billing details. Update your contact information whenever there is a change to make sure clients and applicants can reach you.
                </p>
            </div>
        </section>
    </div>
@endsection
