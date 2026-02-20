@php
    $profile = $jobPost->profile ?? null;
@endphp

<div class="space-y-6">
    {{-- Profile details --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="px-6 py-5 border-b border-slate-100">
            <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Profile</p>
            <h2 class="text-lg font-semibold text-slate-900">What should candidates see?</h2>
        </div>
        <div class="grid gap-4 px-6 py-6">
            <div>
                <label class="text-sm font-semibold text-slate-700" for="title">Job title</label>
                <input
                    id="title"
                    name="title"
                    type="text"
                    value="{{ old('title', optional($profile)->title) }}"
                    class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm transition focus:border-cyan-500 focus:outline-none"
                    placeholder="e.g., Senior Product Manager"
                />
                @error('title')
                    <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700" for="description">Description</label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm transition focus:border-cyan-500 focus:outline-none"
                >{{ old('description', optional($profile)->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-xs font-semibold text-rose-600">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                <div>
                    <label class="text-sm font-semibold text-slate-700" for="requirements">Requirements</label>
                    <textarea
                        id="requirements"
                        name="requirements"
                        rows="3"
                        class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm transition focus:border-cyan-500 focus:outline-none"
                    >{{ old('requirements', optional($profile)->requirements) }}</textarea>
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-700" for="responsibilities">Responsibilities</label>
                    <textarea
                        id="responsibilities"
                        name="responsibilities"
                        rows="3"
                        class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm transition focus:border-cyan-500 focus:outline-none"
                    >{{ old('responsibilities', optional($profile)->responsibilities) }}</textarea>
                </div>
            </div>
        </div>
    </div>

    {{-- Logistics --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
        <div class="px-6 py-5 border-b border-slate-100">
            <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Job details</p>
            <h2 class="text-lg font-semibold text-slate-900">Where and how should candidates apply?</h2>
        </div>
        <div class="grid gap-4 px-6 py-6 lg:grid-cols-2">
            <div>
                <label class="text-sm font-semibold text-slate-700" for="industry_id">Industry</label>
                <select
                    id="industry_id"
                    name="industry_id"
                    class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm transition focus:border-cyan-500 focus:outline-none"
                >
                    <option value="">Select an industry</option>
                    @foreach ($industries as $industry)
                        <option value="{{ $industry->id }}" {{ old('industry_id', $jobPost->industry_id) == $industry->id ? 'selected' : '' }}>{{ $industry->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700" for="category_id">Category</label>
                <select
                    id="category_id"
                    name="category_id"
                    class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm transition focus:border-cyan-500 focus:outline-none"
                >
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $jobPost->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700" for="city_id">City</label>
                <select
                    id="city_id"
                    name="city_id"
                    class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm transition focus:border-cyan-500 focus:outline-none"
                >
                    <option value="">Select city</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}" {{ old('city_id', $jobPost->city_id) == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700" for="employment_type_id">Employment type</label>
                <select
                    id="employment_type_id"
                    name="employment_type_id"
                    class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm transition focus:border-cyan-500 focus:outline-none"
                >
                    <option value="">Select type</option>
                    @foreach ($employmentTypes as $type)
                        <option value="{{ $type->id }}" {{ old('employment_type_id', $jobPost->employment_type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700" for="experience_range_id">Experience range</label>
                <select
                    id="experience_range_id"
                    name="experience_range_id"
                    class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm transition focus:border-cyan-500 focus:outline-none"
                >
                    <option value="">Select range</option>
                    @foreach ($experienceRanges as $range)
                        <option value="{{ $range->id }}" {{ old('experience_range_id', $jobPost->experience_range_id) == $range->id ? 'selected' : '' }}>{{ $range->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid gap-4 px-6 py-6 md:grid-cols-2">
            <div>
                <label class="text-sm font-semibold text-slate-700" for="min_salary">Minimum salary</label>
                <input
                    id="min_salary"
                    name="min_salary"
                    type="number"
                    step="500"
                    min="0"
                    value="{{ old('min_salary', $jobPost->min_salary) }}"
                    class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm transition focus:border-cyan-500 focus:outline-none"
                />
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-700" for="max_salary">Maximum salary</label>
                <input
                    id="max_salary"
                    name="max_salary"
                    type="number"
                    step="500"
                    min="0"
                    value="{{ old('max_salary', $jobPost->max_salary) }}"
                    class="mt-1 w-full rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm transition focus:border-cyan-500 focus:outline-none"
                />
            </div>
        </div>
        <div class="grid gap-4 px-6 pb-6 md:grid-cols-2">
            <div>
                <p class="text-sm font-semibold text-slate-700">Publication window</p>
                <div class="mt-2 grid gap-4 sm:grid-cols-2">
                    <label class="flex flex-col text-xs uppercase tracking-[0.3em] text-slate-400">
                        Published at
                        <input
                            type="datetime-local"
                            name="published_at"
                            value="{{ old('published_at', optional($jobPost->published_at)->format('Y-m-d\TH:i')) }}"
                            class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm focus:border-cyan-500 focus:outline-none"
                        />
                    </label>
                    <label class="flex flex-col text-xs uppercase tracking-[0.3em] text-slate-400">
                        Expires at
                        <input
                            type="datetime-local"
                            name="expires_at"
                            value="{{ old('expires_at', optional($jobPost->expires_at)->format('Y-m-d\TH:i')) }}"
                            class="mt-2 rounded-2xl border border-slate-200 bg-slate-50 px-3 py-2 text-sm focus:border-cyan-500 focus:outline-none"
                        />
                    </label>
                </div>
            </div>
            <div class="space-y-3">
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <input
                        type="checkbox"
                        name="is_remote"
                        value="1"
                        {{ old('is_remote', $jobPost->is_remote) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-slate-300 text-emerald-500 focus:ring-emerald-400"
                    />
                    Remote friendly
                </label>
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <input
                        type="checkbox"
                        name="is_featured"
                        value="1"
                        {{ old('is_featured', $jobPost->is_featured) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-slate-300 text-emerald-500 focus:ring-emerald-400"
                    />
                    Feature on board
                </label>
                <label class="flex items-center gap-2 text-sm font-semibold text-slate-700">
                    <input
                        type="checkbox"
                        name="is_active"
                        value="1"
                        {{ old('is_active', $jobPost->is_active ?? true) ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-slate-300 text-emerald-500 focus:ring-emerald-400"
                    />
                    Job is active
                </label>
            </div>
        </div>
    </div>
</div>
