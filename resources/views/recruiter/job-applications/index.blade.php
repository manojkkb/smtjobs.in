@extends('recruiter.layouts.app')

@section('title', 'Job Applications')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-semibold text-slate-900">Job Applications</h1>
        <p class="mt-2 text-sm text-slate-600">Review and manage applications from candidates</p>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="border-b border-slate-200 px-6 py-4">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center gap-3">
                    <input
                        type="text"
                        placeholder="Search applications..."
                        class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none sm:w-64"
                    />
                </div>
                <div class="flex gap-3">
                    <select class="rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none">
                        <option>All Status</option>
                        <option>Pending</option>
                        <option>Reviewing</option>
                        <option>Shortlisted</option>
                        <option>Rejected</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="divide-y divide-slate-100">
            <div class="px-6 py-12 text-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-4 text-sm font-semibold text-slate-900">No applications yet</h3>
                <p class="mt-2 text-sm text-slate-500">Applications will appear here once candidates start applying to your job posts.</p>
            </div>
        </div>
    </div>
@endsection
