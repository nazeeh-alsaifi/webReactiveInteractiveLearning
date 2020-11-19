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
    public function getActivationCodes(){
        return ActivationCodes::all();
    }
    // public function getTeacher(Request $request)
    // {
    //     $teacher =Teacher::find($request->input('id'));
    //     return response()->json(["teacher"=>$teacher]);
    // }

    public function checkActivationCode(Request $request){
        $validatedRequest =$request->validate( [
            'activationCode' => 'required',
        ]);
            $user_id = ActivationCodes::select("user_id")->where('Activate_code','=',$request->activationCode)->first()->user_id;
            // getting the user to change its status
            $user = User::find($user_id);
            $user->status ="Active";
            $user->save();

            $role = $user->menuroles;
            
            return response()->json(['role'=>$role,'id'=>$user_id]);
        
       
    }
    public function updateTeacher(Request $request){
        // TODO:we have to add old password check in the future 
        $validatedRequest = $request->validate([
            "id" => "required",
            "email" => "required|email",
            "new_password" => "required"
        ]);
        
        $user = User::find($validatedRequest["id"]);
        if($user->email == $validatedRequest["email"]){
            $user->password = Hash::make($validatedRequest["new_password"]);
            $user->save();
            return response()->json(array('success' => true));
        }
      
        return response()->json(array('success' => false));
        

    }
}