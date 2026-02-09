<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAddress extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'label',
        'custom_label',
        'address',
        'is_default',
    ];

    public function displayLabel(): string
    {
        if ($this->label === 'other' && $this->custom_label) {
            return ucfirst($this->custom_label);
        }

        return ucfirst($this->label);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
