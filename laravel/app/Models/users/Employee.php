<?php

namespace App\Models\users;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    public function country()
    {
        return $this->belongsTo('App\Models\settings\Country','country_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\settings\City','city_id');
    }

    public function nationality()
    {
        return $this->belongsTo('App\Models\settings\Nationality','nationality_id');
    }
    public function user()
    {
        return $this->belongsTo('App\Models\Users','user_id');
    } 
}
