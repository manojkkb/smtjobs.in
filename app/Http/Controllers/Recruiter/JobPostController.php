<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\EmploymentType;
use App\Models\ExperienceRange;
use App\Models\Industry;
use App\Models\JobPost;
use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class JobPostController extends Controller
{
    public function index(Request $request)
    {
        $recruiter = $this->currentRecruiter();

        $jobPosts = JobPost::with(['profile', 'category', 'industry', 'city', 'employmentType', 'experienceRange'])
            ->where('recruiter_id', $recruiter->id)
            ->latest('created_at')
            ->paginate(12);

        return view('recruiter.job-posts.index', compact('jobPosts'));
    }

    public function create()
    {
        return view('recruiter.job-posts.create', array_merge($this->formOptions(), [
            'jobPost' => new JobPost(),
        ]));
    }

    public function store(Request $request)
    {
        $recruiter = $this->currentRecruiter();
        $payload = $request->validate($this->validationRules());

        $jobPost = JobPost::create(array_merge($this->extractJobPostAttributes($payload, $request), [
            'company_id' => $recruiter->company_id,
            'recruiter_id' => $recruiter->id,
        ]));

        $jobPost->profile()->create(Arr::only($payload, array_keys($this->profileRules())));

        return redirect()->route('recruiter.job-posts.index')->with('success', 'Job published successfully.');
    }

    public function show(JobPost $jobPost)
    {
        $this->authorizeOwnership($jobPost);

        $jobPost->load(['profile', 'category', 'industry', 'city', 'employmentType', 'experienceRange', 'company']);

        return view('recruiter.job-posts.show', compact('jobPost'));
    }

    public function edit(JobPost $jobPost)
    {
        $this->authorizeOwnership($jobPost);

        return view('recruiter.job-posts.edit', array_merge($this->formOptions(), [
            'jobPost' => $jobPost->load('profile'),
        ]));
    }

    public function update(Request $request, JobPost $jobPost)
    {
        $this->authorizeOwnership($jobPost);

        $payload = $request->validate($this->validationRules());

        $jobPost->update($this->extractJobPostAttributes($payload, $request));
        $jobPost->profile()->updateOrCreate(['job_post_id' => $jobPost->id], Arr::only($payload, array_keys($this->profileRules())));

        return redirect()->route('recruiter.job-posts.index')->with('success', 'Job updated successfully.');
    }

    public function destroy(JobPost $jobPost)
    {
        $this->authorizeOwnership($jobPost);

        $jobPost->delete();

        return back()->with('success', 'Job removed.');
    }

    protected function currentRecruiter(): Recruiter
    {
        $recruiter = Recruiter::where('user_id', Auth::id())->first();
        
        if (!$recruiter) {
            abort(403, 'You need to complete your recruiter profile first.');
        }
        
        return $recruiter;
    }

    protected function authorizeOwnership(JobPost $jobPost): Recruiter
    {
        $recruiter = $this->currentRecruiter();

        if ($jobPost->recruiter_id !== $recruiter->id) {
            abort(403);
        }

        return $recruiter;
    }

    protected function validationRules(): array
    {
        return array_merge($this->jobPostRules(), $this->profileRules());
    }

    protected function jobPostRules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'industry_id' => 'nullable|exists:industries,id',
            'category_id' => 'nullable|exists:categories,id',
            'city_id' => 'nullable|exists:cities,id',
            'employment_type_id' => 'nullable|exists:employment_types,id',
            'experience_range_id' => 'nullable|exists:experience_ranges,id',
            'min_salary' => 'nullable|integer|min:0',
            'max_salary' => 'nullable|integer|min:0',
            'is_remote' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'published_at' => 'nullable|date',
            'expires_at' => 'nullable|date',
        ];
    }

    protected function profileRules(): array
    {
        return [
            'description' => 'required|string',
            'requirements' => 'nullable|string',
            'responsibilities' => 'nullable|string',
        ];
    }

    protected function extractJobPostAttributes(array $payload, Request $request): array
    {
        $data = Arr::only($payload, array_keys($this->jobPostRules()));

        $data['is_remote'] = $request->boolean('is_remote');
        $data['is_featured'] = $request->boolean('is_featured');
        $data['is_active'] = $request->boolean('is_active', true);

        return $data;
    }

    protected function formOptions(): array
    {
        return [
            'industries' => Industry::orderBy('label')->get(['id', 'label as name']),
            'categories' => Category::orderBy('label')->get(['id', 'label as name']),
            'cities' => City::orderBy('name')->get(['id', 'name']),
            'employmentTypes' => EmploymentType::orderBy('label')->get(['id', 'label as name']),
            'experienceRanges' => ExperienceRange::orderBy('label')->get(['id', 'label as name']),
        ];
    }
}
