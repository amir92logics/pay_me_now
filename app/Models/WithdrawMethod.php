<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawMethod extends Model
{
    protected $guarded = ['id'];
    protected $table = "withdraw_methods";

    protected $casts = [
        'user_data' => 'object',
    ];

    public function usermethod()
    {
        return $this->hasOne(Usermethod::class)->where('user_id', auth()->id());
    }
}
