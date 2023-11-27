<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructionalPurpose extends Model
{
    use HasFactory;

    public function activities(){
        return $this->hasMany('App\Models\Activity','purpose_id');
    }
}
