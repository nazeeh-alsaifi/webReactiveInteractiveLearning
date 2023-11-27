<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeasureTool extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];  

    public function units(){
        $this->hasMany("App\Models\settings\Unit","measureTool_id");
    }

}
