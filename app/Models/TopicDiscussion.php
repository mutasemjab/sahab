<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicDiscussion extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function votingUsers()
    {
        return $this->belongsToMany(User::class, 'topic_discussion_users', 'topic_discussion_id', 'user_id')
                    ->withTimestamps();
    }

    // Check if user has voted for this topic
    public function isVotedByUser($userId)
    {
        return $this->votingUsers()->where('user_id', $userId)->exists();
    }

    // Get vote count
    public function getVoteCountAttribute()
    {
        return $this->votingUsers()->count();
    }
}
