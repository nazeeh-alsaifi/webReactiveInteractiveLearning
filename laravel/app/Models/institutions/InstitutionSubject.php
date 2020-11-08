<?php

namespace App\Models\institutions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutionSubject extends Model
{
    use HasFactory;

    public function institution()
    {
        return $this->belongTo('App\Models\institutions\Institution');
    }
}
