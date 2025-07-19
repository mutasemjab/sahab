<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;
    protected $guarded = [];

     protected $casts = [
        'photo' => 'array',
        'another_photo' => 'array',
        'lat' => 'double',
        'lng' => 'double'
    ];

    // Constants for gender
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;

    // Constants for hide_information
    const HIDE_YES = 1;
    const HIDE_NO = 2;

    // Constants for status
    const STATUS_PENDING = 1;
    const STATUS_WORKING = 2;
    const STATUS_DONE = 3;
    const STATUS_OUTSIDE_JURISDICTION = 4;
    const STATUS_NOT_SOLVED = 5;

    // Constants for emergency
    const EMERGENCY_YES = 1;
    const EMERGENCY_NO = 2;

    // Relationships
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function placeComplaint()
    {
        return $this->belongsTo(PlaceComplaint::class);
    }

    // Accessors
    public function getGenderTextAttribute()
    {
        return $this->gender == self::GENDER_MALE ? 'male' : 'female';
    }

    public function getStatusTextAttribute()
    {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 'pending';
            case self::STATUS_WORKING:
                return 'working';
            case self::STATUS_DONE:
                return 'done';
            case self::STATUS_OUTSIDE_JURISDICTION:
                return 'outside_jurisdiction';
            case self::STATUS_NOT_SOLVED:
                return 'not_solved';
            default:
                return 'unknown';
        }
    }
}
