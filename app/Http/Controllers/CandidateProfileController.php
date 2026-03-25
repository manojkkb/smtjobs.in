<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Candidate;
use App\Models\EducationLevel;
use App\Models\EducationDegree;
use App\Models\EducationSpecialization;
use App\Models\Skill;
use App\Models\Language;
use App\Models\Certificate;
use App\Models\City;
use App\Models\CandidateProfile;
use App\Models\JobApplication;
use App\Models\SavedJob;
use App\Models\ApplicationStatus;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\JobPost;
use App\Models\Recruiter;

class CandidateProfileController extends Controller
{
    public function show()
    {
        // Get authenticated user
        $user = Auth::user();
        
        // Get candidate with all relationships
        $candidate = Candidate::with([
            'profile',
            'education.level',
            'education.degree',
            'education.specialization',
            'experiences',
            'skills.skill',
            'languages.language',
            'certifications',
            'user',
            'city.state.country'
        ])->where('user_id', $user->id)->first();

        // Calculate profile completion percentage
        $profileCompletion = $this->calculateProfileCompletion($candidate);

        // Load education master data for dropdowns
        $educationLevels = EducationLevel::where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        // Load skills for dropdown
        $skills = Skill::where('is_active', true)
            ->orderBy('label')
            ->get();

        // Load languages for dropdown
        $languages = Language::where('is_active', true)
            ->orderBy('name')
            ->get();

        // Load certificates for dropdown
        $certificates = Certificate::where('is_active', true)
            ->orderBy('label')
            ->get();

        // Load cities for dropdown
        $cities = City::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('candidate.profile', compact('candidate', 'profileCompletion', 'educationLevels', 'skills', 'languages', 'certificates', 'cities'));
    }

    private function calculateProfileCompletion($candidate)
    {
        $totalSections = 7;
        $completedSections = 0;

        // Check profile
        if ($candidate->profile && $candidate->profile->first_name) {
            $completedSections++;
        }

        // Check education
        if ($candidate->education && $candidate->education->count() > 0) {
            $completedSections++;
        }

        // Check experience
        if ($candidate->experiences && $candidate->experiences->count() > 0) {
            $completedSections++;
        }

        // Check skills
        if ($candidate->skills && $candidate->skills->count() > 0) {
            $completedSections++;
        }

        // Check languages
        if ($candidate->languages && $candidate->languages->count() > 0) {
            $completedSections++;
        }

        // Check certifications
        if ($candidate->certifications && $candidate->certifications->count() > 0) {
            $completedSections++;
        }

        // Check resume
        if ($candidate->profile && $candidate->profile->resume_path) {
            $completedSections++;
        }

        return [
            'percentage' => round(($completedSections / $totalSections) * 100),
            'completed' => $completedSections,
            'total' => $totalSections,
        ];
    }
    public function completeProfile()
    {
        $user = Auth::user();
        $candidate = Candidate::with(['profile', 'city', 'education.level', 'education.degree', 'education.specialization'])
            ->where('user_id', $user->id)
            ->firstOrCreate(
                ['user_id' => $user->id],
                ['open_to_work' => true]
            );

        // Get cities and states for location dropdown
        $cities = City::where('is_active', true)->orderBy('name')->get();
        
        // Get education data for cascading dropdowns
        $educationLevels = EducationLevel::where('is_active', true)->orderBy('sort_order')->orderBy('label')->get();
        $educationDegrees = EducationDegree::with('educationLevel')->orderBy('sort_order')->orderBy('label')->get();
        $educationSpecializations = EducationSpecialization::with('degree')->orderBy('sort_order')->orderBy('label')->get();
        
        return view('candidate.complete-profile', compact('candidate', 'cities', 'educationLevels', 'educationDegrees', 'educationSpecializations'));
    }

