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
        return $this->hasOne('App\Models\users\ActivationCodes','user_id');
    }

    public function employee()
    {
        return $this->hasOne('App\Models\users\Employee','user_id');
    }

    public function student()
    {
        return $this->hasOne('App\Models\users\Student','user_id');
    }

    public function teacher()
    {
        return $this->hasOne('App\Models\users\Teacher','user_id');
    }

    public function subjectCoordinator()
    {
        return $this->hasOne('App\Models\users\SubjectCoordinator','user_id');
    }

    protected $dates = [
        'deleted_at'
    ];
}