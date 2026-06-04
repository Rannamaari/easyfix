<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_request_id',
        'method',
        'amount',
        'slip_attachment',
        'status',
        'notes',
        'confirmed_at',
        'confirmed_by',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'confirmed_at' => 'datetime',
    ];

    public function jobRequest(): BelongsTo
    {
        return $this->belongsTo(JobRequest::class);
    }

    public function confirmedByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public function confirm(int $userId): void
    {
        $this->update([
            'status' => 'confirmed',
            'confirmed_at' => now(),
            'confirmed_by' => $userId,
        ]);
    }

    public function reject(int $userId, ?string $notes = null): void
    {
        $this->update([
            'status' => 'rejected',
            'confirmed_by' => $userId,
            'notes' => $notes,
        ]);
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isConfirmed(): bool
    {
        return $this->status === 'confirmed';
    }

    public function isCash(): bool
    {
        return $this->method === 'cash';
    }

    public function isBankTransfer(): bool
    {
        return $this->method === 'bank_transfer';
    }
}
