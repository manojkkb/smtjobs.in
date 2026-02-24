<div x-data="{ searchModalOpen: false }" class="mt-6">
    <!-- Mobile Search Trigger (visible only on mobile) -->
    <button 
        type="button"
        @click="searchModalOpen = true"
        class="md:hidden w-full flex items-center gap-3 rounded-2xl bg-white border-2 border-slate-200 shadow-lg px-6 py-4 text-left"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <span class="text-base text-slate-400 font-medium">Search jobs, location, experience...</span>
    </button>

    <!-- Desktop Search Form (visible only on desktop) -->
    <form action="{{ route('jobs') }}" method="GET" class="hidden md:block">
        <div class="flex items-center gap-0 rounded-2xl bg-white border-2 border-slate-200 shadow-lg">
        <!-- Keyword Field -->
        <div class="flex-1 relative" data-suggestion-wrapper>
            <input
                type="text"
                name="keyword"
                id="keywordInput"
                class="w-full border-0 bg-white px-6 py-4 text-base font-semibold text-slate-900 placeholder:text-slate-400 focus:outline-none rounded-l-2xl"
                placeholder="Job Title, Keyword"
                value="{{ request('keyword') }}"
                autocomplete="off"
                data-suggestion-input="keyword"
            />
            <div class="hidden absolute left-0 right-0 top-full z-50 mt-1 overflow-hidden rounded-lg border border-slate-200 bg-white shadow-lg" data-suggestion-menu="keyword">
                <div class="max-h-60 overflow-y-auto"></div>
            </div>
        </div>
        
        <!-- Separator -->
        <div class="h-12 w-px bg-slate-200"></div>
        
        <!-- Location Field -->
        <div class="flex-1 relative" data-suggestion-wrapper>
            <input
                type="text"
                name="location"
                class="w-full border-0 bg-white px-6 py-4 text-base font-semibold text-slate-900 placeholder:text-slate-400 focus:outline-none"
                placeholder="City, State"
                value="{{ request('location') }}"
                autocomplete="off"
                data-suggestion-input="location"
            />
            <div class="hidden absolute left-0 right-0 top-full z-50 mt-1 overflow-hidden rounded-lg border border-slate-200 bg-white shadow-lg" data-suggestion-menu="location">
                <div class="max-h-60 overflow-y-auto"></div>
            </div>
        </div>
        
        <!-- Separator -->
        <div class="h-12 w-px bg-slate-200"></div>
        
        <!-- Experience Field -->
        <div class="flex-1 relative">
            <select
                name="experience_range_id[]"
                class="w-full border-0 bg-white px-6 py-4 text-base font-semibold focus:outline-none cursor-pointer appearance-none"
                style="color: {{ request('experience_range_id.0') ? '#0f172a' : '#94a3b8' }}"
                onchange="this.style.color = this.value ? '#0f172a' : '#94a3b8'"
            >
                <option value="" style="color: #94a3b8;">Experience</option>
                @foreach($experienceRanges as $range)
                    <option value="{{ $range->id }}" style="color: #0f172a;" {{ request('experience_range_id.0') == $range->id ? 'selected' : '' }}>
                        {{ $range->label }}
                    </option>
                @endforeach
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-4 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
        
        <!-- Search Button -->
        <button
            type="submit"
            class="px-8 py-4 bg-slate-900 text-white text-base font-bold transition hover:bg-slate-800 flex items-center gap-2 rounded-r-2xl"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Search
        </button>
    </div>
