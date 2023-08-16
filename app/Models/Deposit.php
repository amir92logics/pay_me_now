<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trx',
        'amount',
        'status',
        'charge',
        'rate',
        'type',
        'meta',
    ];

    protected $casts = [
        'meta' => 'json'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }

    public function gateway(): BelongsTo
    {
        return $this->belongsTo(Gateway::class);
    }

    public function scopePending()
    {
        return $this->where('status', 2);
    }

    // public function getAttribute($key): mixed
    // {
    //     $attribute = parent::getAttribute($key);

    //     if ($attribute === null && array_key_exists($key, $this->meta ?? [])) {
    //         return $this->meta[$key];
    //     }

    //     return $attribute;
    // }
}
