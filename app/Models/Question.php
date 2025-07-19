<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $guarded = [];

     public function getQuestionAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->question_ar : $this->question_en;
    }

    // Get answer based on current locale
    public function getAnswerAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->answer_ar : $this->answer_en;
    }

    // Search scope for questions
    public function scopeSearch($query, $term)
    {
        return $query->where(function($q) use ($term) {
            $q->where('question_ar', 'LIKE', "%{$term}%")
              ->orWhere('question_en', 'LIKE', "%{$term}%")
              ->orWhere('answer_ar', 'LIKE', "%{$term}%")
              ->orWhere('answer_en', 'LIKE', "%{$term}%");
        });
    }
}
