<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function sections(){
        return $this->belongsToMany("sections_components","component_id","section_id");
    }


}
