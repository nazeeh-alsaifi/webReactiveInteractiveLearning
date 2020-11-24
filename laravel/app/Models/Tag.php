<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function activities(){
        return $this->belongsToMany("App\Models\Activity","activities_tags","tag_id","activity_id");
    }
}
