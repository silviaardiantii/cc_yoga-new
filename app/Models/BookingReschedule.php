<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookingReschedule extends Model
{
    protected $fillable = [
        'booking_id',
        'from_yoga_class_id',
        'to_yoga_class_id',
        'rescheduled_at',
    ];

    protected $casts = [
        'rescheduled_at' => 'datetime',
    ];

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function fromClass(): BelongsTo
    {
        return $this->belongsTo(
            YogaClass::class,
            'from_yoga_class_id'
        );
    }

    public function toClass(): BelongsTo
    {
        return $this->belongsTo(
            YogaClass::class,
            'to_yoga_class_id'
        );
    }
}