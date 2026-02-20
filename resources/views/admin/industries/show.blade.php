@extends('admin.layouts.app')

@section('title', $industry->label)

@section('content')
<div class="space-y-6">
    <header class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-slate-500">Admin</p>
            <h1 class="text-2xl font-semibold text-slate-900">{{ $industry->label }} details</h1>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.industries.edit', $industry) }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                Edit
            </a>
            <a href="{{ route('admin.industries.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                Back to list
            </a>
        </div>
    </header>

    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-slate-500">Slug</p>
                <p class="mt-2 text-lg font-semibold text-slate-900">{{ $industry->slug }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-slate-500">Sort order</p>
                <p class="mt-2 text-lg font-semibold text-slate-900">{{ $industry->sort_order }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-slate-500">Status</p>
                <p class="mt-2 text-lg font-semibold text-slate-900">{{ $industry->is_active ? 'Active' : 'Inactive' }}</p>
            </div>
            <div>
                <p class="text-xs uppercase tracking-[0.4em] text-slate-500">Created</p>
                <p class="mt-2 text-lg font-semibold text-slate-900">{{ $industry->created_at->format('M j, Y · g:ia') }}</p>
            </div>
        </div>

        <div class="mt-6">
            <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Description</p>
            <p class="mt-2 text-base text-slate-700">{{ $industry->description ?? 'No description provided.' }}</p>
        </div>

        <div class="mt-6">
            <p class="text-xs uppercase tracking-[0.3em] text-slate-500">Notes</p>
            <p class="mt-2 text-sm text-slate-700">This resource currently tracks only the label, description, sort order, and activation state.</p>
        </div>
    </section>
</div>
@endsection
