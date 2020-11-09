<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nationality extends Model
{
    use HasFactory;

    public function employees()
    {
        return $this->hasMany('App\Models\users\Employee','nationality_id');
    }

    public function students()
    {
        return $this->hasMany('App\Models\users\Student','nationality_id');
    }

    public function teachers()
    {
        return $this->hasMany('App\Models\users\Teacher','nationality_id');
    }
}
