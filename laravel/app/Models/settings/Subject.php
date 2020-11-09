<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function institutionSubjects()
    {
        return $this->hasMany('App\Models\institutions\InstitutionSubject','subject_id');
    }

    public function categories()
    {
        return $this->hasMany('App\Models\settings\Category','subject_id');
    }

    public function teachers()
    {
        return $this->hasMany('App\Models\users\Teacher','subject_id');
    }

    public function subSubjects()
    {
        return $this->hasMany('App\Models\settings\SubSubject','subject_id');
    }
}
