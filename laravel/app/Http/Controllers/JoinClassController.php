<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\users\ActivationCodes;
use App\Models\institutions\Institution;
use App\Models\institutions\InstitutionSubject;
use App\Models\users\SubjectCoordinator;
use App\Models\users\Teacher;
use App\Models\Institutions\Institution_keyClass;//
use App\Models\Institutions\teacher_class;//
use App\Models\Settings\Nationality;//
use App\Models\users\Student;
use App\Models\Institutions\Students_class;//
use App\Models\settings\City;
use App\Models\settings\Country;
use App\Models\settings\Subject;
use App\Models\settings\AcademicLevel;
use App\Models\durations\DurationCourseInstitution;
use App\Models\durations\DurationCourse;
use DB;
use Keygen\Keygen;


class JoinClassController extends Controller
{
    public function __construct(){

    }

    
}
