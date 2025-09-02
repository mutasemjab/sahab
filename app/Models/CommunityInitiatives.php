<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CommunityInitiatives extends Model
{
    use HasFactory;

    protected $guarded = [];

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
    public function getLocalizedTitleAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->title_ar : $this->title_en;
    }

    /**
     * Get localized description
     */
    public function getLocalizedDescriptionAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->description_ar : $this->description_en;
    }

    /**
     * Get initiative status
     */
    public function getStatusAttribute()
    {
        if (!$this->date_finish) {
            return [
                'key' => 'ongoing',
                'label' => __('messages.ongoing'),
                'class' => 'success'
            ];
        }

        $finishDate = Carbon::parse($this->date_finish);
        $now = Carbon::now();

        if ($finishDate->isFuture()) {
            return [
                'key' => 'active',
                'label' => __('messages.active'),
                'class' => 'primary'
            ];
        } else {
            return [
                'key' => 'completed',
                'label' => __('messages.completed'),
                'class' => 'secondary'
            ];
        }
    }

    /**
     * Get formatted finish date
     */
    public function getFormattedFinishDateAttribute()
    {
        if (!$this->date_finish) {
            return __('messages.no_end_date');
        }

        return $this->date_finish->format('Y-m-d');
    }
}
