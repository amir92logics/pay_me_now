<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FixDeposit extends Model
{
    use HasFactory;
    
    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function plan(){
        return $this->hasOne(Plan::class, 'id', 'plan_id');
    }
}
