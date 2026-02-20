@extends('admin.layouts.app')

@section('title', $pageTitle)

@section('content')
<div class="space-y-6">
    <header class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.5em] text-slate-500">Admin</p>
            <h1 class="text-2xl font-semibold text-slate-900">{{ $resourcePlural }}</h1>
            <p class="text-sm text-slate-500">{{ $subtitle ?? 'Capture the fields for this master record.' }}</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <a href="{{ $backRoute }}" class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-600 shadow-sm transition hover:bg-slate-50">
                Back
            </a>
        </div>
    </header>

    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
        <form action="{{ $formAction }}" method="POST" class="space-y-6">
            @csrf
            @if ($formMethod === 'PUT')
                @method('PUT')
            @endif

            <div class="grid gap-6 md:grid-cols-2">
                @foreach ($formFields as $field)
                    @php
                        $name = $field['name'];
                        $type = $field['type'] ?? 'text';
                        $storedValue = data_get($record, $name);
                        $defaultValue = array_key_exists('default', $field) ? $field['default'] : null;
                        $value = old($name, $storedValue ?? $defaultValue);
                        $isRequired = $field['required'] ?? false;
                        $attributes = $field['attributes'] ?? [];
                        $options = $field['options'] ?? $selectOptions[$name] ?? [];
                    @endphp

                    <div class="space-y-2">
                        <label for="{{ $name }}" class="text-xs font-semibold uppercase tracking-[0.3em] text-slate-500">
                            {{ $field['label'] ?? \Illuminate\Support\Str::title(str_replace('_', ' ', $name)) }}
                            @if ($isRequired)
                                <span class="text-rose-500">*</span>
                            @endif
                        </label>

                        @if ($type === 'textarea')
                                <textarea
                                id="{{ $name }}"
                                name="{{ $name }}"
                                rows="4"
                                {{ $isRequired ? 'required' : '' }}
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-slate-400 focus:outline-none"
                                >{{ $value }}</textarea>
                        @elseif ($type === 'select')
                            <select
                                id="{{ $name }}"
                                name="{{ $name }}"
                                {{ $isRequired ? 'required' : '' }}
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-slate-400 focus:outline-none"
                            >
                                <option value="">Select {{ $field['label'] ?? \Illuminate\Support\Str::title(str_replace('_', ' ', $name)) }}</option>
                                @foreach ($options as $optionValue => $optionLabel)
                                    <option value="{{ $optionValue }}" @selected((string) $optionValue === (string) ($value ?? ''))>
                                        {{ $optionLabel }}
                                    </option>
                                @endforeach
                            </select>
                        @elseif ($type === 'checkbox')
                            <div class="flex items-center gap-3">
                                <input type="hidden" name="{{ $name }}" value="0">
                                <label class="inline-flex items-center gap-2 text-sm text-slate-700">
                                    <input
                                        id="{{ $name }}"
                                        name="{{ $name }}"
                                        type="checkbox"
                                        value="1"
                                        {{ $value ? 'checked' : '' }}
                                        class="h-5 w-5 rounded border-slate-300 text-slate-900 focus:ring-0"
                                    >
                                    <span>{{ $field['label'] ?? \Illuminate\Support\Str::title(str_replace('_', ' ', $name)) }}</span>
                                </label>
                            </div>
                        @else
                                <input
                                id="{{ $name }}"
                                name="{{ $name }}"
                                type="{{ $type }}"
                                value="{{ old($name, $value) }}"
                                {{ $isRequired ? 'required' : '' }}
                                @foreach ($attributes as $attrKey => $attrValue)
                                    {{ $attrKey }}="{{ $attrValue }}"
                                @endforeach
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 focus:border-slate-400 focus:outline-none"
                            >
                        @endif

                        @if (!empty($field['help']))
                            <p class="text-xs text-slate-500">{{ $field['help'] }}</p>
                        @endif

                        @error($name)
                            <p class="text-xs text-rose-600">{{ $message }}</p>
                        @enderror
                    </div>
                @endforeach
            </div>

            <div class="flex flex-wrap items-center justify-end gap-3">
                <a href="{{ $backRoute }}" class="inline-flex items-center justify-center rounded-2xl border border-slate-200 px-4 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-50">
                    Cancel
                </a>
                <button type="submit" class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                    {{ $submitLabel }}
                </button>
            </div>
        </form>
    </section>
</div>
@endsection
