<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Users extends Model
{
    use SoftDeletes;

    /**
     * Get the notes for the users.
     */
    public function notes()
    {
        return $this->hasMany('App\Notes');
    }

    public function activationCodes()
    {
        return $this->hasMany('App\Models\users\ActivationCodes','user_id');
    }

    public function employees()
    {
        return $this->hasMany('App\Models\users\Employee','user_id');
    }

    public function students()
    {
        return $this->hasMany('App\Models\users\Student','user_id');
    }

    public function teachers()
    {
        return $this->hasMany('App\Models\users\Teacher','user_id');
    }

    public function subjectCoordinator()
    {
        return $this->hasMany('App\Models\users\SubjectCoordinator','user_id');
    }

    protected $dates = [
        'deleted_at'
    ];
}