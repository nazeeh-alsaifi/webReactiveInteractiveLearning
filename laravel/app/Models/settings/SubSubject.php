<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubject extends Model
{
    use HasFactory;
    protected $guarded = ['id'];  


    public function subject()
    {
        return $this->belongsTo('App\Models\settings\Subject','subject_id');
    }
}
