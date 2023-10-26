<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSavingAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'amount',
        'status',
        'enabled_at',
        'user_id',
    ];

    protected static function booted()
    {
        static::saving(function (Model $model) {
            if (!isset($model->user_id)) {

                $model->user_id = auth()->id();
            }
        });
    }

    public function log()
    {
        return $this->hasMany(SubSavingAccountLog::class);
    }

    // public function getAmountAttribute($value)
    // {
    //     return ($value / 100);
    // }

    // public function setAmountAttribute($value)
    // {
    //     $this->attributes['amount'] = $value * 100;
    // }
}
