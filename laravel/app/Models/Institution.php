<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    public function institution_subjects()
    {
        return $this->hasMany('App\Models\Institution_Subject');
    }
}
