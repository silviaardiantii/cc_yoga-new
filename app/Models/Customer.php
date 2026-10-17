<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'customer_code',
        'credit_balance',
    ];

    public static function generateCode(): string
    {
        do {
            $code = 'YOGA-' . strtoupper(Str::random(6));
        } while (static::where('customer_code', $code)->exists());

        return $code;
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function creditTransactions(): HasMany
    {
        return $this->hasMany(CreditTransaction::class);
    }
}