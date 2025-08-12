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
   private function extractYouTubeId($url)
    {
        preg_match('/^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|&v=)([^#&?]*).*/', $url, $matches);
        return (isset($matches[2]) && strlen($matches[2]) === 11) ? $matches[2] : null;
    }

    // Get video data with URLs and thumbnails
    public function getVideoDataAttribute()
    {
        if (!$this->video) {
            return [];
        }
        
        return collect($this->video)->map(function ($video) {
            $youtubeId = $this->extractYouTubeId($video['video_url'] ?? '');
            
            return [
                'title' => $video['title'] ?? '',
                'date' => $video['date'] ?? '',
                'video_url' => $video['video_url'] ?? '',
                'youtube_id' => $youtubeId,
                'thumbnail' => $video['thumbnail'] ?? ($youtubeId ? "https://img.youtube.com/vi/{$youtubeId}/maxresdefault.jpg" : null)
            ];
        })->toArray();
    }
}
