<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    public function unitMeasures()
    {
        return $this->hasMany('App\Models\settings\UnitMeasure','unit_id');
    }

}
