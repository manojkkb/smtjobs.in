@extends('admin.layouts.app')

@section('title', $companyType->label)

@section('content')
<div class="space-y-6">
    <header class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-slate-500">Admin</p>
            <h1 class="text-2xl font-semibold text-slate-900">Company Type Details</h1>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.company-types.edit', 1) }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                Edit Company Type
            </a>
            <a href="{{ route('admin.company-types.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                Back to Company Types
            </a>
        </div>
    </header>
    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-sm text-slate-500">Highlight the most important facts about this Company Type. Extend the list with business-critical attributes.</p>
        <dl class="mt-6 grid gap-5 sm:grid-cols-2">
            <div>
                <dt class="text-xs uppercase tracking-[0.3em] text-slate-500">Name</dt>
                <dd class="mt-2 text-lg font-semibold text-slate-900">Sample Company Type</dd>
            </div>
            <div>
                <dt class="text-xs uppercase tracking-[0.3em] text-slate-500">Code</dt>
                <dd class="mt-2 text-lg font-semibold text-slate-900">SAMPLE</dd>
            </div>
            <div class="sm:col-span-2">
                <dt class="text-xs uppercase tracking-[0.3em] text-slate-500">Description</dt>
                <dd class="mt-2 text-sm text-slate-600">This is a placeholder description. Swap it with live details from the database.</dd>
            </div>
        </dl>
        <p class="mt-5 text-xs text-slate-400">Replace the ID in the links above with a real identifier once the controller returns it.</p>
        <p class="text-xs text-slate-400">{{-- Replace the literal 1 used above with the actual model identifier. --}}</p>
    </section>
</div>
@endsection
