<?php

namespace App\Models\institutions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    use HasFactory;

    public function institutionClass()
    {
        return $this->belongsTo('App\Models\institutions\InstitutionClass','institution_class_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\users\Student','student_id');
    }
}
