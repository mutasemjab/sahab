<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $guarded = [];

    const TYPE_COMPLETED = 1;
    const TYPE_ONGOING = 2;
    const TYPE_PLANNED = 3;

    // Accessor for status text
    public function getStatusTextAttribute()
    {
        switch ($this->type) {
            case self::TYPE_COMPLETED:
                return 'completed';
            case self::TYPE_ONGOING:
                return 'ongoing';
            case self::TYPE_PLANNED:
                return 'planned';
            default:
                return 'unknown';
        }
    }

    // Scope for filtering by type
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    public function scopeCompleted($query)
    {
        return $query->where('type', self::TYPE_COMPLETED);
    }

    public function scopeOngoing($query)
    {
        return $query->where('type', self::TYPE_ONGOING);
    }

    public function scopePlanned($query)
    {
        return $query->where('type', self::TYPE_PLANNED);
    }
}
