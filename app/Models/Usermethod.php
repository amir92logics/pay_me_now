<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usermethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'withdraw_method_id',
        'withdraw_infos',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'withdraw_infos' => 'json',
    ];
}
