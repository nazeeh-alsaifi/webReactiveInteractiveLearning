<?php

namespace App\Models\users;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectCoordinator extends Model
{
    use HasFactory;

    public function institutionSubject()
    {
        return $this->belongsTo('App\Models\institutions\InstitutionSubject','institution_subject_id');
    }
}
