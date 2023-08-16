<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'data_key',
        'data_type',
        'data_text',
        'data_text2',
    ];
}
