<?php

namespace App\Models\institutions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionSubject extends Model
{
    use HasFactory;

    public function institution()
    {
        return $this->belongsTo('App\Models\institutions\Institution','institution_id');
    }
    public function institutionClasses()
    {
        return $this->hasMany('App\Models\institutions\InstitutionClass','institution_subject_id');
    }
    public function subjectCoordinator()
    {
        return $this->hasOne('App\Models\users\SubjectCoordinator','institution_subject_id');
    }
    public function durationCourses()
    {
        return $this->hasOne('App\Models\durations\DurationCourseInstitution','institution_subject_id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\settings\Subject','subject_id');
    }
}
