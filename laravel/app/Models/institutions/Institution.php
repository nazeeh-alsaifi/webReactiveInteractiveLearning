<?php

namespace App\Models\institutions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;

    public function institution_subjects()
    {
        return $this->hasMany('App\Models\institutions\InstitutionSubject');
    }
}
