<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show()
    {
        return view('recruiter.profile.show');
    }
    
    public function completeProfile()
    {
        // Check if user already has personal info
        $existingUser = Auth::user();
        $step = 1;
        //  if name is empty then show step 1 else check recuiter exists or not if not then show step 2 else redirect to dashboard
        if(!$existingUser->name){
            $step = 1;
        }else if(!$existingUser->recruiter){
            $step = 2;
        }else{
            return redirect()->route('recruiter.dashboard');
        }
        
        return view('recruiter.profile.complete-profile', compact('step', 'existingUser'));
    }
    
    public function submitPersonalInfo(Request $request)
    {
        // Check for existing user by phone
        $phoneExists = \App\Models\User::where('phone', $request->phone)
            ->where('id', '!=', Auth::user()->id)
            ->exists();
            
        if ($phoneExists) {
            return back()->withErrors(['phone' => 'Mobile number already exists. Please use a different number or provide your email.'])
                ->withInput();
        }
        
        // Check for existing user by email
        $emailExists = \App\Models\User::where('email', $request->email)
            ->where('id', '!=', Auth::user()->id)
            ->exists();
            
        if ($emailExists) {
            return back()->withErrors(['email' => 'Email already exists. Please use a different email or provide your mobile number.'])
                ->withInput();
        }
        
        // Check if user with this name already has complete information
        $existingUserByName = \App\Models\User::where('name', $request->name)
            ->where('id', '!=', Auth::user()->id)
            ->whereNotNull('email')
            ->whereNotNull('phone')
            ->first();
            
        if ($existingUserByName) {
            // User with this name already has complete info, redirect to step 2
            return redirect()->route('recruiter.complete.profile', ['step' => 2])
                ->with('info', 'A user with this name already exists with complete information. Please proceed with recruiter details.');
        }
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::user()->id,
            'phone' => 'required|string|unique:users,phone,' . Auth::user()->id,
            'gender' => 'nullable|in:male,female,other',
        ]);
        
        Auth::user()->update($validated);
        
        return redirect()->route('recruiter.complete.profile')->with('step', 2);
    }
    
    public function submitRecruiterDetails(Request $request)
    {
        $validated = $request->validate([
            'company_id' => 'nullable|exists:companies,id',
            'role' => 'required|string|max:255',
        ]);

       
        
        DB::beginTransaction();
        
        try {
            // Get or create company
            if ($request->company_id) {
                $company = Company::findOrFail($request->company_id);
            } else {
                $company = Company::firstOrCreate(
                    ['name' => $validated['company_name']],
                    [
                        'slug' => \Illuminate\Support\Str::slug($validated['company_name']),
                        'is_active' => true,
                        'created_by' => Auth::user()->id,
                    ]
                );
            }
            
            // Create recruiter record
            Recruiter::create([
               
                'company_id' => $company->id,
                'designation' => $validated['role'],
                'is_active' => true,
                'is_verified' => false,
                'user_id' => Auth::user()->id,
            ]);
            
            DB::commit();
            
            return redirect()->route('recruiter.dashboard')
                ->with('success', 'Profile completed successfully! Welcome to your dashboard.');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    
    public function searchCompanies(Request $request)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }
        
        $companies = Company::where('name', 'like', '%' . $query . '%')
            ->where('is_active', true)
            ->limit(10)
            ->get(['id', 'name'])
            ->map(function($company) {
                return [
                    'id' => $company->id,
                    'name' => $company->name,
                    'industry' => null
                ];
            });
        
        return response()->json($companies);
    }
}
