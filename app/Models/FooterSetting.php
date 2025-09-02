<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FooterSetting extends Model
{
    use HasFactory;

    protected $fillable = ['section', 'title', 'route_name', 'is_active', 'order'];

    public static function getBySection($section)
    {
        return self::where('section', $section)
                  ->where('is_active', true)
                  ->orderBy('order')
                  ->get();
    }
}
