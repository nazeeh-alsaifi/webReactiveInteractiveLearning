<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Tag;
use App\Models\institutions\InstitutionClass;

class Activity extends Model
{
    use HasFactory;

    protected $guarded = ['id'];  

    public function tags(){
        return $this->belongsToMany("App\Models\Tag","activities_tags","activity_id","tag_id");
    }
    public function institution_classes(){
        return $this->belongsToMany("App\Models\institutions\InstitutionClass;","activities_institution_classes","activity_id","institution_class_id");
    }
    public function sections(){
        return $this->hasMany('App\Models\ActivitySection',"activity_id");

    }
}
