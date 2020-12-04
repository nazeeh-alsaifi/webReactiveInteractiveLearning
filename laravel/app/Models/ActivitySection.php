<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitySection extends Model
{
    use HasFactory;

    protected $guarded = ['id'];  

    protected $table ="activities_sections";

    public function activities(){
        return $this->belongsTo('App\Models\Activity',"activity_id");

    }

    public function components(){
        return $this->belongsToMany("App\Models\settings\Component","sections_components","section_id","component_id");
    }
}
