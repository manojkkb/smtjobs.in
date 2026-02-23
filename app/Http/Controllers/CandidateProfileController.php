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
        $candidate = Candidate::with(['profile', 'city'])->where('user_id', $user->id)->firstOrCreate(
            ['user_id' => $user->id],
            ['open_to_work' => true]
        );

        // Get cities and states for location dropdown
        $cities = \App\Models\City::where('is_active', true)->orderBy('name')->get();
        
        return view('candidate.complete-profile', compact('candidate', 'cities'));
    }

    public function storeBasicDetails(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'gender' => 'required|in:male,female,other',
            'phone' => 'required|string|max:20',
            'alternate_phone' => 'nullable|string|max:20',
            'headline' => 'nullable|string|max:255',
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

        $candidate->profile()->updateOrCreate(
            ['candidate_id' => $candidate->id],
            $validated
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
            'education.*.degree' => 'required|string|max:255',
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
            $candidate->education()->create($edu);
        }

        return response()->json(['success' => true, 'message' => 'Education saved successfully']);
    }

    public function storeResume(Request $request)
    {
        $validated = $request->validate([
            'resume' => 'required|file|mimes:pdf,doc,docx|max:5120', // 5MB max
        ]);

        $user = Auth::user();
        $candidate = Candidate::where('user_id', $user->id)->firstOrFail();

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

        $candidate->education()->create($validated);

        return response()->json(['success' => true, 'message' => 'Education added successfully']);
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

        return response()->json(['success' => true, 'message' => 'Education updated successfully']);
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
        
        $candidate->experiences()->create($validated);

        return response()->json(['success' => true, 'message' => 'Experience added successfully']);
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

        return response()->json(['success' => true, 'message' => 'Experience updated successfully']);
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

        $candidate->skills()->create($validated);

        return response()->json(['success' => true, 'message' => 'Skill added successfully']);
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

        return response()->json(['success' => true, 'message' => 'Skill updated successfully']);
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

        $candidate->languages()->create($validated);

        return response()->json(['success' => true, 'message' => 'Language added successfully']);
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

        return response()->json(['success' => true, 'message' => 'Language updated successfully']);
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

        $candidate->certifications()->create($validated);

        return response()->json(['success' => true, 'message' => 'Certification added successfully']);
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

        return response()->json(['success' => true, 'message' => 'Certification updated successfully']);
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

        return response()->json(['success' => true, 'message' => 'Profile updated successfully']);
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
}
