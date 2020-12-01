<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LevelOfScaffolding extends Model
{
    use HasFactory;

    public function activities(){
        return $this->hasMany('App\Models\Activity','level_id');
    }
}
