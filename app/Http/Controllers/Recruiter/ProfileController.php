<?php

namespace App\Http\Controllers\Recruiter;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\CompanySize;
use App\Models\CompanyType;
use App\Models\Industry;
use App\Models\Recruiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
        
        // Fetch active industries, company sizes, and company types
        $industries = Industry::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('label')
            ->get(['id', 'label', 'slug']);
            
        $companySizes = CompanySize::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('label')
            ->get(['id', 'label', 'slug']);
            
        $companyTypes = CompanyType::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('label')
            ->get(['id', 'label', 'slug']);
        
        return view('recruiter.profile.complete-profile', compact('step', 'existingUser', 'industries', 'companySizes', 'companyTypes'));
    }
    
    public function submitPersonalInfo(Request $request)
    {
        $user = Auth::user();
        
        // Check if email exists if user doesn't have one
        if (empty($user->email) && $request->email) {
            $emailExists = \App\Models\User::where('email', $request->email)
                ->where('id', '!=', $user->id)
                ->exists();
                
            if ($emailExists) {
                return back()->withErrors(['email' => 'Email already exists. Please use a different email.'])
                    ->withInput();
            }
        }
        
        // Build validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'gender' => 'nullable|in:male,female,other',
            'date_of_birth' => 'nullable|date|before:today',
        ];
        
        // If user doesn't have email, require it
        if (empty($user->email)) {
            $rules['email'] = 'required|email|unique:users,email,' . $user->id;
        } else {
            $rules['email'] = 'nullable|email|unique:users,email,' . $user->id;
        }
        
        $validated = $request->validate($rules);
        
        $user->update($validated);
        
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

    public function companyCreate(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:companies,name',
            'industry_id' => 'required|exists:industries,id',
            'company_size_id' => 'required|exists:company_sizes,id',
            'company_type_id' => 'required|exists:company_types,id',
        ]);

        $company = Company::create([
            'name' => $validated['name'],
            'slug' => Str::slug($validated['name']),
            'industry_id' => $validated['industry_id'],
            'company_size_id' => $validated['company_size_id'],
            'company_type_id' => $validated['company_type_id'],
            'is_active' => true,
            'created_by' => Auth::user()->id,
        ]);

        return response()->json(['id' => $company->id, 'name' => $company->name]);
    }
}
