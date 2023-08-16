<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'amount',
        'charge',
        'user_id',
        'commant',
        'method_id',
    ];

    public function method()
    {
        return $this->belongsTo(WithdrawMethod::class, 'method_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopePending()
    {
        return $this->where('status', 'pending');
    }

    public function scopeApproved()
    {
        return $this->where('status', 'approved');
    }

    public function scopeRejected()
    {
        return $this->where('status', 'rejected');
    }
}
