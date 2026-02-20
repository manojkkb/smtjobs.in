@extends('recruiter.layouts.app')

@section('title', 'Job posts')

@section('content')
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Talent inbox</p>
            <h1 class="text-2xl font-semibold text-slate-900">Job posts</h1>
            <p class="text-sm text-slate-500">Manage your live and paused roles from one place.</p>
        </div>
        <div class="flex gap-2">
            <a
                href="{{ route('recruiter.job-posts.create') }}"
                class="inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 shadow-sm transition hover:border-slate-300"
            >
                <span>New job post</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
            </a>
        </div>
    </div>

    @if (session('success'))
        <div class="mt-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-6 py-4 text-sm font-semibold text-emerald-600">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-6 overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm">
        @php $latestJob = $jobPosts->first(); @endphp
        <div class="flex flex-col gap-2 border-b border-slate-100 px-6 py-5 sm:flex-row sm:justify-between sm:items-center">
            <div>
                <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Open roles</p>
                <h2 class="text-lg font-semibold text-slate-900">{{ $jobPosts->total() }} {{ \Illuminate\Support\Str::plural('job post', $jobPosts->total()) }}</h2>
            </div>
            <div class="text-xs text-slate-500">Updated {{ optional(optional($latestJob)->created_at)->diffForHumans() ?? 'just now' }}</div>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="min-w-full text-left text-sm text-slate-600">
                <thead>
                    <tr class="text-xs uppercase tracking-[0.3em] text-slate-400">
                        <th class="px-6 py-3">Job</th>
                        <th class="px-6 py-3">Location</th>
                        <th class="px-6 py-3">Compensation</th>
                        <th class="px-6 py-3">Experience</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($jobPosts as $jobPost)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-semibold text-slate-900">{{ optional($jobPost->profile)->title ?? 'Untitled role' }}</div>
                                <p class="text-xs uppercase tracking-[0.3em] text-slate-400">{{ optional($jobPost->category)->name ?? 'General' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-slate-900">{{ optional($jobPost->city)->name ?? 'Remote / unspecified' }}</p>
                                <p class="text-xs text-slate-500">{{ $jobPost->is_remote ? 'Remote friendly' : 'On-site' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if ($jobPost->min_salary || $jobPost->max_salary)
                                    <p class="text-sm font-semibold text-slate-900">
                                        {{ $jobPost->min_salary ? number_format($jobPost->min_salary) : '—' }}
                                        —
                                        {{ $jobPost->max_salary ? number_format($jobPost->max_salary) : '—' }}
                                    </p>
                                    <p class="text-xs uppercase tracking-[0.3em] text-slate-400">Monthly</p>
                                @else
                                    <p class="text-sm font-semibold text-slate-500">Not shared</p>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-semibold text-slate-900">{{ optional($jobPost->experienceRange)->name ?? 'Experience TBD' }}</p>
                                <p class="text-xs text-slate-500">{{ optional($jobPost->employmentType)->name ?? 'Type pending' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span
                                    class="inline-flex items-center gap-1 rounded-full px-3 py-1 text-xs font-semibold {{ $jobPost->is_active ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-500' }}"
                                >
                                    {{ $jobPost->is_active ? 'Active' : 'Paused' }}
                                </span>
                                <p class="text-xs text-slate-400">{{ optional($jobPost->published_at)->diffForHumans() ?? 'Draft' }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-2">
                                    <a
                                        href="{{ route('recruiter.job-posts.show', $jobPost) }}"
                                        class="text-xs font-semibold text-slate-500 transition hover:text-cyan-500"
                                    >View</a>
                                    <a
                                        href="{{ route('recruiter.job-posts.edit', $jobPost) }}"
                                        class="text-xs font-semibold text-slate-500 transition hover:text-cyan-500"
                                    >Edit</a>
                                    <form action="{{ route('recruiter.job-posts.destroy', $jobPost) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            type="submit"
                                            class="text-xs font-semibold text-rose-500 transition hover:text-rose-700"
                                            onclick="return confirm('Archive this job post?')"
                                        >
                                            Archive
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-8 text-center text-sm text-slate-500">
                                No job posts yet. Click "New job post" to publish your first opening.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4">
            {{ $jobPosts->links() }}
        </div>
    </div>
@endsection
