<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportantLink extends Model
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

    // Check if link is external
    public function getIsExternalAttribute()
    {
        return !str_starts_with($this->link, '/') && 
               (str_starts_with($this->link, 'http://') || str_starts_with($this->link, 'https://'));
    }

    // Get formatted link
    public function getFormattedLinkAttribute()
    {
        if ($this->is_external) {
            return $this->link;
        }
        
        // If it's an internal link, make sure it starts with /
        return str_starts_with($this->link, '/') ? $this->link : '/' . $this->link;
    }

    // Get icon HTML
    public function getIconHtmlAttribute()
    {
        // If icon is an emoji or HTML entity
        if (mb_strlen($this->icon) <= 4 && !str_contains($this->icon, '<')) {
            return $this->icon;
        }
        
        // If icon is HTML (like FontAwesome class)
        if (str_contains($this->icon, 'fa-') || str_contains($this->icon, '<i')) {
            return $this->icon;
        }
        
        // Default fallback
        return '🔗';
    }
}