    public function storeBasicDetails(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:male,female,other',
        ]);

        
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        // Split full name into first and last name
        $nameParts = explode(' ', $validated['full_name'], 2);
        $profileData = [
            'first_name' => $nameParts[0],
            'last_name' => isset($nameParts[1]) ? $nameParts[1] : null,
            'date_of_birth' => $validated['date_of_birth'],
            'gender' => $validated['gender'],
        ];

        // Update profile
        $candidate->profile()->updateOrCreate(
            ['candidate_id' => $candidate->id],
            $profileData
        );

        return response()->json(['success' => true, 'message' => 'Basic details saved successfully']);
    }

    public function storeLocation(Request $request)
    {
        $validated = $request->validate([
            'city_id' => 'required|exists:cities,id',
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();
        $candidate->update(['city_id' => $validated['city_id']]);

        return response()->json(['success' => true, 'message' => 'Location saved successfully']);
    }

    public function storeExperience(Request $request)
    {
        $validated = $request->validate([
            'experiences' => 'required|array|min:1',
            'experiences.*.company_name' => 'required|string|max:255',
            'experiences.*.designation' => 'required|string|max:255',
            'experiences.*.start_date' => 'required|date',
            'experiences.*.end_date' => 'nullable|date|after:start_date',
            'experiences.*.is_current' => 'boolean',
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        // Delete existing experiences
        $candidate->experiences()->delete();

        // Create new experiences
        foreach ($validated['experiences'] as $experience) {
            $candidate->experiences()->create($experience);
        }

        return response()->json(['success' => true, 'message' => 'Experience saved successfully']);
    }

    public function storeEducation(Request $request)
    {
        $validated = $request->validate([
            'education' => 'required|array|min:1',
            'education.*.level' => 'required|integer|exists:education_levels,id',
            'education.*.degree' => 'required|integer|exists:education_degrees,id',
            'education.*.specialization' => 'nullable|integer|exists:education_specializations,id',
            'education.*.institution' => 'required|string|max:255',
            'education.*.passing_year' => 'required|integer|min:1950|max:' . (date('Y') + 10),
            'education.*.percentage' => 'nullable|numeric|min:0|max:100',
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        // Delete existing education
        $candidate->education()->delete();

        // Create new education
        foreach ($validated['education'] as $edu) {
            $candidate->education()->create([
                'education_level_id' => $edu['level'],
                'education_degree_id' => $edu['degree'],
                'education_specialization_id' => $edu['specialization'] ?? null,
                'institute_name' => $edu['institution'],
                'passing_year' => $edu['passing_year'],
                'percentage' => $edu['percentage'] ?? null,
            ]);
        }

        return response()->json(['success' => true, 'message' => 'Education saved successfully']);
    }

    public function storeResume(Request $request)
    {
        $validated = $request->validate([
            'resume' => 'nullable|file|mimes:pdf,doc,docx|max:5120', // 5MB max
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        // Only process if a file was uploaded
        if ($request->hasFile('resume')) {
            // Delete old resume if exists
            if ($candidate->profile && $candidate->profile->resume_path) {
                Storage::disk('public')->delete($candidate->profile->resume_path);
            }

            // Store new resume
            $path = $request->file('resume')->store('resumes', 'public');

            $candidate->profile()->updateOrCreate(
                ['candidate_id' => $candidate->id],
                ['resume_path' => $path]
            );

            return response()->json(['success' => true, 'message' => 'Resume uploaded successfully']);
        }

        return response()->json(['success' => true, 'message' => 'Step completed']);
    }

    public function completeProfileSubmit(Request $request)
    {
        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        // Mark profile as complete
        $candidate->profile()->updateOrCreate(
            ['candidate_id' => $candidate->id],
            [
                'is_profile_complete' => true,
                'profile_completed_at' => now(),
            ]
        );

        return redirect()->route('candidate.profile')->with('success', 'Profile completed successfully!');
    }

    // Education CRUD operations
    public function storeEducationItem(Request $request)
    {
        $validated = $request->validate([
            'education_level_id' => 'required|exists:education_levels,id',
            'education_degree_id' => 'required|exists:education_degrees,id',
            'education_specialization_id' => 'nullable|exists:education_specializations,id',
            'institute_name' => 'required|string|max:255',
            'board_university' => 'nullable|string|max:255',
            'passing_year' => 'required|integer|min:1950|max:' . (date('Y') + 10),
            'percentage' => 'nullable|numeric|min:0|max:100',
            'cgpa' => 'nullable|numeric|min:0|max:10',
            'cgpa_scale' => 'nullable|numeric|min:0|max:10',
            'is_current' => 'boolean',
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        $validated['is_current'] = $request->has('is_current');

        $edu = $candidate->education()->create($validated);
        $edu->load('degree', 'specialization');

        return response()->json(['success' => true, 'message' => 'Education added successfully', 'data' => $edu]);
    }

    public function updateEducationItem(Request $request, $id)
    {
        $validated = $request->validate([
            'education_level_id' => 'required|exists:education_levels,id',
            'education_degree_id' => 'required|exists:education_degrees,id',
            'education_specialization_id' => 'nullable|exists:education_specializations,id',
            'institute_name' => 'required|string|max:255',
            'board_university' => 'nullable|string|max:255',
            'passing_year' => 'required|integer|min:1950|max:' . (date('Y') + 10),
            'percentage' => 'nullable|numeric|min:0|max:100',
            'cgpa' => 'nullable|numeric|min:0|max:10',
            'cgpa_scale' => 'nullable|numeric|min:0|max:10',
            'is_current' => 'boolean',
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        $education = $candidate->education()->findOrFail($id);
        
        $validated['is_current'] = $request->has('is_current');
        
        $education->update($validated);
        $education->load('degree', 'specialization');

        return response()->json(['success' => true, 'message' => 'Education updated successfully', 'data' => $education]);
    }

    public function deleteEducationItem($id)
    {
        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        $education = $candidate->education()->findOrFail($id);
        $education->delete();

        return response()->json(['success' => true, 'message' => 'Education deleted successfully']);
    }

    // Experience CRUD operations
    public function storeExperienceItem(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'is_current' => 'boolean',
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        $validated['is_current'] = $request->has('is_current');
        
        $exp = $candidate->experiences()->create($validated);

        return response()->json(['success' => true, 'message' => 'Experience added successfully', 'data' => $exp]);
    }

    public function updateExperienceItem(Request $request, $id)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'designation' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after:start_date',
            'is_current' => 'boolean',
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        $experience = $candidate->experiences()->findOrFail($id);
        
        $validated['is_current'] = $request->has('is_current');
        
        $experience->update($validated);

        return response()->json(['success' => true, 'message' => 'Experience updated successfully', 'data' => $experience]);
    }

    public function deleteExperienceItem($id)
    {
        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        $experience = $candidate->experiences()->findOrFail($id);
        $experience->delete();

        return response()->json(['success' => true, 'message' => 'Experience deleted successfully']);
    }

    public function getEducationDegrees($levelId)
    {
        $degrees = EducationDegree::where('education_level_id', $levelId)
            ->orderBy('sort_order')
            ->get(['id', 'label']);
        
        return response()->json($degrees);
    }

    public function getEducationSpecializations($degreeId)
    {
        $specializations = EducationSpecialization::where('education_degree_id', $degreeId)
            ->orderBy('sort_order')
            ->get(['id', 'label']);
        
        return response()->json($specializations);
    }

    // Skill CRUD operations
    public function storeSkillItem(Request $request)
    {
        $validated = $request->validate([
            'skill_id' => 'required|exists:skills,id',
            'experience_years' => 'nullable|integer|min:0|max:50',
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        // Check if skill already exists for this candidate
        $exists = $candidate->skills()->where('skill_id', $validated['skill_id'])->exists();
        if ($exists) {
            return response()->json(['success' => false, 'message' => 'This skill has already been added'], 422);
        }

        $skill = $candidate->skills()->create($validated);
        $skill->load('skill');

        return response()->json(['success' => true, 'message' => 'Skill added successfully', 'data' => $skill]);
    }

    public function updateSkillItem(Request $request, $id)
    {
        $validated = $request->validate([
            'skill_id' => 'required|exists:skills,id',
            'experience_years' => 'nullable|integer|min:0|max:50',
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        $candidateSkill = $candidate->skills()->findOrFail($id);
        
        // Check if skill_id is being changed and already exists
        if ($candidateSkill->skill_id != $validated['skill_id']) {
            $exists = $candidate->skills()->where('skill_id', $validated['skill_id'])->where('id', '!=', $id)->exists();
            if ($exists) {
                return response()->json(['success' => false, 'message' => 'This skill has already been added'], 422);
            }
        }
        
        $candidateSkill->update($validated);
        $candidateSkill->load('skill');

        return response()->json(['success' => true, 'message' => 'Skill updated successfully', 'data' => $candidateSkill]);
    }

    public function deleteSkillItem($id)
    {
        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        $candidateSkill = $candidate->skills()->findOrFail($id);
        $candidateSkill->delete();

        return response()->json(['success' => true, 'message' => 'Skill deleted successfully']);
    }

    // Language CRUD operations
    public function storeLanguageItem(Request $request)
    {
        $validated = $request->validate([
            'language_id' => 'required|exists:languages,id',
            'proficiency' => 'nullable|string|max:50',
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        // Check if language already exists for this candidate
        $exists = $candidate->languages()->where('language_id', $validated['language_id'])->exists();
        if ($exists) {
            return response()->json(['success' => false, 'message' => 'This language has already been added'], 422);
        }

        $lang = $candidate->languages()->create($validated);
        $lang->load('language');

        return response()->json(['success' => true, 'message' => 'Language added successfully', 'data' => $lang]);
    }

    public function updateLanguageItem(Request $request, $id)
    {
        $validated = $request->validate([
            'language_id' => 'required|exists:languages,id',
            'proficiency' => 'nullable|string|max:50',
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        $candidateLanguage = $candidate->languages()->findOrFail($id);
        
        // Check if language_id is being changed and already exists
        if ($candidateLanguage->language_id != $validated['language_id']) {
            $exists = $candidate->languages()->where('language_id', $validated['language_id'])->where('id', '!=', $id)->exists();
            if ($exists) {
                return response()->json(['success' => false, 'message' => 'This language has already been added'], 422);
            }
        }
        
        $candidateLanguage->update($validated);
        $candidateLanguage->load('language');

        return response()->json(['success' => true, 'message' => 'Language updated successfully', 'data' => $candidateLanguage]);
    }

    public function deleteLanguageItem($id)
    {
        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        $candidateLanguage = $candidate->languages()->findOrFail($id);
        $candidateLanguage->delete();

        return response()->json(['success' => true, 'message' => 'Language deleted successfully']);
    }

    // Certification CRUD operations
    public function storeCertificationItem(Request $request)
    {
        $validated = $request->validate([
            'certificate_id' => 'required|exists:certificates,id',
            'issued_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after:issued_at',
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        // Check if certification already exists for this candidate
        $exists = $candidate->certifications()->where('certificate_id', $validated['certificate_id'])->exists();
        if ($exists) {
            return response()->json(['success' => false, 'message' => 'This certification has already been added'], 422);
        }

        $cert = $candidate->certifications()->create($validated);
        $cert->load('certificate');

        return response()->json(['success' => true, 'message' => 'Certification added successfully', 'data' => $cert]);
    }

    public function updateCertificationItem(Request $request, $id)
    {
        $validated = $request->validate([
            'certificate_id' => 'required|exists:certificates,id',
            'issued_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after:issued_at',
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        $candidateCertification = $candidate->certifications()->findOrFail($id);
        
        // Check if certificate_id is being changed and already exists
        if ($candidateCertification->certificate_id != $validated['certificate_id']) {
            $exists = $candidate->certifications()->where('certificate_id', $validated['certificate_id'])->where('id', '!=', $id)->exists();
            if ($exists) {
                return response()->json(['success' => false, 'message' => 'This certification has already been added'], 422);
            }
        }
        
        $candidateCertification->update($validated);
        $candidateCertification->load('certificate');

        return response()->json(['success' => true, 'message' => 'Certification updated successfully', 'data' => $candidateCertification]);
    }

    public function deleteCertificationItem($id)
    {
        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        $candidateCertification = $candidate->certifications()->findOrFail($id);
        $candidateCertification->delete();

        return response()->json(['success' => true, 'message' => 'Certification deleted successfully']);
    }

    public function updateBasicProfile(Request $request)
    {
        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        // Validate request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'headline' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date|before:today',
            'gender' => 'nullable|in:male,female,other',
            'city_id' => 'nullable|exists:cities,id',
        ]);

        // Update or create candidate profile
        $profileData = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'] ?? null,
            'headline' => $validated['headline'] ?? null,
            'phone' => $validated['phone'] ?? null,
            'date_of_birth' => $validated['date_of_birth'] ?? null,
            'gender' => $validated['gender'] ?? null,
        ];

        if ($candidate->profile) {
            $candidate->profile->update($profileData);
        } else {
            $candidate->profile()->create($profileData);
        }

        // Update city_id in candidate table
        if (isset($validated['city_id'])) {
            $candidate->update(['city_id' => $validated['city_id']]);
        }

        $candidate->load('profile', 'city');

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully',
            'data' => [
                'first_name' => $candidate->profile->first_name,
                'last_name' => $candidate->profile->last_name,
                'headline' => $candidate->profile->headline,
                'phone' => $candidate->profile->phone,
                'date_of_birth' => $candidate->profile->date_of_birth?->format('d M Y'),
                'gender' => $candidate->profile->gender,
                'city' => $candidate->city?->name,
            ]
        ]);
    }

    public function uploadProfilePhoto(Request $request)
    {
        try {
            $user = Auth::user();
            $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

            // Validate request
            $validated = $request->validate([
                'profile_photo' => 'required|image|mimes:jpeg,jpg,png,gif|max:5120', // 5MB max
            ]);

            // Validate file upload
            if (!$request->hasFile('profile_photo')) {
                return response()->json([
                    'success' => false,
                    'message' => 'No file was uploaded'
                ], 400);
            }

            $file = $request->file('profile_photo');

            // Validate file is valid
            if (!$file->isValid()) {
                return response()->json([
                    'success' => false,
                    'message' => 'The uploaded file is corrupted or invalid'
                ], 400);
            }

            // Validate file size (additional check)
            if ($file->getSize() > 5242880) { // 5MB in bytes
                return response()->json([
                    'success' => false,
                    'message' => 'File size exceeds 5MB limit'
                ], 400);
            }

            // Validate image dimensions (optional)
            $imageInfo = getimagesize($file->getRealPath());
            if (!$imageInfo) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid image file'
                ], 400);
            }

            // Store old photo path for rollback
            $oldPhotoPath = $candidate->profile ? $candidate->profile->profile_photo : null;

            // Store new photo on S3
            try {
                $path = $file->store('profile_photos', 's3');
                
                if (!$path) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to upload file to server'
                    ], 500);
                }

                // Verify file exists on S3
                if (!Storage::disk('s3')->exists($path)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'File upload verification failed - file not found on server'
                    ], 500);
                }

                // Get file size on S3 to verify upload
                $uploadedSize = Storage::disk('s3')->size($path);
                if (!$uploadedSize || $uploadedSize === 0) {
                    // Delete corrupted file
                    Storage::disk('s3')->delete($path);
                    return response()->json([
                        'success' => false,
                        'message' => 'Uploaded file is corrupted or empty'
                    ], 500);
                }

            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to upload to S3: ' . $e->getMessage()
                ], 500);
            }

            // Get S3 URL
            try {
                $bucket = config('filesystems.disks.s3.bucket');
                $region = config('filesystems.disks.s3.region');
                $url = "https://{$bucket}.s3.{$region}.amazonaws.com/{$path}";
            } catch (\Exception $e) {
                // Fallback to manual URL construction
                $url = rtrim(config('filesystems.disks.s3.url'), '/') . '/' . $path;
            }

            // Update or create candidate profile
            try {
                if ($candidate->profile) {
                    $updated = $candidate->profile->update(['profile_photo' => $path]);
                } else {
                    $profile = $candidate->profile()->create(['profile_photo' => $path]);
                    $updated = $profile ? true : false;
                }

                if (!$updated) {
                    // Rollback: delete newly uploaded file
                    Storage::disk('s3')->delete($path);
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to update profile in database'
                    ], 500);
                }

            } catch (\Exception $e) {
                // Rollback: delete newly uploaded file
                Storage::disk('s3')->delete($path);
                return response()->json([
                    'success' => false,
                    'message' => 'Database error: ' . $e->getMessage()
                ], 500);
            }

            // Delete old photo only after successful upload and DB update
            if ($oldPhotoPath) {
                try {
                    Storage::disk('s3')->delete($oldPhotoPath);
                } catch (\Exception $e) {
                    // Log error but don't fail the request
                    Log::warning('Failed to delete old profile photo: ' . $e->getMessage());
                }
            }

            return response()->json([
                'success' => true, 
                'message' => 'Profile photo uploaded successfully',
                'photo_url' => $url,
                'file_size' => $uploadedSize,
                'path' => $path
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred: ' . $e->getMessage()
            ], 500);
        }
    }

    public function applyToJob($id)
    {
        try {
            $candidate = auth()->user()->candidate;
            
            if (!$candidate) {
                return redirect()->back()->with('error', 'Candidate profile not found');
            }

            // Check if already applied
            $existingApplication = JobApplication::where('candidate_id', $candidate->id)
                ->where('job_post_id', $id)
                ->first();

            if ($existingApplication) {
                return redirect()->back()->with('info', 'You have already applied to this job');
            }

            // Get the job post with recruiter
            $jobPost = JobPost::with(['recruiter', 'company'])->findOrFail($id);

            // Get pending status
            $pendingStatus = ApplicationStatus::where('slug', 'pending')->first();

            // Create application
            $application = JobApplication::create([
                'candidate_id' => $candidate->id,
                'job_post_id' => $id,
                'application_status_id' => $pendingStatus->id ?? 1,
                'applied_at' => now(),
            ]);

            // Create conversation between candidate and recruiter
            if ($jobPost->recruiter && $jobPost->recruiter->user_id) {
                $candidateUserId = auth()->user()->id;
                $recruiterUserId = $jobPost->recruiter->user_id;

                // Ensure user_one_id is always the smaller ID for uniqueness
                $userOneId = min($candidateUserId, $recruiterUserId);
                $userTwoId = max($candidateUserId, $recruiterUserId);

                // Check if conversation already exists
                $conversation = Conversation::where('user_one_id', $userOneId)
                    ->where('user_two_id', $userTwoId)
                    ->first();

                if (!$conversation) {
                    $conversation = Conversation::create([
                        'user_one_id' => $userOneId,
                        'user_two_id' => $userTwoId,
                        'job_application_id' => $application->id,
                    ]);
                }

                // Send automatic message
                $candidateName = auth()->user()->name ?? 'A candidate';
                $messageText = "Hi, I have applied for the position of {$jobPost->title} at {$jobPost->company->name}. Looking forward to hearing from you!";

                $message = Message::create([
                    'conversation_id' => $conversation->id,
                    'sender_id' => $candidateUserId,
                    'message' => $messageText,
                    'type' => 'text',
                    'is_seen' => false,
                ]);

                // Update conversation's last message
                $conversation->update([
                    'last_message_id' => $message->id,
                    'last_message_at' => now(),
                ]);
            }

            return redirect()->back()->with('success', 'Application submitted successfully!');

        } catch (\Exception $e) {
            Log::error('Job application error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to submit application: ' . $e->getMessage());
        }
    }

    public function toggleSaveJob($id)
    {
        try {
            $candidate = auth()->user()->candidate;
            
            if (!$candidate) {
                return redirect()->back()->with('error', 'Candidate profile not found');
            }

            $savedJob = SavedJob::where('candidate_id', $candidate->id)
                ->where('job_post_id', $id)
                ->first();

            if ($savedJob) {
                $savedJob->delete();
                return redirect()->back()->with('success', 'Job removed from saved jobs');
            } else {
                SavedJob::create([
                    'candidate_id' => $candidate->id,
                    'job_post_id' => $id,
                ]);
                return redirect()->back()->with('success', 'Job saved successfully!');
            }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to save job: ' . $e->getMessage());
        }
    }

    public function appliedJobs()
    {
        $candidate = auth()->user()->candidate;
        
        $applications = JobApplication::with([
            'jobPost.company',
            'jobPost.city',
            'jobPost.employmentType',
            'applicationStatus'
        ])
        ->where('candidate_id', $candidate->id)
        ->orderByDesc('created_at')
        ->paginate(10);

        return view('candidate.applied-jobs', compact('applications'));
    }

    public function messages(Request $request)
    {
        $candidate = auth()->user()->candidate;
        $userId = auth()->user()->id;
        
        // Get all conversations for this user
        $conversations = Conversation::where('user_one_id', $userId)
            ->orWhere('user_two_id', $userId)
            ->with(['userOne', 'userTwo', 'lastMessage', 'jobApplication.jobPost.company'])
            ->orderBy('last_message_at', 'desc')
            ->get();
        
        // Get selected conversation ID from query parameter
        $selectedConversationId = $request->query('conversation_id');
        
        // Get selected conversation with messages
        $selectedConversation = null;
        $messages = collect();
        
        if ($selectedConversationId) {
            $selectedConversation = Conversation::with([
                'userOne', 
                'userTwo', 
                'jobApplication.jobPost.company',
                'messages.sender'
            ])
            ->where('id', $selectedConversationId)
            ->where(function($query) use ($userId) {
                $query->where('user_one_id', $userId)
                      ->orWhere('user_two_id', $userId);
            })
            ->first();
            
            if ($selectedConversation) {
                $messages = $selectedConversation->messages;
                
                // Mark messages as seen
                $selectedConversation->messages()
                    ->where('sender_id', '!=', $userId)
                    ->where('is_seen', false)
                    ->update(['is_seen' => true]);
            }
        } elseif ($conversations->isNotEmpty()) {
            // Auto-select first conversation if none selected
            $selectedConversation = Conversation::with([
                'userOne', 
                'userTwo', 
                'jobApplication.jobPost.company',
                'messages.sender'
            ])
            ->where('id', $conversations->first()->id)
            ->first();
            
            if ($selectedConversation) {
                $messages = $selectedConversation->messages;
                $selectedConversationId = $selectedConversation->id;
                
                // Mark messages as seen
                $selectedConversation->messages()
                    ->where('sender_id', '!=', $userId)
                    ->where('is_seen', false)
                    ->update(['is_seen' => true]);
            }
        }
        
        return view('candidate.messages', compact('conversations', 'selectedConversation', 'messages', 'selectedConversationId'));
    }

    public function startOrGetConversation($applicationId)
    {
        try {
            $candidate = auth()->user()->candidate;
            
            if (!$candidate) {
                return redirect()->back()->with('error', 'Candidate profile not found');
            }

            // Get the application with job post and recruiter
            $application = JobApplication::with(['jobPost.recruiter', 'jobPost.company'])
                ->where('id', $applicationId)
                ->where('candidate_id', $candidate->id)
                ->firstOrFail();

            // Check if recruiter exists
            if (!$application->jobPost->recruiter || !$application->jobPost->recruiter->user_id) {
                return redirect()->back()->with('error', 'Unable to start conversation with this recruiter');
            }

            $candidateUserId = auth()->user()->id;
            $recruiterUserId = $application->jobPost->recruiter->user_id;

            // Ensure user_one_id is always the smaller ID for uniqueness
            $userOneId = min($candidateUserId, $recruiterUserId);
            $userTwoId = max($candidateUserId, $recruiterUserId);

            // Check if conversation already exists
            $conversation = Conversation::where('user_one_id', $userOneId)
                ->where('user_two_id', $userTwoId)
                ->first();

            if (!$conversation) {
                // Create new conversation
                $conversation = Conversation::create([
                    'user_one_id' => $userOneId,
                    'user_two_id' => $userTwoId,
                    'job_application_id' => $application->id,
                ]);

                // Send automatic greeting message
                $messageText = "Hi, I have applied for the position of {$application->jobPost->title} at {$application->jobPost->company->name}. Looking forward to hearing from you!";

                $message = Message::create([
                    'conversation_id' => $conversation->id,
                    'sender_id' => $candidateUserId,
                    'message' => $messageText,
                    'type' => 'text',
                    'is_seen' => false,
                ]);

                // Update conversation's last message
                $conversation->update([
                    'last_message_id' => $message->id,
                    'last_message_at' => now(),
                ]);
            }

            // Redirect to messages page with conversation ID
            return redirect()->route('candidate.messages', ['conversation_id' => $conversation->id])
                ->with('success', 'Conversation opened');

        } catch (\Exception $e) {
            Log::error('Start conversation error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to start conversation');
        }
    }

    public function sendMessage(Request $request, $conversationId)
    {
        try {
            $userId = auth()->user()->id;
            
            // Verify user belongs to this conversation
            $conversation = Conversation::where('id', $conversationId)
                ->where(function($query) use ($userId) {
                    $query->where('user_one_id', $userId)
                          ->orWhere('user_two_id', $userId);
                })
                ->firstOrFail();
            
            // Validate message
            $validated = $request->validate([
                'message' => 'required|string|max:1000',
            ]);
            
            // Create message
            $message = Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $userId,
                'message' => $validated['message'],
                'type' => 'text',
                'is_seen' => false,
            ]);
            
            // Update conversation's last message
            $conversation->update([
                'last_message_id' => $message->id,
                'last_message_at' => now(),
            ]);
            
            return redirect()->route('candidate.messages', ['conversation_id' => $conversationId])
                ->with('success', 'Message sent successfully');
                
        } catch (\Exception $e) {
            Log::error('Send message error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send message');
        }
    }

    /**
     * Send a message via API (for real-time chat)
     */
    public function sendMessageApi(Request $request, $conversationId)
    {
        try {
            $userId = auth()->user()->id;
            
            // Verify user belongs to this conversation
            $conversation = Conversation::where('id', $conversationId)
                ->where(function($query) use ($userId) {
                    $query->where('user_one_id', $userId)
                          ->orWhere('user_two_id', $userId);
                })
                ->firstOrFail();
            
            // Validate based on message type
            $validated = $request->validate([
                'message' => 'required_if:type,text|nullable|string|max:1000',
                'type' => 'required|in:text,request_contact,request_email,request_location',
            ]);
            
            $messageType = $validated['type'] ?? 'text';
            $messageText = $validated['message'] ?? '';
            
            // Set default message for request types
            if ($messageType === 'request_contact') {
                $messageText = 'I would like to request your contact number.';
            } elseif ($messageType === 'request_email') {
                $messageText = 'I would like to request your email address.';
            } elseif ($messageType === 'request_location') {
                $messageText = 'I would like to request your company location/address.';
            }
            
            // Create message
            $message = Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $userId,
                'message' => $messageText,
                'type' => $messageType,
                'request_status' => ($messageType !== 'text') ? 'pending' : null,
                'is_seen' => false,
            ]);
            
            // Load sender relationship
            $message->load('sender');
            
            // Update conversation's last message
            $conversation->update([
                'last_message_id' => $message->id,
                'last_message_at' => now(),
            ]);
            
            return response()->json([
                'success' => true,
                'message' => $message
            ]);
                
        } catch (\Exception $e) {
            Log::error('Send message API error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to send message'
            ], 500);
        }
    }

    /**
     * Respond to a request (contact, email, or resume)
     */
    public function respondToRequest(Request $request, $messageId)
    {
        try {
            $userId = auth()->user()->id;
            $candidate = auth()->user()->candidate;
            
            // Get the original request message
            $requestMessage = Message::with('conversation')
                ->where('id', $messageId)
                ->whereHas('conversation', function($query) use ($userId) {
                    $query->where(function($q) use ($userId) {
                        $q->where('user_one_id', $userId)
                          ->orWhere('user_two_id', $userId);
                    });
                })
                ->firstOrFail();
            
            // Validate based on request type
            $rules = [];
            if ($requestMessage->type === 'request_contact') {
                $rules['phone'] = 'required|string|max:20';
            } elseif ($requestMessage->type === 'request_email') {
                $rules['email'] = 'required|email|max:255';
            } elseif ($requestMessage->type === 'request_resume') {
                $rules['resume'] = 'required|file|mimes:pdf,doc,docx|max:5120'; // 5MB max
            }
            
            $validated = $request->validate($rules);
            
            // Update the request message status
            $requestMessage->update(['request_status' => 'approved']);
            
            // Create response message
            $responseData = [
                'conversation_id' => $requestMessage->conversation_id,
                'sender_id' => $userId,
                'type' => $requestMessage->type . '_response',
                'is_seen' => false,
            ];
            
            if ($requestMessage->type === 'request_contact') {
                $responseData['phone'] = $validated['phone'];
                $responseData['message'] = 'Here is my contact number: ' . $validated['phone'];
            } elseif ($requestMessage->type === 'request_email') {
                $responseData['email'] = $validated['email'];
                $responseData['message'] = 'Here is my email: ' . $validated['email'];
            } elseif ($requestMessage->type === 'request_resume') {
                // Upload resume
                $file = $request->file('resume');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('resumes', $fileName, 'public');
                
                $responseData['cv_file'] = $filePath;
                $responseData['message'] = 'I have shared my resume with you.';
            }
            
            $responseMessage = Message::create($responseData);
            $responseMessage->load('sender');
            
            // Update conversation's last message
            $requestMessage->conversation->update([
                'last_message_id' => $responseMessage->id,
                'last_message_at' => now(),
            ]);
            
            return response()->json([
                'success' => true,
                'message' => $responseMessage,
                'requestMessage' => $requestMessage
            ]);
                
        } catch (\Exception $e) {
            Log::error('Respond to request error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to respond to request'
            ], 500);
        }
    }

    /**
     * Decline a request
     */
    public function declineRequest(Request $request, $messageId)
    {
        try {
            $userId = auth()->user()->id;
            
            // Get the original request message
            $requestMessage = Message::with('conversation')
                ->where('id', $messageId)
                ->whereHas('conversation', function($query) use ($userId) {
                    $query->where(function($q) use ($userId) {
                        $q->where('user_one_id', $userId)
                          ->orWhere('user_two_id', $userId);
                    });
                })
                ->firstOrFail();
            
            // Update the request message status
            $requestMessage->update(['request_status' => 'declined']);
            
            // Create decline message
            $declineMessage = Message::create([
                'conversation_id' => $requestMessage->conversation_id,
                'sender_id' => $userId,
                'message' => 'I prefer not to share this information at this time.',
                'type' => 'text',
                'is_seen' => false,
            ]);
            
            $declineMessage->load('sender');
            
            // Update conversation's last message
            $requestMessage->conversation->update([
                'last_message_id' => $declineMessage->id,
                'last_message_at' => now(),
            ]);
            
            return response()->json([
                'success' => true,
                'message' => $declineMessage,
                'requestMessage' => $requestMessage
            ]);
                
        } catch (\Exception $e) {
            Log::error('Decline request error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Failed to decline request'
            ], 500);
        }
    }

    public function savedJobs()
    {
        $candidate = auth()->user()->candidate;
        
        $savedJobs = SavedJob::with([
            'jobPost.company',
            'jobPost.city',
            'jobPost.employmentType',
            'jobPost.experienceRange'
        ])
        ->where('candidate_id', $candidate->id)
        ->orderByDesc('created_at')
        ->paginate(10);

        return view('candidate.saved-jobs', compact('savedJobs'));
    }

    public function settings()
    {
        $candidate = auth()->user()->candidate;
        return view('candidate.settings', compact('candidate'));
    }
}
