@extends('admin.layouts.app')

@section('title', $pageTitle)

@section('content')
<div class="space-y-6">
    <header class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-slate-500">Admin</p>
            <h1 class="text-2xl font-semibold text-slate-900">{{ $resourcePlural }}</h1>
            <p class="text-sm text-slate-500">{{ $subtitle ?? 'Review the details for this resource.' }}</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ $backRoute }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-50">
                Back
            </a>
            <a href="{{ route($routeName . '.edit', $record) }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-50">
                Edit
            </a>
        </div>
    </header>

    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <div class="grid gap-6 md:grid-cols-2">
            @foreach ($detailRows as $row)
                <div class="space-y-2 rounded-2xl border border-slate-100 bg-slate-50 p-4">
                    <p class="text-xs uppercase tracking-[0.3em] text-slate-500">{{ $row['label'] }}</p>
                    @if (($row['type'] ?? null) === 'color' && $row['raw_value'])
                        <div class="flex items-center gap-2">
                            <span class="inline-block h-8 w-8 rounded border-2 border-slate-200" style="background-color: {{ $row['raw_value'] }}"></span>
                            <span class="text-sm font-semibold text-slate-900">{{ $row['raw_value'] }}</span>
                        </div>
                    @else
                        <p class="text-sm font-semibold text-slate-900">{{ $row['value'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
</div>
@endsection
