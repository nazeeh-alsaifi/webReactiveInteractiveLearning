<?php

namespace App\Models\users;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $guarded = ['id'];  


    public function institutionClasses()
    {
        return $this->hasMany('App\Models\institutions\InstitutionClass','teacher_id');
    }

    public function nationality()
    {
        return $this->belongsTo('App\Models\settings\Nationality','nationality_id');
    }

    public function subject()
    {
        return $this->belongsTo('App\Models\settings\Subject','subject_id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\Models\Users','user_id');
    } 
}
