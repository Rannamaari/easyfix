<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class SignupVerification extends Model
{
    protected $fillable = [
        'token',
        'signup_method',
        'name',
        'username',
        'email',
        'phone',
        'address_type',
        'address_line1',
        'address_line2',
        'password',
        'otp_hash',
        'otp_expires_at',
        'otp_sent_at',
        'attempts',
        'verified_at',
    ];

    protected function casts(): array
    {
        return [
            'otp_expires_at' => 'datetime',
            'otp_sent_at' => 'datetime',
            'verified_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'token';
    }

    public function markOtp(string $otp): void
    {
        $this->forceFill([
            'otp_hash' => Hash::make($otp),
            'otp_sent_at' => now(),
            'otp_expires_at' => now()->addMinutes(10),
            'attempts' => 0,
        ])->save();
    }

    public function otpMatches(string $otp): bool
    {
        return Hash::check($otp, (string) $this->otp_hash);
    }
}
