@extends('admin.layouts.app')

@section('title', 'Create Company Type')

@section('content')
<div class="space-y-6">
    <header class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-slate-500">Admin</p>
            <h1 class="text-2xl font-semibold text-slate-900">Create Company Type</h1>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.company-types.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                Back to Company Types
            </a>
        </div>
    </header>
    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-sm text-slate-500">Use this form to capture data for a new Company Type. Add more fields or validation based on your model.</p>
        <form action="{{ route('admin.company-types.store') }}" method="POST" class="mt-6 space-y-5">
            @csrf
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="space-y-1">
                    <label class="text-sm font-medium text-slate-600" for="name">Name</label>
                    <input id="name" name="name" type="text" placeholder="Enter Company Type name" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-slate-400 focus:outline-none" required>
                </div>
                <div class="space-y-1">
                    <label class="text-sm font-medium text-slate-600" for="code">Code</label>
                    <input id="code" name="code" type="text" placeholder="Short code or abbreviation" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-slate-400 focus:outline-none">
                </div>
            </div>
            <div class="space-y-1">
                <label class="text-sm font-medium text-slate-600" for="description">Description</label>
                <textarea id="description" name="description" rows="3" placeholder="Describe what this Company Type represents" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-slate-400 focus:outline-none"></textarea>
            </div>
            <div class="flex flex-wrap gap-3">
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Save Company Type</button>
                <button type="reset" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Reset</button>
            </div>
            {{-- Add any additional inputs or validation messages here once the model is wired. --}}
        </form>
    </section>
</div>
@endsection
