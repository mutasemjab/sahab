<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $guarded = [];

       protected $casts = [
        'photo' => 'array',
        'video' => 'array',
    ];

    // Get photo URLs
    public function getPhotoUrlsAttribute()
    {
        if (!$this->photo) {
            return [];
        }
        
        return collect($this->photo)->map(function ($photo) {
            return asset('assets/admin/uploads/' . $photo);
        })->toArray();
    }

    // Get video data with URLs
    public function getVideoDataAttribute()
    {
        if (!$this->video) {
            return [];
        }
        
        return collect($this->video)->map(function ($video) {
            return [
                'title' => $video['title'] ?? '',
                'date' => $video['date'] ?? '',
                'thumbnail' => asset('assets/admin/uploads/' . ($video['thumbnail'] ?? '')),
                'video_url' => asset('assets/admin/uploads/' . ($video['video_url'] ?? ''))
            ];
        })->toArray();
    }
}
