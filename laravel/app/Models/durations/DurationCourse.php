<?php

namespace App\Models\durations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DurationCourse extends Model
{
    use HasFactory;

    public function durationCourseInstitutions()
    {
        return $this->hasMany('App\Models\durations\DurationCourseInstitution','duration_course_id');
    }
}
