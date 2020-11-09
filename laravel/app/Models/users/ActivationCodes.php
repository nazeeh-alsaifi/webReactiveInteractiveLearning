<?php

namespace App\Models\users;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivationCodes extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo('App\Models\Users','user_id');
    } 
}
