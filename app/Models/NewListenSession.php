<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewListenSession extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function getTitleAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->title_ar : $this->title_en;
    }

    // Get description based on current locale
    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->description_ar : $this->description_en;
    }

    // Get photo URL
    public function getPhotoUrlAttribute()
    {
        return $this->photo ? asset('assets/admin/uploads/' . $this->photo) : null;
    }
}
