<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function subject()
    {
        return $this->belongsTo('App\Models\settings\Subject','subject_id');
    }    

    public function subCategories()
    {
        return $this->hasMany('App\Models\settings\SubCategory','category_id');
    }
}
