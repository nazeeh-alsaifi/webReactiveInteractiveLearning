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
}
