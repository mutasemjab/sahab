<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function serviceForms()
    {
        return $this->hasMany(ServiceForm::class);
    }

    public function serviceDetails()
    {
        return $this->hasOne(ServiceDetail::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }
}
