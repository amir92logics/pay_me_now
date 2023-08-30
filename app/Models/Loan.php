<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    public function attributes()
    {
        return $this->hasMany(LoanAttribute::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(LoanPlan::class);
    }

    protected $casts = [
        'user_data' => 'json',
        'user_docs' => 'json',
    ];
}
