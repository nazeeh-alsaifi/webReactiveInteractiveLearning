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
use App\Models\institutions\InstitutionClass;
use App\Models\institutions\StudentClass;
use App\Models\users\SubjectCoordinator;
use App\Models\users\Teacher;
use App\Models\settings\Nationality;
use App\Models\users\Student;
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
    public function updateCoordinatorProfile(Request $request){
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

    public function createTeachers(Request $request){
        $validatedRequest = $request->validate([
            "id" => "required",
        ]);
        // if coordinator and each institution hasmany institution subjects how to decide which subject by his id
        // coordinator shouldnt be able to add teachers 

        // $user = User::find($validatedRequest["id"]);
        $subject_coordinator = SubjectCoordinator::where("user_id","=",$validatedRequest["id"])->first();
        // $institution= Institution::where("coordinator_id","=",$validatedRequest["id"])->first();
        // $institution_subject = $institution->institution_subjects()->first();
        $institution_subject = InstitutionSubject::find($subject_coordinator->institution_subject_id);
        $users=array();

        for($i=0 ; $i<$institution_subject->Teacher_count ; $i++){

             // we need to add a default nationality 
            $user =User::create([
                "name" => 'default',
                "password" => Hash::make('First_Name'),
                "email" => Keygen::alphanum(12)->generate(),
                "menuroles" => "teacher",
                "status" => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $user->assignRole("teacher");
            $user->save();
            // $users[] = $user;

            $teacher = Teacher::create([
                    'First_name' =>'default',
                    'Last_Name' => 'default',
                    'subject_id' => $institution_subject->subject_id,
                    'nationality_id'=> 1,
                    'Mobile' => 0,
                    'Gender' => 'default',
                    'birth_date' => now(),
                    'user_id' => $user->id,
                    'Is_Coordinator' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
            ]);

            $activeCode = ActivationCodes::create([
                "Activate_code" => Keygen::alphanum(8)->generate(),
                "user_id" => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);



            $institutionClass = InstitutionClass::create([
                "teacher_id" => $teacher->id,
                "institution_subject_id" =>$institution_subject->id  ,
                "keyclass" => $activeCode->Activate_code ,
                'created_at' => now(),
                'updated_at' => now(),
            ]);



            $data = array(
            "user_id" => $user->id,
            "kClass"=> $institutionClass->keyclass);
            
            $users[] = (object) $data;

            

        }
        // ActivationCodes::where('user_id','=',$validatedRequest["id"])->delete();
        return response()->json(array("success" => true,"users" =>$users));

    }

    public function updateTeachers(Request $request){
        $validatedRequest = $request->validate([
            'data' => 'required'
        ]);

        foreach($validatedRequest['data'] as  $teacherData ){
            $user=User::find($teacherData["user_id"]);
            $user->name = $teacherData["firstName"] . " " . $teacherData["lastName"];
            $user->email = $teacherData["email"];
            $user->save();

            $teacher = Teacher::where("user_id",'=',$teacherData["user_id"])->first();
            $teacher->First_name = $teacherData["firstName"];
            $teacher->Last_Name = $teacherData["lastName"];
            $teacher->save();

            // Mail::to($teacherData["email"])->send(new SendMail($teacherData["kClass"]));

        }

        return response()->json(array("success" => true));

    }

    public function updateTeacherProfile(Request $request){
        $validatedRequest = $request->validate([
            "id" => "required",
            "email" => "required|email",
            "new_password" => "required", 
            "firstName" => "required",
            "lastName" => "required",
            "nationalityId" => "required",
            "mobile" => 'required',
        ]);
        
        $user = User::find($validatedRequest["id"]);
        if($user->email == $validatedRequest["email"]){
            $user->password = Hash::make($validatedRequest["new_password"]);
            $user->name = $validatedRequest["firstName"] . " " . $validatedRequest["lastName"];
            $user->save();

            $teacher = Teacher::where("user_id",'=',$validatedRequest["id"])->first();
            $teacher->First_name = $validatedRequest["firstName"];
            $teacher->Last_Name = $validatedRequest["lastName"];
            $teacher->nationality_id = $validatedRequest["nationalityId"]; 
            $teacher->Mobile = $validatedRequest["mobile"];
            $teacher->save();

            return response()->json(array('success' => true));
        }
        return response()->json(array('success' => false));

    }

    public function getNationalities()
    {
        return Nationality::all();
    }

    public function getRemainingSeats(Request $request){
        $validatedRequest = $request->validate([
            "id" => "required",
        ]);
        
        $teacher_id = Teacher::where('user_id','=',$validatedRequest["id"])->first()->id;
        $institution_subject_id = InstitutionClass::where("teacher_id",'=',$teacher_id)->first()->institution_subject_id ;
        $total_seats = InstitutionSubject::find($institution_subject_id)->Student_count;

        $occupied_seats_num = 0;

        foreach( InstitutionSubject::find($institution_subject_id)->institutionClasses()->get() as $institutionClass ){
            $occupied_seats_num += $institutionClass->studentClasses()->count();

        }
        $remaining_seats = $total_seats - $occupied_seats_num;

        $New_class_key =Keygen::alphanum(8)->generate();

        return response()->json(array('success' => true,'remaining'=> $remaining_seats,'newKeyClass'=>$New_class_key));
    }

    public function createStudents(Request $request){
        $validatedRequest = $request->validate([
            "id" => "required",
            "numberOfStudents" => "required",
            "newKeyClass" => "required",
        ]);

        $teacher_id = Teacher::where('user_id','=',$validatedRequest["id"])->first()->id;
        $institution_class_id = InstitutionClass::where("teacher_id",'=',$teacher_id)->first()->id;
        $students=array();

        for($i=0 ; $i<$validatedRequest["numberOfStudents"] ; $i++){

            $user =User::create([
                "name" => 'default',
                "password" => Hash::make('First_Name'),
                "email" => Keygen::alphanum(12)->generate(),
                "menuroles" => "student",
                "status" => 'inactive',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $user->assignRole("student");
            $user->save();

            $student=Student::create([
                'First_Name' =>'default',
                'Last_Name' => 'default',
                'nationality_id'=> 1,
                'Mobile' => 0,
                'Gender' => 'default',
                'birth_date' => now(),
                'user_id' => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $student->save();

            $student_class = StudentClass::create([
                "institution_class_id" => $institution_class_id,
                "student_id" => $student->id,
                "New_class_key"=> $validatedRequest["newKeyClass"],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $student_class->save();

            $activeCode = ActivationCodes::create([
                "Activate_code" => $validatedRequest["newKeyClass"],
                "user_id" => $user->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $activeCode->save();
            

        }
        
        // ActivationCodes::where('user_id','=',$validatedRequest["id"])->delete();
        return response()->json(array('success' => true));

    }
}

