<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
class OtpToken extends Model
{
    protected $table = 'otp_tokens';

    protected $fillable = [
        'identifier',
        'identifier_type',
        'otp_hash',
        'expires_at',
        'attempts',
        'verified_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

    public function scopeValid(Builder $query): Builder
    {
        return $query->where('expires_at', '>', now());
    }

    public function scopeForIdentifier(Builder $query, string $identifier): Builder
    {
        return $query->where('identifier', $identifier);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function markVerified(): void
    {
        $this->update([
            'verified_at' => now(),
        ]);
    }

    public function incrementAttempts(): void
    {
        $this->increment('attempts');
    }

    /*
    |--------------------------------------------------------------------------
    | Static Methods
    |--------------------------------------------------------------------------
    */

    public static function generate(string $identifier, string $type, int $expiryMinutes = 5): string
    {
        $otp = (string) random_int(100000, 999999);

        self::create([
            'identifier'      => $identifier,
            'identifier_type' => $type,
            'otp_hash'        => hash('sha256', $otp),
            'expires_at'      => now()->addMinutes($expiryMinutes),
        ]);

        return $otp; // send this via SMS or Email
    }

    public static function verify(string $identifier, string $inputOtp): ?self
    {
        $record = self::forIdentifier($identifier)
            ->valid()
            ->latest()
            ->first();

        if (!$record) {
            return null;
        }

        if ($record->attempts >= 5) {
            return null;
        }

        if ($record->otp_hash === hash('sha256', $inputOtp)) {
            $record->markVerified();
            return $record;
        }

        $record->incrementAttempts();

        return null;
    }
}
