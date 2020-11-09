<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function institutions()
    {
        return $this->hasMany('App\Models\institutions\Institution','country_id');
    }
}
