<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function institutions()
    {
        return $this->hasMany('App\Models\institutions\Institution','city_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\settings\Country','country_id');
    }

    public function employees()
    {
        return $this->hasMany('App\Models\users\Employee','city_id');
    }
}
