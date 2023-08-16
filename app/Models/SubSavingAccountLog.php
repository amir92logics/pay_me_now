<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSavingAccountLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'trx',
        'trx_type',
        'details',
        'amount',
        'charge',
        'initial_balance',
        'user_id',
        'sub_saving_account_id',
    ];

    public function account()
    {
        return $this->belongsTo(SubSavingAccount::class);
    }
    protected static function booted()
    {
        static::saving(function (Model $model) {
            if (!isset($model->user_id)) {

                $model->user_id = auth()->id();
            }
        });
    }

    public function getAmountAttribute($value)
    {
        return ($value / 100);
    }

    public function setAmountAttribute($value)
    {
        $this->attributes['amount'] = $value * 100;
    }

    public function getChargeAttribute($value)
    {
        return ($value / 100);
    }

    public function setChargeAttribute($value)
    {
        $this->attributes['charge'] = $value * 100;
    }

    public function getInitialBalanceAttribute($value)
    {
        return ($value / 100);
    }

    public function setInitialBalanceAttribute($value)
    {
        $this->attributes['initial_balance'] = $value * 100;
    }
}
