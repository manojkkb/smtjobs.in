@extends('admin.layouts.app')

@section('title', $workMode->label)

@section('content')
<div class="space-y-6">
    <header class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-slate-500">Admin</p>
            <h1 class="text-2xl font-semibold text-slate-900">{{ $workMode->label }}</h1>
            <p class="text-sm text-slate-500">View the core metadata for this work mode.</p>
        </div>
        <div class="flex flex-wrap gap-2 text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">
            <span>{{ $workMode->is_active ? 'Active' : 'Inactive' }}</span>
            <span>{{ $workMode->sort_order }}</span>
        </div>
    </header>

    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="grid gap-4 md:grid-cols-2">
            <div>
                <p class="text-xs text-slate-500">Slug</p>
                <p class="text-lg font-semibold text-slate-900">{{ $workMode->slug }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-500">Created</p>
                <p class="text-lg font-semibold text-slate-900">{{ $workMode->created_at->format('M j, Y') }}</p>
            </div>
        </div>
        <div class="mt-6 flex flex-wrap gap-2 text-sm font-semibold text-slate-600">
            <a href="{{ route('admin.work-modes.edit', $workMode) }}" class="rounded-2xl border border-slate-200 px-4 py-2 transition hover:bg-slate-50">Edit</a>
            <form action="{{ route('admin.work-modes.destroy', $workMode) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-2xl border border-transparent px-4 py-2 text-rose-600 transition hover:bg-rose-50" onclick="return confirm('Delete this work mode?')">Delete</button>
            </form>
        </div>
    </section>
</div>
@endsection