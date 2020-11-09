<?php

namespace App\Models\institutions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    public function institution_subjects()
    {
        return $this->hasMany('App\Models\institutions\InstitutionSubject','institution_id');
    }

    public function academicLevel()
    {
        return $this->belongsTo('App\Models\settings\AcademicLevel','academicLevel_id');
    }

    public function country()
    {
        return $this->belongsTo('App\Models\settings\Country','country_id');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\settings\City','city_id');
    }
}
