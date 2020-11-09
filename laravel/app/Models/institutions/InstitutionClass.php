<?php

namespace App\Models\institutions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionClass extends Model
{
    use HasFactory;

    public function institutionSubject()
    {
        return $this->belongsTo('App\Models\institutions\InstitutionSubject','institution_subject_id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\users\Teacher','teacher_id');
    }

    public function studentClasses()
    {
        return $this->hasMany('App\Models\institutions\StudentClass','institution_class_id');
    }
}
