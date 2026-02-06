<?php

namespace App\Models;

use App\Enums\JobStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\JobStatusChanged;

class JobRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'guest_name',
        'guest_username',
        'guest_phone',
        'guest_email',
        'guest_contact_preference',
        'guest_token',
        'service_category_id',
        'service_id',
        'provider_id',
        'status',
        'description',
        'address',
        'city',
        'latitude',
        'longitude',
        'preferred_time',
        'scheduled_time',
        'completed_at',
        'admin_notes',
    ];

    protected $casts = [
        'status' => JobStatus::class,
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'preferred_time' => 'datetime',
        'scheduled_time' => 'datetime',
        'completed_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function ($job) {
            // Auto-generate guest token for guest requests
            if (!$job->customer_id && !$job->guest_token) {
                $job->guest_token = static::generateUniqueToken();
            }
        });
    }

    public static function generateUniqueToken(): string
    {
        do {
            $token = Str::random(64);
        } while (static::where('guest_token', $token)->exists());

        return $token;
    }

    public static function findByGuestToken(string $token): ?static
    {
        return static::where('guest_token', $token)->first();
    }

    // === Guest Helpers ===

    public function isGuest(): bool
    {
        return is_null($this->customer_id);
    }

    public function isRegistered(): bool
    {
        return !is_null($this->customer_id);
    }

    public function getContactNameAttribute(): string
    {
        if ($this->isGuest()) {
            return $this->guest_name ?? 'Guest';
        }

        return $this->customer?->name ?? 'Unknown';
    }

    public function getContactEmailAttribute(): ?string
    {
        if ($this->isGuest()) {
            return $this->guest_email;
        }

        return $this->customer?->email;
    }

    public function getContactPhoneAttribute(): ?string
    {
        if ($this->isGuest()) {
            return $this->guest_phone;
        }

        return $this->customer?->phone;
    }

    public function getTrackingUrlAttribute(): ?string
    {
        if ($this->guest_token) {
            return url("/track/{$this->guest_token}");
        }

        return null;
    }

    // === Relationships ===

    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(User::class, 'provider_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function quotes(): HasMany
    {
        return $this->hasMany(JobQuote::class);
    }

    public function messages(): HasMany
    {
        return $this->hasMany(JobMessage::class)->orderBy('created_at');
    }

    public function updateRequests(): HasMany
    {
        return $this->hasMany(JobUpdateRequest::class)->latest();
    }

    public function messageReads(): HasMany
    {
        return $this->hasMany(JobMessageRead::class);
    }

    public function latestQuote(): HasOne
    {
        return $this->hasOne(JobQuote::class)->latestOfMany();
    }

    public function approvedQuote(): HasOne
    {
        return $this->hasOne(JobQuote::class)->where('status', 'approved');
    }

    public function attachments(): HasMany
    {
        return $this->hasMany(JobAttachment::class);
    }

    public function statusUpdates(): HasMany
    {
        return $this->hasMany(JobStatusUpdate::class)->orderBy('created_at', 'desc');
    }

    public function payment(): HasOne
    {
        return $this->hasOne(Payment::class);
    }

    // === Status ===

    public function updateStatus(JobStatus $status, ?string $note = null, ?int $userId = null): void
    {
        $this->update(['status' => $status]);

        $this->statusUpdates()->create([
            'status' => $status->value,
            'note' => $note,
            'user_id' => $userId,
        ]);

        if ($status === JobStatus::Completed) {
            $this->update(['completed_at' => now()]);
        }

        $this->sendStatusChangeEmail($status, $note);
    }

    private function sendStatusChangeEmail(JobStatus $status, ?string $note): void
    {
        // Skip Requested status — already covered by JobConfirmation email
        if ($status === JobStatus::Requested) {
            return;
        }

        $email = $this->contact_email;

        if (!$email) {
            return;
        }

        Mail::to($email)->send(new JobStatusChanged($this, $status, $note));
    }

    // === Scopes ===

    public function scopeGuests($query)
    {
        return $query->whereNull('customer_id');
    }

    public function scopeRegistered($query)
    {
        return $query->whereNotNull('customer_id');
    }
}
