<?php

namespace App\Models\users;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public function institutionClasses()
    {
        return $this->hasMany('App\Models\institutions\InstitutionClass','teacher_id');
    }
}
