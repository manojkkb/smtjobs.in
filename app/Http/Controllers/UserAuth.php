<?php

namespace App\Http\Controllers;

use App\Models\OtpToken;
use App\Models\User;
use App\Services\OtpService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuth extends Controller
{
    public function sendOtp(Request $request, OtpService $otpService)
    {
        $request->validate([
            'identifier' => 'required'
        ]);

        $identifier = trim($request->identifier);
        $type = $this->detectIdentifierType($identifier);

        $otp = $otpService->sendOtp($identifier, $type);

        $response = [
            'status' => true,
            'message' => 'OTP sent successfully',
            'identifier_type' => $type,
        ];

        if (app()->isLocal()) {
            $response['otp'] = $otp;
        }

        return response()->json($response);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'identifier' => 'required',
            'otp' => 'required|digits:6'
        ]);

        $identifier = trim($request->identifier);

        $record = OtpToken::where('identifier', $identifier)
            ->latest()
            ->first();

        if (!$record) {
            return response()->json([
                'status' => false,
                'message' => 'OTP not found'
            ], 422);
        }

        if ($record->expires_at->isPast()) {
            return response()->json([
                'status' => false,
                'message' => 'OTP expired'
            ], 422);
        }

        if ($record->attempts >= 5) {
            return response()->json([
                'status' => false,
                'message' => 'Too many attempts. Try again later.'
            ], 422);
        }

        if ($record->otp_hash !== hash('sha256', $request->otp)) {
            $record->increment('attempts');

            return response()->json([
                'status' => false,
                'message' => 'Invalid OTP'
            ], 422);
        }

        $record->update([
            'verified_at' => now()
        ]);

        $column = $record->identifier_type === 'email' ? 'email' : 'phone';
        $defaultName = $record->identifier_type === 'email'
            ? explode('@', $identifier)[0]
            : "User ${identifier}";

        $user = User::firstOrCreate([
            $column => $identifier,
        ], [
            'name' => $defaultName,
        ]);

        Auth::login($user);

        $target= $request->input('target', 'candidate');
        $route = $target === 'recruiter' ? 'recruiter.dashboard' : 'candidate.profile';

        return response()->json([
            'status' => true,
            'message' => 'Login successful',
            'redirect' => route($route)
        ]);
    }

    private function detectIdentifierType(string $identifier): string
    {
        return filter_var($identifier, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    } 
    public function showLoginForm()
    {
        return view('auth.login');
    }
    public function showCandidateRegistrationForm()
    {
        return view('auth.candidate-register');
    }

    public function showRegistrationForm()
    {
        return $this->showCandidateRegistrationForm();
    }
    public function candidateRegister()
    {
       
    }
    public function showRecruiterRegistrationForm()
    {
        return view('auth.recruiter-register');
    }
    public function registerRecruiter(Request $request)
    {
        // Implement recruiter registration logic here
    }
}
