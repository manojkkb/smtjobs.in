<div x-data="{ searchModalOpen: false }" class="mt-4">
    <!-- Mobile Search Trigger (visible only on mobile) -->
    <button 
        type="button"
        @click="searchModalOpen = true"
        class="md:hidden w-full flex items-center gap-3 rounded-2xl bg-white border-2 border-slate-200 shadow-lg px-6 py-4 text-left"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
        <span class="text-base text-slate-400 font-medium">Search jobs</span>
    </button>

    <!-- Desktop Search Form (visible only on desktop) -->
    <form action="<?php echo e(route('jobs')); ?>" method="GET" class="hidden md:block">
        <div class="flex items-center gap-0 rounded-xl bg-white shadow-md hover:shadow-lg transition-shadow">
        <!-- Keyword Field -->
        <div class="flex-1 relative" data-suggestion-wrapper>
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <input
                    type="text"
                    name="keyword"
                    id="keywordInput"
                    class="w-full border-0 bg-transparent pl-9 pr-10 py-2.5 text-sm font-medium text-slate-900 placeholder:text-slate-500 focus:outline-none rounded-l-xl"
                    placeholder="Job title or keyword"
                    value="<?php echo e(request('keyword')); ?>"
                    autocomplete="off"
                    data-suggestion-input="keyword"
                />
                <button type="button" class="hidden absolute right-2 top-1/2 -translate-y-1/2 p-1 hover:bg-slate-100 rounded-full transition" data-clear-keyword>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="hidden absolute left-0 right-0 top-full z-50 mt-2 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-2xl" data-suggestion-menu="keyword">
                <div class="max-h-80 overflow-y-auto"></div>
            </div>
        </div>
        
        <!-- Separator -->
        <div class="h-8 w-px bg-slate-200"></div>
        
        <!-- Location Field -->
        <div class="flex-1 relative" data-suggestion-wrapper>
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <input
                    type="text"
                    name="location"
                    class="w-full border-0 bg-transparent pl-9 pr-10 py-2.5 text-sm font-medium text-slate-900 placeholder:text-slate-500 focus:outline-none"
                    placeholder="City or location"
                    value="<?php echo e(request('location')); ?>"
                    autocomplete="off"
                    data-suggestion-input="location"
                />
                <button type="button" class="hidden absolute right-2 top-1/2 -translate-y-1/2 p-1 hover:bg-slate-100 rounded-full transition" data-clear-location>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="hidden absolute left-0 right-0 top-full z-50 mt-2 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-2xl" data-suggestion-menu="location">
                <div class="max-h-80 overflow-y-auto"></div>
            </div>
        </div>
        
        <!-- Separator -->
        <div class="h-8 w-px bg-slate-200"></div>
        
        <!-- Experience Field -->
        <div class="flex-1 relative">
            <select
                name="experience_range_id[]"
                class="w-full border-0 bg-transparent px-4 py-2.5 text-sm font-medium focus:outline-none cursor-pointer appearance-none"
                style="color: <?php echo e(request('experience_range_id.0') ? '#0f172a' : '#64748b'); ?>"
                onchange="this.style.color = this.value ? '#0f172a' : '#64748b'"
            >
                <option value="" style="color: #64748b;">Experience</option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $experienceRanges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $range): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                    <option value="<?php echo e($range->id); ?>" style="color: #0f172a;" <?php echo e(request('experience_range_id.0') == $range->id ? 'selected' : ''); ?>>
                        <?php echo e($range->label); ?>

                    </option>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </select>
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
        
        <!-- Search Button -->
        <button
            type="submit"
            class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-bold transition-all hover:from-indigo-700 hover:to-purple-700 hover:shadow-lg flex items-center gap-2 rounded-r-xl"
        >
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
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
            <form action="<?php echo e(route('jobs')); ?>" method="GET" class="p-6 space-y-4">
                <!-- Keyword Field -->
                <div class="relative" data-suggestion-wrapper>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Job Title or Keyword</label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <input
                            type="text"
                            name="keyword"
                            class="w-full border-2 border-slate-200 bg-white pl-10 pr-12 py-3 rounded-xl text-base font-medium text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-slate-900 transition"
                            placeholder="e.g. Software Engineer"
                            value="<?php echo e(request('keyword')); ?>"
                            autocomplete="off"
                            data-suggestion-input="keyword"
                            data-modal-input
                        />
                        <button type="button" class="hidden absolute right-3 top-1/2 -translate-y-1/2 p-1 hover:bg-slate-100 rounded-full transition" data-clear-keyword>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="hidden absolute left-0 right-0 top-full z-50 mt-2 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-2xl" data-suggestion-menu="keyword" data-modal-menu>
                        <div class="max-h-80 overflow-y-auto"></div>
                    </div>
                </div>

                <!-- Location Field -->
                <div class="relative" data-suggestion-wrapper>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Location</label>
                    <div class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400 pointer-events-none" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <input
                            type="text"
                            name="location"
                            class="w-full border-2 border-slate-200 bg-white pl-10 pr-12 py-3 rounded-xl text-base font-medium text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-slate-900 transition"
                            placeholder="e.g. Mumbai"
                            value="<?php echo e(request('location')); ?>"
                            autocomplete="off"
                            data-suggestion-input="location"
                            data-modal-input
                        />
                        <button type="button" class="hidden absolute right-3 top-1/2 -translate-y-1/2 p-1 hover:bg-slate-100 rounded-full transition" data-clear-location>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="hidden absolute left-0 right-0 top-full z-50 mt-2 overflow-hidden rounded-xl border border-slate-200 bg-white shadow-2xl" data-suggestion-menu="location" data-modal-menu>
                        <div class="max-h-80 overflow-y-auto"></div>
                    </div>
                </div>

                <!-- Experience Field -->
                <div class="relative">
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Experience Level</label>
                    <select
                        name="experience_range_id[]"
                        class="w-full border-2 border-slate-200 bg-white px-4 py-3 rounded-xl text-base font-medium focus:outline-none focus:border-slate-900 cursor-pointer appearance-none transition"
                        style="color: <?php echo e(request('experience_range_id.0') ? '#0f172a' : '#94a3b8'); ?>"
                        onchange="this.style.color = this.value ? '#0f172a' : '#94a3b8'"
                    >
                        <option value="" style="color: #94a3b8;">Select experience level</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $experienceRanges; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $range): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoop($loop->index); ?><?php endif; ?>
                            <option value="<?php echo e($range->id); ?>" style="color: #0f172a;" <?php echo e(request('experience_range_id.0') == $range->id ? 'selected' : ''); ?>>
                                <?php echo e($range->label); ?>

                            </option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
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

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        console.log('Search autocomplete script loaded');
        
        const searchForms = document.querySelectorAll('form[action="<?php echo e(route('jobs')); ?>"]');
        if (!searchForms.length) {
            console.error('Search forms not found');
            return;
        }

        const suggestionUrl = '<?php echo e(route('jobs.suggestions')); ?>';
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
            let justSelected = false;

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
                    list.innerHTML = `<div class="px-5 py-8 text-center">
                        <div class="inline-flex items-center justify-center w-12 h-12 bg-slate-100 rounded-full mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <p class="text-sm font-semibold text-slate-700 mb-1">No matches found</p>
                        <p class="text-xs text-slate-500">Try a different search term</p>
                    </div>`;
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
                                return `<button type="button" class="w-full text-left px-5 py-3.5 hover:bg-slate-50 transition-all duration-150 border-b border-slate-100 last:border-0 group" data-suggestion-item="${type}" data-value="${item}">
                                    <div class="flex items-center justify-between gap-3">
                                        <div class="flex items-center gap-3">
                                            <div class="flex-shrink-0 w-9 h-9 bg-slate-100 rounded-lg flex items-center justify-center group-hover:bg-slate-900 transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                            </div>
                                            <div>
                                                <span class="font-semibold text-slate-900 text-sm block group-hover:text-slate-900">${cityName}</span>
                                                <span class="text-xs text-slate-500">${jobCount} available jobs</span>
                                            </div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-300 group-hover:text-slate-900 transition-all group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </button>`;
                            }
                        }
                        // For keyword suggestions (job roles)
                        return `<button type="button" class="w-full text-left px-5 py-3.5 hover:bg-slate-50 transition-all duration-150 border-b border-slate-100 last:border-0 group" data-suggestion-item="${type}" data-value="${item}">
                            <div class="flex items-center justify-between gap-3">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0 w-9 h-9 bg-slate-100 rounded-lg flex items-center justify-center group-hover:bg-slate-900 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-600 group-hover:text-white transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <span class="font-semibold text-slate-900 text-sm group-hover:text-slate-900">${item}</span>
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-300 group-hover:text-slate-900 transition-all group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                </svg>
                            </div>
                        </button>`;
                    })
                    .join('');

                console.log('Opening menu for:', type);
                openMenu(menu);
            };

            input.addEventListener('focus', () => {
                console.log('Input focused:', type, 'value:', input.value);
                if (justSelected) {
                    justSelected = false;
                    return;
                }
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
                justSelected = true;
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

        // Clear button functionality
        const setupClearButtons = () => {
            document.querySelectorAll('[data-clear-keyword], [data-clear-location]').forEach(clearBtn => {
                const input = clearBtn.previousElementSibling || clearBtn.parentElement.querySelector('input');
                const type = clearBtn.dataset.clearKeyword !== undefined ? 'keyword' : 'location';
                
                // Show/hide clear button based on input value
                const toggleClearButton = () => {
                    if (input.value.trim().length > 0) {
                        clearBtn.classList.remove('hidden');
                    } else {
                        clearBtn.classList.add('hidden');
                    }
                };
                
                // Initial check
                toggleClearButton();
                
                // Monitor input changes
                input.addEventListener('input', toggleClearButton);
                
                // Clear input when button is clicked
                clearBtn.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    input.value = '';
                    clearBtn.classList.add('hidden');
                    input.focus();
                    
                    // Close suggestion menu
                    const wrapper = input.closest('[data-suggestion-wrapper]');
                    if (wrapper) {
                        const menu = wrapper.querySelector('[data-suggestion-menu]');
                        if (menu) {
                            closeMenu(menu);
                        }
                    }
                });
            });
        };
        
        setupClearButtons();
    });
</script>
<?php $__env->stopPush(); ?><?php /**PATH D:\smtjobs\resources\views/website/components/search.blade.php ENDPATH**/ ?>