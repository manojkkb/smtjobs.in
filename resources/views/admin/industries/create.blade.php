@extends('admin.layouts.app')

@section('title', 'Create Industry')

@section('content')
<div class="space-y-6">
    <header class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-slate-500">Admin</p>
            <h1 class="text-2xl font-semibold text-slate-900">Create Industry</h1>
            <p class="text-sm text-slate-500">Use this form to add a new industry to the master list.</p>
        </div>
        <a href="{{ route('admin.industries.index') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-300 bg-slate-50 px-4 py-2 text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
            Back to Industries
        </a>
    </header>

    <section class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <form action="{{ route('admin.industries.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-sm font-medium text-slate-600" for="label">Label</label>
                    <input
                        id="label"
                        name="label"
                        type="text"
                        value="{{ old('label') }}"
                        required
                        placeholder="Ex. Financial Services"
                        class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-slate-400 focus:outline-none"
                    >
                    @error('label')
                        <p class="mt-1 text-xs text-rose-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="text-sm font-medium text-slate-600" for="sort_order">Sort order</label>
                    <input
                        id="sort_order"
                        name="sort_order"
                        type="number"
                        value="{{ old('sort_order', 0) }}"
                        class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-slate-400 focus:outline-none"
                    >
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="text-sm font-medium text-slate-600" for="description">Description</label>
                    <textarea id="description" name="description" rows="3" class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-slate-400 focus:outline-none" placeholder="Describe the industry">{{ old('description') }}</textarea>
                </div>
                <div>
                    <p class="text-xs text-slate-400">Icon and SEO fields are managed internally.</p>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <label class="inline-flex items-center gap-2 text-sm font-medium text-slate-600">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" class="h-4 w-4 rounded border-slate-300 text-slate-900" @checked(old('is_active', true))>
                    Active
                </label>
            </div>

            <div class="flex flex-wrap gap-3">
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                    Save Industry
                </button>
                <button type="reset" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-5 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                    Reset
                </button>
            </div>
        </form>
    </section>
</div>
@endsection
