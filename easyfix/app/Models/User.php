<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use App\Mail\VerifyEmail;

class User extends Authenticatable implements FilamentUser, MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'address_type',
        'address_line1',
        'address_line2',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function sendEmailVerificationNotification(): void
    {
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $this->getKey(), 'hash' => sha1($this->getEmailForVerification())]
        );

        Mail::to($this->email)->send(new VerifyEmail($this, $verificationUrl));
    }

    public function canAccessPanel(Panel $panel): bool
    {
        return $this->role === 'admin';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isProvider(): bool
    {
        return $this->role === 'provider';
    }

    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    public function providerProfile(): HasOne
    {
        return $this->hasOne(ProviderProfile::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class);
    }

    public function jobRequestsAsCustomer(): HasMany
    {
        return $this->hasMany(JobRequest::class, 'customer_id');
    }

    public function jobRequestsAsProvider(): HasMany
    {
        return $this->hasMany(JobRequest::class, 'provider_id');
    }

    public function scopeProviders($query)
    {
        return $query->where('role', 'provider');
    }

    public function scopeCustomers($query)
    {
        return $query->where('role', 'customer');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }

    public function unreadMessageCount(): int
    {
        $role = $this->role ?? 'customer';

        $base = DB::table('job_messages as jm')
            ->leftJoin('job_message_reads as jmr', function ($join) {
                $join->on('jmr.job_request_id', '=', 'jm.job_request_id')
                    ->where('jmr.user_id', '=', $this->id);
            })
            ->where(function ($query) {
                $query->whereNull('jmr.last_read_at')
                    ->orWhereColumn('jm.created_at', '>', 'jmr.last_read_at');
            })
            ->where('jm.user_id', '!=', $this->id);

        if ($role === 'admin') {
            $base->where('jm.sender_role', '!=', 'admin');
        } elseif ($role === 'provider') {
            $base->whereIn('jm.job_request_id', function ($query) {
                $query->select('id')
                    ->from('job_requests')
                    ->where('provider_id', $this->id);
            });
        } else {
            $base->whereIn('jm.job_request_id', function ($query) {
                $query->select('id')
                    ->from('job_requests')
                    ->where('customer_id', $this->id);
            });
        }

        return (int) $base->count();
    }
}
