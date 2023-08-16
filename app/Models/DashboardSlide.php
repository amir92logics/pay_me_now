<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardSlide extends Model
{
    use HasFactory;

    protected $fillable = [
        'position',
        'path',
    ];
}
