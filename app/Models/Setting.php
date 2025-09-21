<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function booted()
    {
        static::updated(function ($setting) {
            \Cache::forget('site.setting');
        });
    }

}
