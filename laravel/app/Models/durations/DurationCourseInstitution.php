<?php

namespace App\Models\durations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DurationCourseInstitution extends Model
{
    use HasFactory;
    
    public function institutionSubject()
    {
        return $this->belongsTo('App\Models\institutions\InstitutionSubject','institution_subject_id');
    }
}
