<div class="space-y-6">
    {{-- Step Progress Bar --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center justify-between mb-4">
            @for($i = 1; $i <= $totalSteps; $i++)
                <div class="flex flex-col items-center flex-1">
                    <button 
                        wire:click="goToStep({{ $i }})"
                        @class([
                            'w-10 h-10 rounded-full flex items-center justify-center text-sm font-semibold transition',
                            'bg-cyan-600 text-white' => $currentStep == $i,
                            'bg-green-600 text-white' => $i < $currentStep,
                            'bg-slate-200 text-slate-600' => $i > $currentStep,
                        ])
                        {{ $i > $currentStep ? 'disabled' : '' }}
                    >
                        @if($i < $currentStep)
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        @else
                            {{ $i }}
                        @endif
                    </button>
                    <span class="mt-2 text-xs font-medium text-slate-600 text-center">
                        @switch($i)
                            @case(1) Basic Info @break
                            @case(2) Location & Salary @break
                            @case(3) Skills @break
                            @case(4) Description @break
                            @case(5) Settings @break
                            @case(6) Preview @break
                        @endswitch
                    </span>
                </div>
                @if($i < $totalSteps)
                    <div @class([
                        'h-1 flex-1 mx-2 rounded',
                        'bg-green-600' => $i < $currentStep,
                        'bg-slate-200' => $i >= $currentStep,
                    ])></div>
                @endif
            @endfor
        </div>
    </div>

    <form wire:submit.prevent="submit" class="space-y-6">
        {{-- Step 1: Basic Job Information --}}
        @if($currentStep === 1)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-6">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">Basic Job Information</h2>
                    <p class="text-sm text-slate-500 mt-1">Enter the fundamental details about the job position</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Job Title *</label>
                        <div class="relative" x-data="{ open: @entangle('showSuggestions') }">
                            <input 
                                type="text" 
                                wire:model.live.debounce.300ms="title"
                                @click.away="$wire.hideSuggestions()"
                                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                                placeholder="e.g. Senior Software Engineer"
                                autocomplete="off"
                            >
                            
                            {{-- Autocomplete Dropdown --}}
                            <div 
                                x-show="open"
                                x-transition
                                class="absolute z-50 w-full mt-2 bg-white border border-slate-200 rounded-xl shadow-lg max-h-60 overflow-y-auto"
                            >
                                @if(!empty($jobRoleSuggestions))
                                    @foreach($jobRoleSuggestions as $role)
                                        <button
                                            type="button"
                                            wire:click="selectJobRole('{{ $role['label'] }}')"
                                            class="w-full text-left px-4 py-3 hover:bg-cyan-50 transition text-sm text-slate-700 hover:text-cyan-900 border-b border-slate-100 last:border-b-0"
                                        >
                                            <div class="flex items-center justify-between">
                                                <span class="font-medium">{{ $role['label'] }}</span>
                                                <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                                </svg>
                                            </div>
                                        </button>
                                    @endforeach
                                @endif
                            </div>
                            
                            {{-- Loading Indicator --}}
                            <div wire:loading wire:target="title" class="absolute right-3 top-3">
                                <svg class="animate-spin h-5 w-5 text-cyan-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                        </div>
                        @error('title') <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span> @enderror
                        <p class="text-xs text-slate-500 mt-1">Start typing to see job role suggestions</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Industry *</label>
                        <select 
                            wire:model="industry_id"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                        >
                            <option value="">Select Industry</option>
                            @foreach($industries as $industry)
                                <option value="{{ $industry->id }}">{{ $industry->label }}</option>
                            @endforeach
                        </select>
                        @error('industry_id') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Category *</label>
                        <select 
                            wire:model="category_id"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                        >
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->label }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Experience Level *</label>
                        <select 
                            wire:model="experience_range_id"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                        >
                            <option value="">Select Experience</option>
                            @foreach($experienceRanges as $range)
                                <option value="{{ $range->id }}">{{ $range->label }}</option>
                            @endforeach
                        </select>
                        @error('experience_range_id') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Number of Vacancies *</label>
                        <input 
                            type="number" 
                            wire:model="vacancies"
                            min="1"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                        >
                        @error('vacancies') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        @endif

        {{-- Step 2: Job Location & Salary --}}
        @if($currentStep === 2)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-6">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">Job Location & Salary</h2>
                    <p class="text-sm text-slate-500 mt-1">Specify where the job is located and compensation details</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">City *</label>
                        <select 
                            wire:model="city_id"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                        >
                            <option value="">Select City</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                            @endforeach
                        </select>
                        @error('city_id') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Work Mode *</label>
                        <div class="flex gap-4 mt-2">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" wire:model="work_mode" value="onsite" class="text-cyan-600 focus:ring-cyan-500">
                                <span class="text-sm text-slate-700">On-site</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" wire:model="work_mode" value="hybrid" class="text-cyan-600 focus:ring-cyan-500">
                                <span class="text-sm text-slate-700">Hybrid</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" wire:model="work_mode" value="remote" class="text-cyan-600 focus:ring-cyan-500">
                                <span class="text-sm text-slate-700">Remote</span>
                            </label>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Employment Type *</label>
                        <select 
                            wire:model="employment_type_id"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                        >
                            <option value="">Select Type</option>
                            @foreach($employmentTypes as $type)
                                <option value="{{ $type->id }}">{{ $type->label }}</option>
                            @endforeach
                        </select>
                        @error('employment_type_id') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">Salary Range</label>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <input 
                                    type="number" 
                                    wire:model="min_salary"
                                    placeholder="Minimum Salary"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                                >
                                @error('min_salary') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <input 
                                    type="number" 
                                    wire:model="max_salary"
                                    placeholder="Maximum Salary"
                                    class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                                >
                                @error('max_salary') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Step 3: Skills & Requirements --}}
        @if($currentStep === 3)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-6">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">Skills & Requirements</h2>
                    <p class="text-sm text-slate-500 mt-1">Define the qualifications and skills needed for this role</p>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Education Level</label>
                        <select 
                            wire:model="education_level_id"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                        >
                            <option value="">Select Education Level</option>
                            @foreach($educationLevels as $level)
                                <option value="{{ $level->id }}">{{ $level->label }}</option>
                            @endforeach
                        </select>
                        @error('education_level_id') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Experience Details</label>
                        <textarea 
                            wire:model="experience_details"
                            rows="3"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                            placeholder="E.g., 3+ years of experience in full-stack development..."
                        ></textarea>
                        @error('experience_details') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Required Skills</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-3 max-h-64 overflow-y-auto p-4 border border-slate-200 rounded-xl">
                            @foreach($skills as $skill)
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        wire:model="selectedSkills" 
                                        value="{{ $skill->id }}"
                                        class="rounded text-cyan-600 focus:ring-cyan-500"
                                    >
                                    <span class="text-sm text-slate-700">{{ $skill->label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Certifications</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 max-h-64 overflow-y-auto p-4 border border-slate-200 rounded-xl">
                            @foreach($certificates as $cert)
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <input 
                                        type="checkbox" 
                                        wire:model="selectedCertificates" 
                                        value="{{ $cert->id }}"
                                        class="rounded text-cyan-600 focus:ring-cyan-500"
                                    >
                                    <span class="text-sm text-slate-700">{{ $cert->label }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Step 4: Job Description --}}
        @if($currentStep === 4)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-6">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">Job Description</h2>
                    <p class="text-sm text-slate-500 mt-1">Provide detailed information about the role</p>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Job Description *</label>
                        <textarea 
                            wire:model="description"
                            rows="6"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                            placeholder="Provide a comprehensive description of the job role..."
                        ></textarea>
                        @error('description') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Requirements</label>
                        <textarea 
                            wire:model="requirements"
                            rows="5"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                            placeholder="List the key requirements for this position..."
                        ></textarea>
                        @error('requirements') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">Responsibilities</label>
                        <textarea 
                            wire:model="responsibilities"
                            rows="5"
                            class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                            placeholder="Outline the main responsibilities of this role..."
                        ></textarea>
                        @error('responsibilities') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
        @endif

        {{-- Step 5: Settings --}}
        @if($currentStep === 5)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-6">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">Job Settings</h2>
                    <p class="text-sm text-slate-500 mt-1">Configure visibility and publishing options</p>
                </div>
                
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Publish Date</label>
                            <input 
                                type="date" 
                                wire:model="published_at"
                                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                            >
                            @error('published_at') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-2">Expiry Date</label>
                            <input 
                                type="date" 
                                wire:model="expires_at"
                                class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-cyan-400 focus:outline-none focus:ring-2 focus:ring-cyan-100"
                            >
                            @error('expires_at') <span class="text-xs text-red-600 mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input 
                                type="checkbox" 
                                wire:model="is_active"
                                class="rounded text-cyan-600 focus:ring-cyan-500 w-5 h-5"
                            >
                            <div>
                                <span class="text-sm font-medium text-slate-700">Active</span>
                                <p class="text-xs text-slate-500">Make this job visible to candidates</p>
                            </div>
                        </label>
                        
                        <label class="flex items-center space-x-3 cursor-pointer">
                            <input 
                                type="checkbox" 
                                wire:model="is_featured"
                                class="rounded text-cyan-600 focus:ring-cyan-500 w-5 h-5"
                            >
                            <div>
                                <span class="text-sm font-medium text-slate-700">Featured</span>
                                <p class="text-xs text-slate-500">Highlight this job listing</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        @endif

        {{-- Step 6: Preview --}}
        @if($currentStep === 6)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 space-y-6">
                <div>
                    <h2 class="text-xl font-semibold text-slate-900">Preview Job Post</h2>
                    <p class="text-sm text-slate-500 mt-1">Review all information before publishing</p>
                </div>
                
                <div class="space-y-6">
                    {{-- Basic Information --}}
                    <div class="border-b border-slate-200 pb-4">
                        <h3 class="text-sm font-semibold text-slate-900 mb-3">Basic Information</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-xs text-slate-500">Job Title</dt>
                                <dd class="text-sm font-medium text-slate-900">{{ $title }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-slate-500">Industry</dt>
                                <dd class="text-sm font-medium text-slate-900">{{ $industries->find($industry_id)?->label ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-slate-500">Category</dt>
                                <dd class="text-sm font-medium text-slate-900">{{ $categories->find($category_id)?->label ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-slate-500">Experience</dt>
                                <dd class="text-sm font-medium text-slate-900">{{ $experienceRanges->find($experience_range_id)?->label ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-slate-500">Vacancies</dt>
                                <dd class="text-sm font-medium text-slate-900">{{ $vacancies }}</dd>
                            </div>
                        </dl>
                    </div>
                    
                    {{-- Location & Salary --}}
                    <div class="border-b border-slate-200 pb-4">
                        <h3 class="text-sm font-semibold text-slate-900 mb-3">Location & Salary</h3>
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <dt class="text-xs text-slate-500">City</dt>
                                <dd class="text-sm font-medium text-slate-900">{{ $cities->find($city_id)?->name ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-slate-500">Work Mode</dt>
                                <dd class="text-sm font-medium text-slate-900">{{ ucfirst($work_mode) }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-slate-500">Employment Type</dt>
                                <dd class="text-sm font-medium text-slate-900">{{ $employmentTypes->find($employment_type_id)?->label ?? 'N/A' }}</dd>
                            </div>
                            <div>
                                <dt class="text-xs text-slate-500">Salary Range</dt>
                                <dd class="text-sm font-medium text-slate-900">
                                    @if($min_salary || $max_salary)
                                        ${{ number_format($min_salary ?? 0) }} - ${{ number_format($max_salary ?? 0) }}
                                    @else
                                        Not specified
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                    
                    {{-- Skills & Education --}}
                    <div class="border-b border-slate-200 pb-4">
                        <h3 class="text-sm font-semibold text-slate-900 mb-3">Skills & Requirements</h3>
                        <dl class="space-y-3">
                            @if($education_level_id)
                                <div>
                                    <dt class="text-xs text-slate-500">Education</dt>
                                    <dd class="text-sm font-medium text-slate-900">{{ $educationLevels->find($education_level_id)?->label ?? 'N/A' }}</dd>
                                </div>
                            @endif
                            @if(!empty($selectedSkills))
                                <div>
                                    <dt class="text-xs text-slate-500 mb-2">Skills</dt>
                                    <dd class="flex flex-wrap gap-2">
                                        @foreach($selectedSkills as $skillId)
                                            <span class="inline-flex items-center rounded-full bg-cyan-100 px-3 py-1 text-xs font-medium text-cyan-800">
                                                {{ $skills->find($skillId)?->label }}
                                            </span>
                                        @endforeach
                                    </dd>
                                </div>
                            @endif
                            @if(!empty($selectedCertificates))
                                <div>
                                    <dt class="text-xs text-slate-500 mb-2">Certifications</dt>
                                    <dd class="flex flex-wrap gap-2">
                                        @foreach($selectedCertificates as $certId)
                                            <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-800">
                                                {{ $certificates->find($certId)?->label }}
                                            </span>
                                        @endforeach
                                    </dd>
                                </div>
                            @endif
                        </dl>
                    </div>
                    
                    {{-- Description --}}
                    <div>
                        <h3 class="text-sm font-semibold text-slate-900 mb-3">Job Description</h3>
                        <div class="prose prose-sm max-w-none">
                            <p class="text-sm text-slate-700 whitespace-pre-line">{{ $description }}</p>
                            @if($requirements)
                                <h4 class="text-sm font-semibold text-slate-900 mt-4 mb-2">Requirements</h4>
                                <p class="text-sm text-slate-700 whitespace-pre-line">{{ $requirements }}</p>
                            @endif
                            @if($responsibilities)
                                <h4 class="text-sm font-semibold text-slate-900 mt-4 mb-2">Responsibilities</h4>
                                <p class="text-sm text-slate-700 whitespace-pre-line">{{ $responsibilities }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- Navigation Buttons --}}
        <div class="flex justify-between items-center bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <button
                type="button"
                wire:click="previousStep"
                @if($currentStep === 1) disabled @endif
                class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-6 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 disabled:opacity-50 disabled:cursor-not-allowed"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Previous
            </button>
            
            <div class="text-sm text-slate-600">
                Step {{ $currentStep }} of {{ $totalSteps }}
            </div>
            
            @if($currentStep < $totalSteps)
                <button
                    type="button"
                    wire:click="nextStep"
                    class="inline-flex items-center gap-2 rounded-xl border border-transparent bg-cyan-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-cyan-500"
                >
                    Next
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            @else
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-xl border border-transparent bg-green-600 px-6 py-3 text-sm font-semibold text-white transition hover:bg-green-500"
                >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                    </svg>
                    Publish Job
                </button>
            @endif
        </div>
    </form>
</div>
