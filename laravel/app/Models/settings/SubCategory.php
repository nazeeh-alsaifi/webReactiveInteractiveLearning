<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo('App\Models\settings\Category','category_id');
    }
}
