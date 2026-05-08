<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_charge_amount',
        'urgent_surcharge_amount',
    ];

    protected $casts = [
        'visit_charge_amount' => 'decimal:2',
        'urgent_surcharge_amount' => 'decimal:2',
    ];

    public static function current(): self
    {
        return static::query()->firstOrCreate([], [
            'visit_charge_amount' => 350,
            'urgent_surcharge_amount' => 500,
        ]);
    }
}
