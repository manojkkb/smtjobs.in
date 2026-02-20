@extends('admin.layouts.app')

@section('title', 'Edit Notice Period')

@section('content')
<div class="space-y-6">
    <header class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-slate-500">Admin</p>
            <h1 class="text-2xl font-semibold text-slate-900">Edit Notice Period</h1>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.notice-periods.show', 1) }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                View details
            </a>
            <a href="{{ route('admin.notice-periods.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                Back to Notice Periods
            </a>
        </div>
    </header>
    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <p class="text-sm text-slate-500">Update the fields for the selected Notice Period and submit to persist changes.</p>
        <form action="{{ route('admin.notice-periods.update', 1) }}" method="POST" class="mt-6 space-y-5">
            @csrf
            @method('PATCH')
            <div class="grid gap-4 sm:grid-cols-2">
                <div class="space-y-1">
                    <label class="text-sm font-medium text-slate-600" for="name">Name</label>
                    <input id="name" name="name" type="text" value="Sample Notice Period" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-slate-400 focus:outline-none" required>
                </div>
                <div class="space-y-1">
                    <label class="text-sm font-medium text-slate-600" for="code">Code</label>
                    <input id="code" name="code" type="text" value="SAMPLE" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-slate-400 focus:outline-none">
                </div>
            </div>
            <div class="space-y-1">
                <label class="text-sm font-medium text-slate-600" for="description">Description</label>
                <textarea id="description" name="description" rows="3" class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-slate-400 focus:outline-none">Placeholder description for this Notice Period.</textarea>
            </div>
            <div class="flex flex-wrap gap-3">
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Update Notice Period</button>
                <button type="reset" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">Reset</button>
            </div>
            {{-- Replace the placeholder values with data from the model. --}}
        </form>
    </section>
</div>
@endsection