</form>

    <!-- Mobile Search Modal -->
    <div 
        x-show="searchModalOpen" 
        x-cloak
        class="md:hidden fixed inset-0 z-50 overflow-y-auto"
        @click.self="searchModalOpen = false"
    >
        <!-- Backdrop -->
        <div 
            x-show="searchModalOpen"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/50 backdrop-blur-sm"
            @click="searchModalOpen = false"
        ></div>

        <!-- Modal Content -->
        <div 
            x-show="searchModalOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-full"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-full"
            class="fixed inset-x-0 bottom-0 bg-white rounded-t-3xl shadow-2xl"
            @click.stop
        >
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-slate-200">
                <h3 class="text-lg font-bold text-slate-900">Search Jobs</h3>
                <button 
                    type="button"
                    @click="searchModalOpen = false"
                    class="p-2 hover:bg-slate-100 rounded-full transition"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Modal Search Form -->
            <form action="{{ route('jobs') }}" method="GET" class="p-6 space-y-4">
                <!-- Keyword Field -->
                <div class="relative" data-suggestion-wrapper>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Job Title or Keyword</label>
                    <input
                        type="text"
                        name="keyword"
                        class="w-full border-2 border-slate-200 bg-white px-4 py-3 rounded-xl text-base font-medium text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-slate-900 transition"
                        placeholder="e.g. Software Engineer"
                        value="{{ request('keyword') }}"
                        autocomplete="off"
                        data-suggestion-input="keyword"
                        data-modal-input
                    />
                    <div class="hidden absolute left-0 right-0 top-full z-50 mt-1 overflow-hidden rounded-lg border border-slate-200 bg-white shadow-lg" data-suggestion-menu="keyword" data-modal-menu>
                        <div class="max-h-60 overflow-y-auto"></div>
                    </div>
                </div>

                <!-- Location Field -->
                <div class="relative" data-suggestion-wrapper>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Location</label>
                    <input
                        type="text"
                        name="location"
                        class="w-full border-2 border-slate-200 bg-white px-4 py-3 rounded-xl text-base font-medium text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-slate-900 transition"
                        placeholder="e.g. Mumbai"
                        value="{{ request('location') }}"
                        autocomplete="off"
                        data-suggestion-input="location"
                        data-modal-input
                    />
                    <div class="hidden absolute left-0 right-0 top-full z-50 mt-1 overflow-hidden rounded-lg border border-slate-200 bg-white shadow-lg" data-suggestion-menu="location" data-modal-menu>
                        <div class="max-h-60 overflow-y-auto"></div>
                    </div>
                </div>

                <!-- Experience Field -->
                <div class="relative">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Experience Level</label>
                    <select
                        name="experience_range_id[]"
                        class="w-full border-2 border-slate-200 bg-white px-4 py-3 rounded-xl text-base font-medium focus:outline-none focus:border-slate-900 cursor-pointer appearance-none transition"
                        style="color: {{ request('experience_range_id.0') ? '#0f172a' : '#94a3b8' }}"
                        onchange="this.style.color = this.value ? '#0f172a' : '#94a3b8'"
                    >
                        <option value="" style="color: #94a3b8;">Select experience level</option>
                        @foreach($experienceRanges as $range)
                            <option value="{{ $range->id }}" style="color: #0f172a;" {{ request('experience_range_id.0') == $range->id ? 'selected' : '' }}>
                                {{ $range->label }}
                            </option>
                        @endforeach
                    </select>
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-4 bottom-[14px] h-5 w-5 text-slate-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </div>

                <!-- Search Button -->
                <button
                    type="submit"
                    class="w-full px-6 py-4 bg-slate-900 text-white text-base font-bold rounded-xl transition hover:bg-slate-800 flex items-center justify-center gap-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Search Jobs
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Search autocomplete script loaded');
        
        const searchForms = document.querySelectorAll('form[action="{{ route('jobs') }}"]');
        if (!searchForms.length) {
            console.error('Search forms not found');
            return;
        }

        const suggestionUrl = '{{ route('jobs.suggestions') }}';
        console.log('Suggestion URL:', suggestionUrl);
        
        const cache = {};

        const fetchSuggestions = async (type, query) => {
            const key = `${type}:${query}`;
            if (cache[key]) {
                return cache[key];
            }

            try {
                const params = new URLSearchParams({ type, q: query });
                const url = `${suggestionUrl}?${params}`;
                console.log('Fetching:', url);
                
                const response = await fetch(url);
                if (!response.ok) {
                    console.error('Response not OK:', response.status);
                    return [];
                }

                const payload = await response.json();
                console.log('Received payload:', payload);
                cache[key] = payload.suggestions ?? [];
                return cache[key];
            } catch (error) {
                console.error('Error fetching suggestions:', error);
                return [];
            }
        };

        const closeMenu = (menu) => {
            menu.classList.add('hidden');
        };

        const openMenu = (menu) => {
            menu.classList.remove('hidden');
        };

        // Setup autocomplete for both desktop and mobile forms
        searchForms.forEach((searchForm) => {
            const containers = searchForm.querySelectorAll('[data-suggestion-wrapper]');
            console.log('Found suggestion wrappers:', containers.length, 'in form');
            
            containers.forEach((wrapper) => {
            const input = wrapper.querySelector('[data-suggestion-input]');
            const type = input ? input.dataset.suggestionInput : null;
            if (!type) {
                return;
            }

            console.log('Setting up autocomplete for:', type);

            const menu = wrapper.querySelector(`[data-suggestion-menu="${type}"]`);
            const list = menu?.querySelector('div');

            const render = async (query) => {
                if (!menu || !list) {
                    console.error('Menu or list not found for:', type);
                    return;
                }

                const trimmed = query.trim();
                
                // Don't fetch if query is empty
                if (trimmed.length === 0) {
                    closeMenu(menu);
                    return;
                }
                
                console.log(`Rendering suggestions for ${type}: "${trimmed}"`);
                const matches = await fetchSuggestions(type, trimmed);
                console.log(`Got ${matches.length} matches:`, matches);

                if (!matches || matches.length === 0) {
                    list.innerHTML = '<p class="px-4 py-2 text-xs text-slate-400">No matches found</p>';
                    openMenu(menu);
                    return;
                }

                list.innerHTML = matches
                    .map(item => {
                        if (type === 'location') {
                            // For location, format with city name and job count
                            const match = item.match(/^(.+?)\s*\((\d+)\s+jobs?\)$/i);
                            if (match) {
                                const cityName = match[1];
                                const jobCount = match[2];
                                return `<button type="button" class="w-full text-left px-4 py-2 text-sm hover:bg-slate-100 transition-colors flex justify-between items-center" data-suggestion-item="${type}" data-value="${item}">
                                    <span class="font-medium">${cityName}</span>
                                    <span class="text-xs text-slate-400">${jobCount} jobs</span>
                                </button>`;
                            }
                        }
                        return `<button type="button" class="w-full text-left px-4 py-2 text-sm hover:bg-slate-100 transition-colors" data-suggestion-item="${type}" data-value="${item}">${item}</button>`;
                    })
                    .join('');

                console.log('Opening menu for:', type);
                openMenu(menu);
            };

            input.addEventListener('focus', () => {
                console.log('Input focused:', type, 'value:', input.value);
                if (input.value.trim().length > 0) {
                    render(input.value);
                }
            });
            
            input.addEventListener('input', (event) => {
                console.log('Input changed:', type, 'value:', event.target.value);
                render(event.target.value);
            });

            input.addEventListener('keydown', (event) => {
                if (event.key === 'Escape') {
                    closeMenu(menu);
                }
            });

            menu.addEventListener('click', (event) => {
                const button = event.target.closest('[data-suggestion-item]');
                if (!button) {
                    return;
                }

                console.log('Suggestion clicked:', button.dataset.value);
                let value = button.dataset.value;
                
                // For location, extract just the city name (remove job count)
                if (type === 'location') {
                    value = value.replace(/\s*\(\d+\s+jobs?\)$/i, '').trim();
                }
                
                input.value = value;
                closeMenu(menu);
                input.focus();
            });

            document.addEventListener('click', (event) => {
                if (!wrapper.contains(event.target)) {
                    closeMenu(menu);
                }
            });
        });
        }); // End searchForms forEach
    });
</script>
@endpush