@php
    $filterGroups = [
        'industry' => ['label' => 'Industry', 'items' => $industries],
        'category' => ['label' => 'Category', 'items' => $categories],
        'city' => ['label' => 'Location', 'items' => $cities],
        'employment_type' => ['label' => 'Work mode', 'items' => $employmentTypes],
        'experience_range' => ['label' => 'Experience', 'items' => $experienceRanges],
    ];

    $formClass = $formClass ?? 'space-y-4 text-sm text-slate-600';
@endphp

<form method="GET" action="{{ route('jobs') }}" class="{{ $formClass }}">
    <input type="hidden" name="keyword" value="{{ request('keyword') }}" />
    <input type="hidden" name="location" value="{{ request('location') }}" />

    @foreach ($filterGroups as $namespace => $group)
        @php
            $selectedIds = array_map(
                'strval',
                array_filter((array) request()->input("{$namespace}_id", []), function ($value) {
                    return $value !== null && $value !== '';
                })
            );
        @endphp
        <div class="space-y-1">
            <div class="flex items-center justify-between">
                <p class="text-[0.65rem] uppercase tracking-[0.3em] text-slate-400">{{ $group['label'] }}</p>
                <p class="text-[0.55rem] text-slate-400">Pick any; leave blank for all</p>
            </div>
            <div class="grid gap-2 max-h-48 overflow-y-auto">
                @foreach ($group['items'] as $item)
                    <label class="inline-flex items-center gap-2">
                        <input
                            type="checkbox"
                            name="{{ $namespace }}_id[]"
                            value="{{ $item->id }}"
                            class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-500"
                            {{ in_array(strval($item->id), $selectedIds, true) ? 'checked' : '' }}
                        />
                        {{ $item->label ?? $item->name }}
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach

    <div class="space-y-1">
        <p class="text-[0.65rem] uppercase tracking-[0.3em] text-slate-400">Work preference</p>
        <label class="inline-flex items-center gap-2">
            <input type="checkbox" name="remote" value="1" class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-500" {{ request()->boolean('remote') ? 'checked' : '' }} />
            Remote only
        </label>
    </div>
    <div class="flex flex-wrap items-center gap-2">
        <input type="hidden" name="per_page" value="{{ request('per_page', 12) }}" />
        <button type="submit" class="flex-1 min-w-[8rem] rounded-2xl bg-slate-900 px-6 py-3 text-center text-sm font-semibold text-white transition hover:-translate-y-0.5">
            Apply filters
        </button>
        <a href="{{ request()->url() }}" class="flex-1 min-w-[8rem] rounded-2xl border border-slate-200 px-6 py-3 text-center text-sm font-semibold text-slate-900 transition hover:border-slate-400">
            Reset
        </a>
    </div>
</form>
