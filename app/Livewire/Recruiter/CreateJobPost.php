<?php

namespace App\Livewire\Recruiter;

use Livewire\Component;
use App\Models\Industry;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\EmploymentType;
use App\Models\ExperienceRange;
use App\Models\EducationLevel;
use App\Models\Certificate;
use App\Models\Skill;
use App\Models\JobPost;
use App\Models\JobRole;
use App\Models\Recruiter;
use Illuminate\Support\Facades\Auth;

class CreateJobPost extends Component
{
    // Current step
    public $currentStep = 1;
    public $totalSteps = 6;
    
    // Step 1: Basic Job Information
    public $title = '';
    public $jobRoleSuggestions = [];
    public $showSuggestions = false;
    public $industry_id = '';
    public $category_id = '';
    public $experience_range_id = '';
    public $vacancies = 1;
    
    // Step 2: Job Location & Salary
    public $city_id = '';
    public $country_id = '';
    public $employment_type_id = '';
    public $min_salary = '';
    public $max_salary = '';
    public $is_remote = false;
    public $work_mode = 'onsite';
    
    // Step 3: Skills & Requirements
    public $education_level_id = '';
    public $experience_details = '';
    public $selectedSkills = [];
    public $selectedCertificates = [];
    
    // Step 4: Job Description
    public $description = '';
    public $requirements = '';
    public $responsibilities = '';
    
    // Step 5: Settings
    public $is_featured = false;
    public $is_active = true;
    public $published_at = '';
    public $expires_at = '';
    
    public function mount()
    {
        $this->published_at = now()->format('Y-m-d');
        $this->expires_at = now()->addDays(30)->format('Y-m-d');
    }
    
    public function updatedTitle($value)
    {
        if (strlen($value) >= 2) {
            $this->jobRoleSuggestions = JobRole::where('is_active', true)
                ->where('label', 'ILIKE', '%' . $value . '%')
                ->orderBy('label')
                ->limit(10)
                ->get(['id', 'label', 'category_id'])
                ->toArray();
            $this->showSuggestions = count($this->jobRoleSuggestions) > 0;
        } else {
            $this->jobRoleSuggestions = [];
            $this->showSuggestions = false;
        }
    }
    
    public function selectJobRole($roleLabel)
    {
        $this->title = $roleLabel;
        $this->showSuggestions = false;
        $this->jobRoleSuggestions = [];
    }
    
    public function hideSuggestions()
    {
        $this->showSuggestions = false;
    }
    
    public function nextStep()
    {
        $this->validateCurrentStep();
        
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }
    
    public function previousStep()
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }
    
    public function goToStep($step)
    {
        if ($step >= 1 && $step <= $this->currentStep) {
            $this->currentStep = $step;
        }
    }
    
    public function validateCurrentStep()
    {
        $rules = match($this->currentStep) {
            1 => [
                'title' => 'required|string|max:255',
                'industry_id' => 'required|exists:industries,id',
                'category_id' => 'required|exists:categories,id',
                'experience_range_id' => 'required|exists:experience_ranges,id',
                'vacancies' => 'required|integer|min:1'
            ],
            2 => [
                'city_id' => 'required|exists:cities,id',
                'employment_type_id' => 'required|exists:employment_types,id',
                'min_salary' => 'nullable|integer|min:0',
                'max_salary' => 'nullable|integer|min:0|gte:min_salary'
            ],
            3 => [
                'education_level_id' => 'nullable|exists:education_levels,id',
                'experience_details' => 'nullable|string|max:1000'
            ],
            4 => [
                'description' => 'required|string|min:50',
                'requirements' => 'nullable|string',
                'responsibilities' => 'nullable|string'
            ],
            5 => [
                'published_at' => 'nullable|date',
                'expires_at' => 'nullable|date|after:published_at'
            ],
            default => []
        };
        
        $this->validate($rules);
    }
    
    public function submit()
    {
        // Validate all steps
        for ($i = 1; $i <= 5; $i++) {
            $this->currentStep = $i;
            $this->validateCurrentStep();
        }
        
        // Get current recruiter
        $recruiter = Recruiter::where('user_id', Auth::id())->firstOrFail();
        
        // Create job post
        $jobPost = JobPost::create([
            'title' => $this->title,
            'company_id' => $recruiter->company_id,
            'recruiter_id' => $recruiter->id,
            'industry_id' => $this->industry_id,
            'category_id' => $this->category_id,
            'city_id' => $this->city_id,
            'employment_type_id' => $this->employment_type_id,
            'experience_range_id' => $this->experience_range_id,
            'min_salary' => $this->min_salary,
            'max_salary' => $this->max_salary,
            'is_remote' => $this->work_mode === 'remote',
            'is_featured' => $this->is_featured,
            'is_active' => $this->is_active,
            'job_status_id' => 1,
            'published_at' => $this->published_at,
            'expires_at' => $this->expires_at,
        ]);
        
        // Create job post details
        $jobPost->detail()->create([
            'description' => $this->description,
            'requirements' => $this->requirements,
            'responsibilities' => $this->responsibilities,
        ]);
        
        // Attach skills
        if (!empty($this->selectedSkills)) {
            foreach ($this->selectedSkills as $skillId) {
                $jobPost->skills()->attach($skillId);
            }
        }
        
        // Attach certifications
        if (!empty($this->selectedCertificates)) {
            foreach ($this->selectedCertificates as $certId) {
                $jobPost->certifications()->attach($certId);
            }
        }
        
        session()->flash('success', 'Job post created successfully!');
        return redirect()->route('recruiter.job-posts.index');
    }
    
    public function render()
    {
        return view('livewire.recruiter.create-job-post', [
            'industries' => Industry::where('is_active', true)->orderBy('label')->get(),
            'categories' => Category::where('is_active', true)->orderBy('label')->get(),
            'cities' => City::orderBy('name')->get(),
            'countries' => Country::orderBy('name')->get(),
            'employmentTypes' => EmploymentType::where('is_active', true)->orderBy('label')->get(),
            'experienceRanges' => ExperienceRange::where('is_active', true)->orderBy('sort_order')->get(),
            'educationLevels' => EducationLevel::where('is_active', true)->orderBy('sort_order')->get(),
            'certificates' => Certificate::where('is_active', true)->orderBy('label')->get(),
            'skills' => Skill::where('is_active', true)->orderBy('label')->get(),
        ]);
    }
}
