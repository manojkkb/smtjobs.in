<?php

namespace App\Services;

use App\Models\OtpToken;
use Illuminate\Support\Facades\Log;

class OtpService
{
    const MAX_ATTEMPTS = 5;
    const EXPIRY_MINUTES = 5;

    /*
    |--------------------------------------------------------------------------
    | Send OTP
    |--------------------------------------------------------------------------
    */
    public function sendOtp(string $identifier, string $type = 'phone'): string
    {
        // Delete old active OTPs for this identifier
        OtpToken::where('identifier', $identifier)->delete();

        // Generate OTP
        $otp = random_int(100000, 999999);

        OtpToken::create([
            'identifier'      => $identifier,
            'identifier_type' => $type,
            'otp_hash'        => hash('sha256', $otp),
            'expires_at'      => now()->addMinutes(self::EXPIRY_MINUTES),
        ]);

        // 👉 Integrate SMS / Email here
        // SmsService::send($identifier, "Your OTP is $otp");
        if ($type === 'email') {
            // Mail::to($identifier)->send(new OtpMail($otp));
            Log::info('OTP queued for email delivery', ['identifier' => $identifier]);
        } else {
            // SmsService::send($identifier, "Your OTP is $otp");
            Log::info('OTP queued for SMS delivery', ['identifier' => $identifier]);
        }

        return (string) $otp; // remove in production (only for testing)
    }

    /*
    |--------------------------------------------------------------------------
    | Verify OTP
    |--------------------------------------------------------------------------
    */
    public function verifyOtp(string $identifier, string $inputOtp): bool
    {
        $record = OtpToken::where('identifier', $identifier)
            ->latest()
            ->first();

        if (!$record) {
            return false;
        }

        // Expired
        if ($record->expires_at->isPast()) {
            return false;
        }

        // Too many attempts
        if ($record->attempts >= self::MAX_ATTEMPTS) {
            return false;
        }

        // Match OTP
        if ($record->otp_hash === hash('sha256', $inputOtp)) {

            $record->update([
                'verified_at' => now(),
            ]);

            return true;
        }

        // Wrong attempt
        $record->increment('attempts');

        return false;
    }
}
