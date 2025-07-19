<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    use HasFactory;

    protected $guarded = [];

     const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    // Constants for hide_information
    const HIDE_YES = 1;
    const HIDE_NO = 2;

    // Constants for status
    const STATUS_PENDING = 1;
    const STATUS_WORKING = 2;
    const STATUS_DONE = 3;

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    
    // Accessor for gender text
    public function getGenderTextAttribute()
    {
        return $this->gender == self::GENDER_MALE ? 'male' : 'female';
    }

    // Accessor for status text
    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 'pending';
            case self::STATUS_WORKING:
                return 'working';
            case self::STATUS_DONE:
                return 'done';
            default:
                return 'unknown';
        }
    }
}
