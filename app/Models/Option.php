<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Option extends Model
{
    use HasFactory;

    protected $casts = [
        'value' => 'json'
    ];

    protected $guarded = ['id'];

    // public function getAttribute($key): mixed
    // {
    //     $attribute = parent::getAttribute($key);

    //     if ($attribute === null && array_key_exists($key, $this->value ?? [])) {
    //         return $this->value[$key];
    //     }

    //     return $attribute;
    // }

    protected static function boot()
    {
        parent::boot();

        static::saving(function($model) {
            Cache::forget($model->key);
        });
    }
}
