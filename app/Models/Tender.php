<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    use HasFactory;

    protected $guarded = [];

     protected $casts = [
        'pdf_file' => 'array',
        'date_publish' => 'datetime',
        'date_close' => 'datetime'
    ];

    public function tenderDetails()
    {
        return $this->hasOne(TenderDetail::class);
    }

    // Check if tender is expired
    public function getIsExpiredAttribute()
    {
        return Carbon::parse($this->date_close)->isPast();
    }

    // Check if tender is closing soon (within 7 days)
    public function getIsClosingSoonAttribute()
    {
        return !$this->is_expired && Carbon::parse($this->date_close)->diffInDays() <= 7;
    }

    // Get days remaining
    public function getDaysRemainingAttribute()
    {
        if ($this->is_expired) {
            return 0;
        }
        return Carbon::parse($this->date_close)->diffInDays();
    }

}
