<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RequestPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_request_id',
        'original_name',
        'disk',
        'photo_path',
        'thumb_path',
        'mime',
        'size_bytes',
        'width',
        'height',
        'status',
        'caption',
    ];

    public function jobRequest(): BelongsTo
    {
        return $this->belongsTo(JobRequest::class);
    }
}
