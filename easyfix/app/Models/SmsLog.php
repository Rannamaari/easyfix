<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SmsLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_request_id',
        'job_quote_id',
        'type',
        'status',
        'destination',
        'source',
        'provider_transaction_id',
        'content',
        'error_message',
        'provider_response',
        'meta',
        'sent_at',
    ];

    protected $casts = [
        'provider_response' => 'array',
        'meta' => 'array',
        'sent_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function jobRequest(): BelongsTo
    {
        return $this->belongsTo(JobRequest::class);
    }

    public function jobQuote(): BelongsTo
    {
        return $this->belongsTo(JobQuote::class);
    }
}
