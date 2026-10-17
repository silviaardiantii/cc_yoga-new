<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    protected $fillable = [
        'customer_id',
        'customer_name',
        'booking_code',
        'yoga_class_id',
        'status',
        'credits_used',
        'cancelled_at',
    ];

    protected $casts = [
        'cancelled_at' => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function yogaClass(): BelongsTo
    {
        return $this->belongsTo(YogaClass::class);
    }
}
