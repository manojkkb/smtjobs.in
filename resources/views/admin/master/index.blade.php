@extends('admin.layouts.app')

@section('title', $title)

@section('content')
<div class="space-y-6">
    @php
        $exportFilters = request()->except('page');
    @endphp
    <header class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-slate-500">Admin</p>
            <h1 class="text-2xl font-semibold text-slate-900">{{ $resourcePlural }}</h1>
            @if($subtitle)
                <p class="text-sm text-slate-500">{{ $subtitle }}</p>
            @endif
        </div>
        <div class="flex flex-wrap gap-2">
            @if (!empty($bulkActions['export']))
                <a
                    href="{{ route($bulkActions['export']['route'], $exportFilters) }}"
                    class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-800 shadow-sm transition hover:bg-slate-100"
                >
                    <span>{{ $bulkActions['export']['label'] }}</span>
                </a>
            @endif
            <a href="{{ route($routeName . '.create') }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-900/10 bg-white px-4 py-2 text-sm font-semibold text-slate-800 shadow-sm transition hover:bg-slate-100">
                <span>{{ $createLabel }}</span>
            </a>
        </div>
    </header>

    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form method="GET" action="{{ route($routeName . '.index') }}" class="grid gap-4 md:grid-cols-3">
            <div>
                <label class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500" for="search">Search</label>
                <input
                    id="search"
                    name="search"
                    type="search"
                    value="{{ request('search') }}"
                    placeholder="Label, slug, or code"
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
                <a href="{{ route($routeName . '.index') }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
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

        @php
            $sortColumn = request('sort', $tableColumns[0]['field'] ?? 'id');
            $sortDirection = request('direction', 'desc');
            $baseFilters = request()->except(['sort', 'direction', 'page']);
            $nextDirection = fn ($column) => $sortColumn === $column && $sortDirection === 'asc' ? 'desc' : 'asc';
            $indicator = fn ($column) => $sortColumn === $column ? ($sortDirection === 'asc' ? '↑' : '↓') : '';
        @endphp

        <div class="mt-6 overflow-x-auto">
            <table class="w-full table-auto border-collapse text-sm">
                <thead>
                    <tr class="border-b border-slate-200 text-xs uppercase tracking-[0.3em] text-slate-500">
                        @foreach ($tableColumns as $column)
                            @php $align = ($column['align'] ?? 'left') === 'right' ? 'text-right' : 'text-left'; @endphp
                            <th class="px-3 py-2 {{ $align }}">
                                @if (!empty($column['sortable']))
                                    @php $sortKey = $column['sortKey'] ?? $column['field']; @endphp
                                    <a href="{{ route($routeName . '.index', array_merge($baseFilters, ['sort' => $sortKey, 'direction' => $nextDirection($sortKey)])) }}" class="flex items-center gap-2">
                                        {{ $column['label'] }}
                                        <span>{{ $indicator($sortKey) }}</span>
                                    </a>
                                @else
                                    {{ $column['label'] }}
                                @endif
                            </th>
                        @endforeach
                        <th class="px-3 py-2 text-right">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($records as $record)
                        <tr class="border-b border-slate-100 bg-white transition hover:bg-slate-50">
                            @foreach ($tableColumns as $column)
                                @php
                                    $value = data_get($record, $column['field']);
                                    $alignClass = ($column['align'] ?? 'left') === 'right' ? 'text-right' : 'text-left';
                                @endphp
                                <td class="px-3 py-4 {{ $alignClass }}">
                                    @if (($column['type'] ?? null) === 'boolean')
                                        <span class="rounded-full px-3 py-1 text-[11px] font-semibold {{ $value ? 'bg-emerald-100 text-emerald-700' : 'bg-rose-100 text-rose-700' }}">
                                            {{ $value ? 'Active' : 'Inactive' }}
                                        </span>
                                    @elseif (($column['type'] ?? null) === 'color')
                                        <div class="flex items-center gap-2">
                                            @if ($value)
                                                <span class="inline-block h-6 w-6 rounded border-2 border-slate-200" style="background-color: {{ $value }}"></span>
                                                <span class="text-xs text-slate-600">{{ $value }}</span>
                                            @else
                                                <span class="text-slate-400">—</span>
                                            @endif
                                        </div>
                                    @else
                                        {{ $value ?? '—' }}
                                    @endif
                                </td>
                            @endforeach
                            <td class="px-3 py-4 text-right text-[11px] font-semibold text-slate-600">
                                <div class="flex flex-wrap justify-end gap-2">
                                    <a href="{{ route($routeName . '.show', $record) }}" class="rounded-2xl border border-slate-200 px-3 py-1 transition hover:bg-slate-50">View</a>
                                    <a href="{{ route($routeName . '.edit', $record) }}" class="rounded-2xl border border-slate-200 px-3 py-1 transition hover:bg-slate-50">Edit</a>
                                    <form action="{{ route($routeName . '.destroy', $record) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="rounded-2xl border border-transparent px-3 py-1 text-rose-600 transition hover:bg-rose-50" onclick="return confirm('Delete this {{ Str::lower($resourceLabel) }}?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ count($tableColumns) + 1 }}" class="px-3 py-6 text-center text-sm text-slate-500">No {{ Str::lower($resourcePlural) }} found. Add one to get started.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $records->links() }}
        </div>
    </section>

    @if (!empty($bulkActions))
        <section class="rounded-3xl border border-slate-200 bg-slate-50 p-6 shadow-sm">
            <div class="flex flex-col gap-2 md:flex-row md:items-center md:justify-between">
                <div>
                    <p class="text-xs uppercase tracking-[0.5em] text-slate-500">Bulk import/export</p>
                    <p class="text-lg font-semibold text-slate-900">Manage this list via CSV</p>
                </div>
                <p class="text-sm text-slate-500">Use the sample file as a template and re-export anytime.</p>
            </div>

            <div class="mt-6 grid gap-4 lg:grid-cols-4">
                @if (isset($bulkActions['sample']))
                    <a href="{{ route($bulkActions['sample']['route']) }}" class="rounded-2xl border border-slate-200 bg-white p-4 text-sm font-semibold text-slate-900 transition hover:border-slate-300">
                        {{ $bulkActions['sample']['label'] }}
                        <p class="text-xs font-normal text-slate-500">{{ $bulkActions['sample']['description'] ?? '' }}</p>
                    </a>
                @endif
                @if (isset($bulkActions['export']))
                    <a href="{{ route($bulkActions['export']['route']) }}" class="rounded-2xl border border-slate-200 bg-white p-4 text-sm font-semibold text-slate-900 transition hover:border-slate-300">
                        {{ $bulkActions['export']['label'] }}
                        <p class="text-xs font-normal text-slate-500">{{ $bulkActions['export']['description'] ?? '' }}</p>
                    </a>
                @endif
                @if (isset($bulkActions['import']))
                    <form action="{{ route($bulkActions['import']['route']) }}" method="POST" enctype="multipart/form-data" class="rounded-2xl border border-slate-200 bg-white p-4 text-sm text-slate-900">
                        @csrf
                        <p class="mb-2 text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">{{ $bulkActions['import']['label'] }}</p>
                        <p class="mb-4 text-xs text-slate-500">{{ $bulkActions['import']['description'] ?? '' }}</p>
                        <input
                            type="file"
                            name="file"
                            accept=".csv,.txt"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-xs text-slate-900"
                            required
                        >
                        <button type="submit" class="mt-3 w-full rounded-2xl bg-slate-900 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-800">
                            Upload CSV
                        </button>
                    </form>
                @endif
            </div>
        </section>
    @endif
</div>
@endsection
