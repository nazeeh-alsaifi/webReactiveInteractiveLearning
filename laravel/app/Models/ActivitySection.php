<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivitySection extends Model
{
    use HasFactory;

    protected $guarded = ['id'];  

    public function activities(){
        return $this->belongsTo('App\Models\Activity',"activity_id");

    }
}
