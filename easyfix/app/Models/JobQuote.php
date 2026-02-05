<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JobQuote extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_request_id',
        'amount',
        'notes',
        'status',
        'tax_enabled',
        'tax_rate',
        'subtotal',
        'tax_amount',
        'total',
        'invoice_number',
        'invoiced_at',
        'approved_at',
        'rejected_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'tax_enabled' => 'boolean',
        'tax_rate' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total' => 'decimal:2',
        'invoiced_at' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    public function jobRequest(): BelongsTo
    {
        return $this->belongsTo(JobRequest::class);
    }

    public function items()
    {
        return $this->hasMany(JobQuoteItem::class);
    }

    public function approve(): void
    {
        $invoiceNumber = $this->invoice_number ?: 'INV-' . str_pad((string) $this->id, 6, '0', STR_PAD_LEFT);
        $this->update([
            'status' => 'approved',
            'approved_at' => now(),
            'invoice_number' => $invoiceNumber,
            'invoiced_at' => now(),
        ]);
    }

    public function reject(): void
    {
        $this->update([
            'status' => 'rejected',
            'rejected_at' => now(),
        ]);
    }

    public function isPending(): bool
    {
        return $this->status === 'sent';
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function recalculateTotals(array $items, bool $taxEnabled, float $taxRate = 8.0): array
    {
        $subtotal = collect($items)->sum(function ($item) {
            return (float) ($item['amount'] ?? 0);
        });

        $taxAmount = $taxEnabled ? round($subtotal * ($taxRate / 100), 2) : 0.0;
        $total = $subtotal + $taxAmount;

        return [
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'total' => $total,
            'tax_rate' => $taxRate,
            'tax_enabled' => $taxEnabled,
        ];
    }
}
