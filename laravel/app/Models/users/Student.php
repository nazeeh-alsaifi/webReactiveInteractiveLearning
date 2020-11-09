<?php

namespace App\Models\users;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    public function studentClasses()
    {
        return $this->hasMany('App\Models\institutions\StudentClass','student_id');
    }

    public function nationality()
    {
        return $this->belongsTo('App\Models\settings\Nationality','nationality_id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\Users','user_id');
    } 
}
