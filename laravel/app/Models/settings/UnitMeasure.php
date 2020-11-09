<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitMeasure extends Model
{
    use HasFactory;

    public function unit()
    {
        return $this->belongsTo('App\Models\settings\Unit','unit_id');
    }
}
