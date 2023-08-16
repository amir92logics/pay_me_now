<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_key',
        'data_type',
        'data_value',
        'loan_id',
    ];
}
