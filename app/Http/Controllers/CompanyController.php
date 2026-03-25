<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\CompanyReview;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    public function show($companySlug)
    {
        $company = Company::where('slug', $companySlug)
            ->with(['profile', 'industry', 'companySize', 'city.state.country'])
            ->firstOrFail();
        
        $isFollowing = $company->isFollowedBy(Auth::id());
        
        // Get user's existing review if any
        $userReview = null;
        if (Auth::check()) {
            $userReview = CompanyReview::where('company_id', $company->id)
                ->where('user_id', Auth::id())
                ->first();
        }
        
        return view('website.company-overview', [
            'activeTab' => 'overview',
            'company' => $company,
            'isFollowing' => $isFollowing,
            'userReview' => $userReview
        ]);
    }
    
    public function jobs($companySlug)
    {
        $company = Company::where('slug', $companySlug)
            ->with(['profile', 'industry', 'companySize', 'city.state.country', 'jobPosts.city', 'jobPosts.experienceRange'])
            ->firstOrFail();
        
        $isFollowing = $company->isFollowedBy(Auth::id());
        
        // Get user's existing review if any
        $userReview = null;
        if (Auth::check()) {
            $userReview = CompanyReview::where('company_id', $company->id)
                ->where('user_id', Auth::id())
                ->first();
        }
        
        return view('website.company-overview', [
            'activeTab' => 'jobs',
            'company' => $company,
            'isFollowing' => $isFollowing,
            'userReview' => $userReview
        ]);
    }
    
    public function reviews($companySlug)
    {
        $company = Company::where('slug', $companySlug)
            ->with(['profile', 'industry', 'companySize', 'city.state.country'])
            ->firstOrFail();
        
        $isFollowing = $company->isFollowedBy(Auth::id());
        
        // Load approved reviews with user data
        $reviews = $company->reviews()
            ->with('user')
            ->where('status', CompanyReview::STATUS_APPROVED)
            ->latest()
            ->get();
        
        // Calculate rating distribution
        $ratingDistribution = [];
        $totalReviews = $reviews->count();
        
        if ($totalReviews > 0) {
            for ($i = 5; $i >= 1; $i--) {
                $count = $reviews->where('rating', $i)->count();
                $ratingDistribution[$i] = [
                    'stars' => $i,
                    'count' => $count,
                    'percentage' => round(($count / $totalReviews) * 100)
                ];
            }
        } else {
            for ($i = 5; $i >= 1; $i--) {
                $ratingDistribution[$i] = [
                    'stars' => $i,
                    'count' => 0,
                    'percentage' => 0
                ];
            }
        }
        
        // Get user's existing review if any
        $userReview = null;
        if (Auth::check()) {
            $userReview = CompanyReview::where('company_id', $company->id)
                ->where('user_id', Auth::id())
                ->first();
        }
        
        return view('website.company-overview', [
            'activeTab' => 'reviews',
            'company' => $company,
            'isFollowing' => $isFollowing,
            'reviews' => $reviews,
            'ratingDistribution' => $ratingDistribution,
            'userReview' => $userReview
        ]);
    }
    
    public function follow(Request $request, $companySlug)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to follow companies',
                'redirect' => route('login')
            ], 401);
        }
        
        $company = Company::where('slug', $companySlug)->firstOrFail();
        
        // Check if already following
        $existingFollow = $company->followers()->where('user_id', Auth::id())->first();
        
        if ($existingFollow) {
            return response()->json([
                'success' => false,
                'message' => 'Already following this company'
            ]);
        }
        
        // Create follow record
        $company->followers()->create([
            'user_id' => Auth::id()
        ]);
        
        // Update followers count
        $company->profile()->increment('followers_count');
        
        return response()->json([
            'success' => true,
            'message' => 'Successfully followed ' . $company->name,
            'followers_count' => $company->profile->followers_count + 1,
            'is_following' => true
        ]);
    }
    
    public function unfollow(Request $request, $companySlug)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first',
                'redirect' => route('login')
            ], 401);
        }
        
        $company = Company::where('slug', $companySlug)->firstOrFail();
        
        // Delete follow record
        $deleted = $company->followers()->where('user_id', Auth::id())->delete();
        
        if ($deleted) {
            // Update followers count
            $company->profile()->decrement('followers_count');
            
            return response()->json([
                'success' => true,
                'message' => 'Unfollowed ' . $company->name,
                'followers_count' => max(0, $company->profile->followers_count - 1),
                'is_following' => false
            ]);
        }
        
        return response()->json([
            'success' => false,
            'message' => 'You are not following this company'
        ]);
    }
    
    public function submitReview(Request $request, $companySlug)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Please login to submit a review',
                'redirect' => route('login')
            ], 401);
        }
        
        $company = Company::where('slug', $companySlug)->firstOrFail();
        
        // Check if user already reviewed this company
        $existingReview = CompanyReview::where('company_id', $company->id)
            ->where('user_id', Auth::id())
            ->first();
        
        // Validate request
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'nullable|string|max:5000',
            'pros' => 'nullable|string|max:2000',
            'cons' => 'nullable|string|max:2000',
            'is_anonymous' => 'boolean',
            'interview_process_rating' => 'nullable|integer|min:1|max:5',
            'communication_rating' => 'nullable|integer|min:1|max:5',
            'salary_rating' => 'nullable|integer|min:1|max:5',
            'work_culture_rating' => 'nullable|integer|min:1|max:5',
        ]);
        
        $isUpdate = false;
        
        if ($existingReview) {
            // Update existing review and set back to pending approval
            $existingReview->update([
                'rating' => $validated['rating'],
                'review' => $validated['review'] ?? null,
                'pros' => $validated['pros'] ?? null,
                'cons' => $validated['cons'] ?? null,
                'is_anonymous' => $request->boolean('is_anonymous'),
                'interview_process_rating' => $validated['interview_process_rating'] ?? null,
                'communication_rating' => $validated['communication_rating'] ?? null,
                'salary_rating' => $validated['salary_rating'] ?? null,
                'work_culture_rating' => $validated['work_culture_rating'] ?? null,
                'status' => CompanyReview::STATUS_PENDING, // Set back to pending approval
            ]);
            $review = $existingReview;
            $isUpdate = true;
        } else {
            // Create new review
            $review = CompanyReview::create([
                'company_id' => $company->id,
                'user_id' => Auth::id(),
                'rating' => $validated['rating'],
                'review' => $validated['review'] ?? null,
                'pros' => $validated['pros'] ?? null,
                'cons' => $validated['cons'] ?? null,
                'is_anonymous' => $request->boolean('is_anonymous'),
                'interview_process_rating' => $validated['interview_process_rating'] ?? null,
                'communication_rating' => $validated['communication_rating'] ?? null,
                'salary_rating' => $validated['salary_rating'] ?? null,
                'work_culture_rating' => $validated['work_culture_rating'] ?? null,
                'status' => CompanyReview::STATUS_PENDING, // Pending approval
            ]);
            
            // Update review count only for new reviews
            $company->profile()->increment('review_count');
        }
        
        // Recalculate average rating (only approved reviews)
        $avgRating = CompanyReview::where('company_id', $company->id)
            ->where('status', CompanyReview::STATUS_APPROVED)
            ->avg('rating');
            
        if ($avgRating) {
            $company->profile()->update([
                'average_rating' => round($avgRating, 1)
            ]);
        }
        
        return response()->json([
            'success' => true,
            'message' => $isUpdate 
                ? 'Review updated successfully and is pending approval.' 
                : 'Thank you! Your review has been submitted and is pending approval.',
            'review' => $review,
            'is_update' => $isUpdate
        ]);
    }
}
