<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CommunityInitiatives extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'date_finish'
    ];

    protected $casts = [
        'date_finish' => 'date'
    ];

    public function supportingUsers()
    {
        return $this->hasMany(CommunityInitiativesUser::class, 'community_initiative_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'community_initiatives_users', 'community_initiative_id', 'user_id');
    }

  

    public function getSupportersCountAttribute()
    {
        return $this->supportingUsers()->count();
    }

    // Check if a specific user supports this initiative
    public function isSupportedByUser($userId)
    {
        return $this->supportingUsers()->where('user_id', $userId)->exists();
    }


}
