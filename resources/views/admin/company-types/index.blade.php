@extends('admin.layouts.app')

@section('title', 'Company Types')

@section('content')
@php
    $sortColumn = request('sort', 'sort_order');
    $sortDirection = request('direction', 'desc');
    $baseFilters = request()->except(['sort', 'direction', 'page']);
    $nextDirection = fn ($column) => $sortColumn === $column && $sortDirection === 'asc' ? 'desc' : 'asc';
    $indicator = fn ($column) => $sortColumn === $column ? ($sortDirection === 'asc' ? '↑' : '↓') : '';
@endphp

<div class="space-y-6">
    <header class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-slate-500">Admin</p>
            <h1 class="text-2xl font-semibold text-slate-900">Company Types</h1>
            <p class="text-sm text-slate-500">Keep the organizational categories consistent with CSV import/export flows.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.company-types.export', request()->only(['search', 'status', 'sort', 'direction'])) }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-900/10 bg-white px-4 py-2 text-sm font-semibold text-slate-800 shadow-sm transition hover:bg-slate-100">
                Export CSV
            </a>
            <a href="{{ route('admin.company-types.create') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-900/10 bg-white px-4 py-2 text-sm font-semibold text-slate-800 shadow-sm transition hover:bg-slate-100">
                <span>+ New Company Type</span>
            </a>
        </div>
    </header>

    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="GET" action="{{ route('admin.company-types.index') }}" class="grid gap-4 md:grid-cols-3">
            <div>
                <label class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500" for="search">Search</label>
                <input
                    id="search"
                    name="search"
                    type="search"
                    value="{{ request('search') }}"
                    placeholder="Label or slug"
                    class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-slate-400 focus:outline-none"
                >
            </div>
            <div>
                <label class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500" for="status">Status</label>
                <select
                    id="status"
                    name="status"
                    class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-slate-400 focus:outline-none"
                >
                    <option value="">All</option>
                    <option value="active" @selected(request('status') === 'active')>Active</option>
                    <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
                </select>
            </div>
            <div class="flex items-end gap-3">
                <input type="hidden" name="sort" value="{{ request('sort') }}">
                <input type="hidden" name="direction" value="{{ request('direction') }}">
                <button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                    Apply filters
                </button>
                <a href="{{ route('admin.company-types.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                    Reset
                </a>
            </div>
        </form>
    </section>

    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        @if (session('status'))
            <div class="rounded-2xl border border-slate-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                {{ session('status') }}
            </div>
        @endif

        <div class="mt-6 overflow-x-auto">
            <table class="w-full table-auto border-collapse text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-xs uppercase tracking-[0.3em] text-slate-500">
                        <th class="px-3 py-2 text-left">
                            <a href="{{ route('admin.company-types.index', array_merge($baseFilters, ['sort' => 'id', 'direction' => $nextDirection('id')])) }}" class="flex items-center gap-2">
                                ID
                                <span>{{ $indicator('id') }}</span>
                            </a>
                        </th>
                        <th class="px-3 py-2 text-left">
                            <a href="{{ route('admin.company-types.index', array_merge($baseFilters, ['sort' => 'slug', 'direction' => $nextDirection('slug')])) }}" class="flex items-center gap-2">
                                Slug
                                <span>{{ $indicator('slug') }}</span>
                            </a>
                        </th>
                        <th class="px-3 py-2 text-left">
                            <a href="{{ route('admin.company-types.index', array_merge($baseFilters, ['sort' => 'label', 'direction' => $nextDirection('label')])) }}" class="flex items-center gap-2">
                                Label
                                <span>{{ $indicator('label') }}</span>
                            </a>
                        </th>
                        <th class="px-3 py-2 text-left">
                            <a href="{{ route('admin.company-types.index', array_merge($baseFilters, ['sort' => 'is_active', 'direction' => $nextDirection('is_active')])) }}" class="flex items-center gap-2">
                                Status
                                <span>{{ $indicator('is_active') }}</span>
                            </a>
                        </th>
                        <th class="px-3 py-2 text-right">
                            <a href="{{ route('admin.company-types.index', array_merge($baseFilters, ['sort' => 'sort_order', 'direction' => $nextDirection('sort_order')])) }}" class="inline-flex items-center gap-2">
                                Sort order
                                <span>{{ $indicator('sort_order') }}</span>
                            </a>
                        </th>
                        <th class="px-3 py-2 text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($companyTypes as $companyType)
                        <tr class="border-b border-slate-100 bg-white transition hover:bg-slate-50">
                            <td class="px-3 py-4 font-semibold text-slate-900">{{ $companyType->id }}</td>
                            <td class="px-3 py-4 text-xs uppercase tracking-[0.3em] text-slate-400">{{ $companyType->slug }}</td>
                            <td class="px-3 py-4 font-semibold text-slate-900">{{ $companyType->label }}</td>
                            <td class="px-3 py-4">
                                <span class="rounded-full px-3 py-1 text-[11px] font-semibold {{ $companyType->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                    {{ $companyType->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td class="px-3 py-4 text-right text-xs font-semibold uppercase tracking-[0.3em] text-slate-400">{{ $companyType->sort_order }}</td>
                            <td class="px-3 py-4 text-right text-[11px] font-semibold text-slate-600">
                                <div class="flex flex-wrap justify-end gap-2">
                                    <a href="{{ route('admin.company-types.show', $companyType) }}" class="rounded-2xl border border-slate-200 px-3 py-1 transition hover:bg-slate-50">View</a>
                                    <a href="{{ route('admin.company-types.edit', $companyType) }}" class="rounded-2xl border border-slate-200 px-3 py-1 transition hover:bg-slate-50">Edit</a>
                                    <form action="{{ route('admin.company-types.destroy', $companyType) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-2xl border border-transparent px-3 py-1 text-rose-600 transition hover:bg-rose-50" onclick="return confirm('Delete this company type?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-3 py-6 text-center text-sm text-slate-500">No company types found. Add one to get started.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $companyTypes->links() }}
        </div>

        <section class="mt-6 rounded-2xl border border-dashed border-slate-200 bg-slate-50 p-6 space-y-3">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">Bulk import</p>
            <p class="text-sm text-slate-500">Upload a CSV with slug,label,sort_order and is_active.</p>
            <a href="{{ route('admin.company-types.sample') }}" class="inline-flex items-center gap-2 text-xs font-semibold text-slate-700 underline">Download sample CSV</a>
            <form action="{{ route('admin.company-types.import') }}" method="POST" enctype="multipart/form-data" class="mt-4 flex flex-col gap-3 sm:flex-row">
                @csrf
                <input type="file" name="file" accept=".csv,text/csv" required class="w-full basis-2/3 rounded-2xl border border-slate-200 px-4 py-3 text-sm text-slate-900" />
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                    Import CSV
                </button>
            </form>
            @error('file')
                <p class="mt-2 text-xs text-rose-600">{{ $message }}</p>
            @enderror
        </section>
    </section>
</div>
@endsection