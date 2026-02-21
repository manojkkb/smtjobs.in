@extends('website.layouts.app')

@section('title', 'Complete Recruiter Profile · SMTJobs')

@section('content')
    <div class="mx-auto max-w-3xl space-y-8 py-8">
        <!-- Progress Steps -->
        <div class="flex items-center justify-center gap-4">
            <div class="flex items-center gap-2">
                <div class="flex h-10 w-10 items-center justify-center rounded-full {{ isset($step) && $step >= 1 ? 'bg-slate-900 text-white' : 'bg-slate-200 text-slate-500' }} text-sm font-semibold">
                    1
                </div>
                <span class="text-sm font-semibold {{ isset($step) && $step >= 1 ? 'text-slate-900' : 'text-slate-400' }}">Personal Info</span>
            </div>
            <div class="h-0.5 w-16 {{ isset($step) && $step >= 2 ? 'bg-slate-900' : 'bg-slate-200' }}"></div>
            <div class="flex items-center gap-2">
                <div class="flex h-10 w-10 items-center justify-center rounded-full {{ isset($step) && $step >= 2 ? 'bg-slate-900 text-white' : 'bg-slate-200 text-slate-500' }} text-sm font-semibold">
                    2
                </div>
                <span class="text-sm font-semibold {{ isset($step) && $step >= 2 ? 'text-slate-900' : 'text-slate-400' }}">Recruiter Details</span>
            </div>
        </div>

        @if (session('error'))
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-6 py-4 text-sm font-semibold text-rose-600">
                {{ session('error') }}
            </div>
        @endif

        @if (session('info'))
            <div class="rounded-2xl border border-blue-200 bg-blue-50 px-6 py-4 text-sm font-semibold text-blue-600">
                {{ session('info') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="rounded-2xl border border-rose-200 bg-rose-50 px-6 py-4 text-sm">
                <p class="font-semibold text-rose-600">Please fix the following errors:</p>
                <ul class="mt-2 list-inside list-disc text-rose-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Step 1: Personal Information -->
        @if (!isset($step) || $step == 1)
            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="space-y-2">
                    <p class="text-xs uppercase tracking-[0.5em] text-slate-400">Step 1 of 2</p>
                    <h1 class="text-2xl font-semibold text-slate-900">Personal Information</h1>
                    <p class="text-sm text-slate-500">Please provide your basic contact details</p>
                </div>

                <form action="{{ route('recruiter.complete.profile.personal') }}" method="POST" class="mt-6 space-y-5">
                    @csrf
                    <div class="grid gap-4 sm:grid-cols-2">
                        <label class="space-y-2 text-sm text-slate-600">
                            <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Full name *</span>
                            <input
                                type="text"
                                name="name"
                                value="{{ old('name', auth()->user()->name) }}"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                                placeholder="e.g. John Doe"
                                required
                            />
                        </label>
                        <label class="space-y-2 text-sm text-slate-600">
                            <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Gender</span>
                            <select
                                name="gender"
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            >
                                <option value="">Select...</option>
                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </label>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <label class="space-y-2 text-sm text-slate-600">
                            <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Email *</span>
                            <input
                                type="email"
                                name="email"
                                value="{{ old('email', auth()->user()->email) }}"
                                class="w-full rounded-2xl border {{ $errors->has('email') ? 'border-rose-300 bg-rose-50' : 'border-slate-200 bg-slate-50' }} px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                                placeholder="e.g. john@example.com"
                                required
                            />
                            @if($errors->has('email'))
                                <p class="text-xs text-rose-600">{{ $errors->first('email') }}</p>
                            @endif
                        </label>
                        <label class="space-y-2 text-sm text-slate-600">
                            <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Phone *</span>
                            <input
                                type="tel"
                                name="phone"
                                value="{{ old('phone', auth()->user()->phone) }}"
                                class="w-full rounded-2xl border {{ $errors->has('phone') ? 'border-rose-300 bg-rose-50' : 'border-slate-200 bg-slate-50' }} px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                                placeholder="e.g. +94 77 123 4567"
                                required
                            />
                            @if($errors->has('phone'))
                                <p class="text-xs text-rose-600">{{ $errors->first('phone') }}</p>
                            @endif
                        </label>
                    </div>
                    <div class="mt-6 space-y-2">
                        <p class="text-xs text-slate-400">* Required fields. We'll use this information to verify your identity and set up your recruiter account.</p>
                        <button
                            type="submit"
                            class="w-full rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
                        >
                            Continue to Step 2
                        </button>
                    </div>
                </form>
            </section>
        @endif

        <!-- Step 2: Recruiter Details -->
        @if (isset($step) && $step == 2)
            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="space-y-2">
                    <p class="text-xs uppercase tracking-[0.5em] text-slate-400">Step 2 of 2</p>
                    <h1 class="text-2xl font-semibold text-slate-900">Recruiter Details</h1>
                    <p class="text-sm text-slate-500">Tell us about your company and role</p>
                </div>

                <form action="{{ route('recruiter.complete.profile.details') }}" method="POST" class="mt-6 space-y-5">
                    @csrf
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Company *</span>
                        <div class="relative">
                            <input
                                type="text"
                                id="companySearch"
                                autocomplete="off"
                                placeholder="Search or add new company..."
                                class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            />
                            <input type="hidden" name="company_id" id="companyId" value="{{ old('company_id') }}">
                            <input type="hidden" name="company_name" id="companyName" value="{{ old('company_name') }}">
                            <div id="companyDropdown" class="absolute z-10 mt-2 hidden w-full rounded-2xl border border-slate-200 bg-white shadow-lg max-h-60 overflow-y-auto">
                                <div id="companyResults"></div>
                            </div>
                        </div>
                        <p class="text-xs text-slate-400">Start typing to search existing companies or add a new one</p>
                    </label>
                    <label class="space-y-2 text-sm text-slate-600">
                        <span class="text-[0.65rem] uppercase tracking-[0.4em] text-slate-400">Designation *</span>
                        <select
                            name="role"
                            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-slate-900 focus:border-slate-400 focus:outline-none"
                            required
                        >
                            <option value="">Select your designation</option>
                            <option value="HR" {{ old('role') == 'HR' ? 'selected' : '' }}>HR</option>
                            <option value="Owner" {{ old('role') == 'Owner' ? 'selected' : '' }}>Owner</option>
                            <option value="Interviewer" {{ old('role') == 'Interviewer' ? 'selected' : '' }}>Interviewer</option>
                        </select>
                    </label>
                    <div class="mt-6 flex gap-3">
                        <a
                            href="{{ route('recruiter.complete.profile') }}"
                            class="w-full rounded-2xl border border-slate-200 bg-white px-6 py-3 text-center text-sm font-semibold text-slate-700 transition hover:border-slate-300"
                        >
                            Back
                        </a>
                        <button
                            type="submit"
                            class="w-full rounded-2xl bg-slate-900 px-6 py-3 text-sm font-semibold text-white transition hover:bg-slate-800"
                        >
                            Complete Profile
                        </button>
                    </div>
                </form>
                
                <script>
                    (function() {
                        const searchInput = document.getElementById('companySearch');
                        const companyIdInput = document.getElementById('companyId');
                        const companyNameInput = document.getElementById('companyName');
                        const dropdown = document.getElementById('companyDropdown');
                        const resultsDiv = document.getElementById('companyResults');
                        let debounceTimer;
                        
                        searchInput.addEventListener('input', function() {
                            clearTimeout(debounceTimer);
                            const query = this.value.trim();
                            
                            if (query.length < 2) {
                                dropdown.classList.add('hidden');
                                return;
                            }
                            
                            debounceTimer = setTimeout(() => {
                                fetch(`/api/companies/search?q=${encodeURIComponent(query)}`)
                                    .then(response => response.json())
                                    .then(data => {
                                        resultsDiv.innerHTML = '';
                                        
                                        if (data.length === 0) {
                                            resultsDiv.innerHTML = `
                                                <div class="px-4 py-3 cursor-pointer hover:bg-slate-50 border-b border-slate-100" data-new-company="${query}">
                                                    <p class="text-sm font-semibold text-slate-900">Add "${query}"</p>
                                                    <p class="text-xs text-slate-500">Create new company</p>
                                                </div>
                                            `;
                                        } else {
                                            data.forEach(company => {
                                                resultsDiv.innerHTML += `
                                                    <div class="px-4 py-3 cursor-pointer hover:bg-slate-50 border-b border-slate-100 last:border-0" data-company-id="${company.id}" data-company-name="${company.name}">
                                                        <p class="text-sm font-semibold text-slate-900">${company.name}</p>
                                                        ${company.industry ? `<p class="text-xs text-slate-500">${company.industry}</p>` : ''}
                                                    </div>
                                                `;
                                            });
                                            
                                            resultsDiv.innerHTML += `
                                                <div class="px-4 py-3 cursor-pointer hover:bg-slate-50" data-new-company="${query}">
                                                    <p class="text-sm font-semibold text-slate-900">Add "${query}"</p>
                                                    <p class="text-xs text-slate-500">Create new company</p>
                                                </div>
                                            `;
                                        }
                                        
                                        dropdown.classList.remove('hidden');
                                        
                                        // Add click handlers
                                        resultsDiv.querySelectorAll('[data-company-id], [data-new-company]').forEach(item => {
                                            item.addEventListener('click', function() {
                                                if (this.dataset.companyId) {
                                                    companyIdInput.value = this.dataset.companyId;
                                                    companyNameInput.value = '';
                                                    searchInput.value = this.dataset.companyName;
                                                } else {
                                                    companyIdInput.value = '';
                                                    companyNameInput.value = this.dataset.newCompany;
                                                    searchInput.value = this.dataset.newCompany;
                                                }
                                                dropdown.classList.add('hidden');
                                            });
                                        });
                                    })
                                    .catch(error => {
                                        console.error('Error fetching companies:', error);
                                    });
                            }, 300);
                        });
                        
                        // Close dropdown when clicking outside
                        document.addEventListener('click', function(e) {
                            if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
                                dropdown.classList.add('hidden');
                            }
                        });
                    })();
                </script>
            </section>
        @endif
    </div>
@endsection