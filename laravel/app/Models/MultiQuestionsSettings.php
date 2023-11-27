<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MultiQuestionsSettings extends Model
{
    use HasFactory;

    public function multiQuestions(){
        return $this->belongsTo('App\Models\MultiQuestions',"multi_questions_id");

    }
}
