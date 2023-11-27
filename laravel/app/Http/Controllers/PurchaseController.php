<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\institutions\Institution;
use App\Models\institutions\InstitutionSubject;
use App\Models\users\SubjectCoordinator;
use App\Models\settings\City;
use App\Models\settings\Country;
use App\Models\settings\Subject;
use App\Models\settings\AcademicLevel;
use App\Models\users\ActivationCodes;
use App\Models\durations\DurationCourseInstitution;
use App\Models\durations\DurationCourse;
use App\Models\users\Teacher;
use App\Models\users\Student;
use Carbon\Carbon;
use Keygen\Keygen;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAcademicLevels()
    {
       return AcademicLevel::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCountries()
    {
       return Country::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCities()
    {
       return City::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubjects()
    {
       return Subject::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'First_Name'=>'required',
            'Last_Name'=>'required',
            'Mobile'=>'required',
            'Institution_Academy_Type'=>'required',
            'Institution_Name'=>'required',
            'Department_Of_Institution'=>'required',
            'Country'=>'required',
            'City'=>'required',
            'Institution_Email'=>'required',
            'Address1'=>'required',
            'Address2'=>'required',
            'Subject'=>'required',
            'Students_Count'=>'required',
            'Teachers_Count'=>'required',
        ]);
        $user = new User;
        $user->name = $request->input('First_Name').' '.$request->input('Last_Name');
        $user->password = Hash::make('password');
        $user->email = $request->input('email');
        $user->assignRole('coordinator');
        $user->menuroles = 'coordinator';
        //$user->Is_delete = 0;
        //$user->Is_active = 0;
        $user->save();
 
        //coordinator
        $Teacher = new Teacher;
        $Teacher->user_id = $user->id;
        $Teacher->First_name =  $request->input('First_Name');
        $Teacher->Last_Name =  $request->input('Last_Name');
        $Teacher->subject_id =  $request->input('Subject');
        $Teacher->Mobile =  $request->input('Mobile');
        $Teacher->Is_Coordinator = 1;
        $Teacher->save();
        //
        $institution = new Institution;
        $institution->Institu_name = $request->input('Institution_Name');
        $institution->coordinator_id = $user->id;
        $institution->academicLevels_id = $request->input('Institution_Academy_Type');
        $institution->country_id = $request->input('Country');
        $institution->city_id = $request->input('City');
        $institution->Mobile = $request->input('Mobile');
        $institution->Email = $request->input('Institution_Email');
        $institution->Address = $request->input('Address1');
        $institution->Address1 = $request->input('Address2');
        $institution->save();

        //
        $institution_subject = new InstitutionSubject;
        $institution_subject->institution_id = $institution->id;
        $institution_subject->subject_id = $request->input('Subject');
        $institution_subject->Student_count = $request->input('Students_Count');
        $institution_subject->Teacher_count = $request->input('Teachers_Count');
        $institution_subject->buyment_method_id = 1;
        $institution_subject->save();
        //
        $current_date = Carbon::now();
        $Temp_current_date = new Carbon(); 
        $Duration_Course_institution = new DurationCourseInstitution;
        $Duration_Course_institution->institution_subject_id = $institution_subject->id;
        if($institution->academicLevels_id == 1)
        {
             $Duration_Course_institution->duration_course_id = 1;
        }
        if($institution->academicLevels_id == 2)
        {
            $Duration_Course_institution->duration_course_id = 2;
        }
        $Duration_Course_institution->From = $current_date;
        if($institution->academicLevels_id == 1)
        {
            $Duration_Course_institution->To = $Temp_current_date->addMonths(3);
        }
        if($institution->academicLevels_id == 2)
        {
            $Duration_Course_institution->To = $Temp_current_date->addYear();
        }
        $Duration_Course_institution->save();
        //
        $institution_subject_coordinator = new SubjectCoordinator;
        $institution_subject_coordinator->user_id = $user->id;   
        $institution_subject_coordinator->institution_subject_id = $institution_subject->id;
        $institution_subject_coordinator->save();   
        //
        $Activation_code = new ActivationCodes;
        $Activation_code->user_id = $user->id;
        $Activation_code->Activate_code = Keygen::alphanum(8)->generate();
        $Activation_code->save();

        //
         $data = $Activation_code->Activate_code;
        //  Mail::to($user->email)->send(new SendMail($data));
        
        return response()->json( ['status' => 'success'] );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Free_Trail(Request $request)
    {
        $this->validate($request, [
            'Email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'First_Name'=>'required',
            'Last_Name'=>'required',
            'Mobile'=>'required',
            'Academy_Type'=>'required',
            'Institution_Name'=>'required',
            'Department_Of_Institution'=>'required',
            'Country'=>'required',
            'City'=>'required',
            'Address1'=>'required',
            'Address2'=>'required',
            'Subject'=>'required',
            'Students_Count'=>'required',
            'Teachers_Count'=>'required',
        ]);
        $user = new User;
        $user->name = $request->input('First_Name').' '.$request->input('Last_Name');
        $user->password = Hash::make('ssssssss');
        $user->email = $request->input('Email');
        $user->assignRole('coordinator');
        $user->menuroles = 'coordinator';
        //$user->Is_delete = 0;
        //$user->Is_active = 0;
        $user->save();
 
        //coordinator
            $Teacher = new Teacher;
            $Teacher->user_id = $user->id;
            $Teacher->First_name =  $request->input('First_Name');
            $Teacher->Last_Name =  $request->input('Last_Name');
            $Teacher->subject_id =  $request->input('Subject');
            $Teacher->Mobile =  $request->input('Mobile');
            $Teacher->Is_Coordinator = 1;
            $Teacher->save();
        //
        $institution = new Institution;
        $institution->Institu_name = $request->input('Institution_Name');
        $institution->coordinator_id = $user->id;
        $institution->academicLevels_id = $request->input('Academy_Type');
        $institution->country_id = $request->input('Country');
        $institution->city_id = $request->input('City');
        $institution->Mobile = $request->input('Mobile');
        $institution->Email = $request->input('Email');
        $institution->Address = $request->input('Address1');
        $institution->Address1 = $request->input('Address2');
        $institution->save();

        //
        $institution_subject = new InstitutionSubject;
        $institution_subject->institution_id = $institution->id;
        $institution_subject->subject_id = $request->input('Subject');
        $institution_subject->Student_count = $request->input('Students_Count');
        $institution_subject->Teacher_count = $request->input('Teachers_Count');
        $institution_subject->buyment_method_id = 1;
        $institution_subject->save();
        //
        $current_date = Carbon::now();
        $Temp_current_date = new Carbon(); 
        $Duration_Course_institution = new DurationCourseInstitution;
        $Duration_Course_institution->institution_subject_id = $institution_subject->id;
        $Duration_Course_institution->duration_course_id = 3;
        $Duration_Course_institution->From = $current_date;
        $Duration_Course_institution->To = $Temp_current_date->addDays(18);
        $Duration_Course_institution->save();
        //
        $institution_subject_coordinator = new SubjectCoordinator;
        $institution_subject_coordinator->user_id = $user->id;   
        $institution_subject_coordinator->institution_subject_id = $institution_subject->id;
        $institution_subject_coordinator->save();   
        //
        $Activation_code = new ActivationCodes;
        $Activation_code->user_id = $user->id;
        $Activation_code->Activate_code = Keygen::alphanum(8)->generate();
        $Activation_code->save();

        $data = $Activation_code->Activate_code;

        // Mail::to($user->email)->send(new SendMail($data));
        
        return response()->json( ['status' => 'success'] );
    }

      /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function Free_Student(Request $request)
    {
        $this->validate($request, [
            'First_Name' => 'required',
            'Last_Name' => 'required',
            'Email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'Mobile' => 'required',
            'Country' => 'required',
            'City' => 'required',
            'Address1' => 'required',
            'Address2' => 'required',
            'Subject' => 'required',
            'Academy_Type' => 'required',
           // 'Id_buyment_method' => 'required',
       ]);
        $user = new User;
        $user->name = $request->input('First_Name').' '.$request->input('Last_Name');
        $user->password = Hash::make('ssssssss');
        $user->email = $request->input('Email');
        $user->assignRole('free_student');
        $user->menuroles = 'free_student';
        //$user->Is_delete = 0;
        //$user->Is_active = 0;
        $user->save();
       //Students
       $Student = new Student;
       $Student->user_id = $user->id;
       $Student->First_Name = $request->input('First_Name');
       $Student->Last_Name = $request->input('Last_Name');
       $Student->Mobile = $request->input('Mobile');
       $Student->save();
        //
        $institution = new Institution;
        //$institution->id = $user->id;
        $institution->academicLevels_id = $request->input('Academy_Type');
        $institution->Institu_name = $request->input('First_Name').' '.$request->input('Last_Name');
        $institution->country_id = $request->input('Country');
        $institution->city_id = $request->input('City');
        $institution->coordinator_id = $user->id;
        $institution->Mobile = $request->input('Mobile');
        $institution->Email = $request->input('Email');
        $institution->Address = $request->input('Address1');
        $institution->Address1 = $request->input('Address2');
        $institution->save();
   
        //
        $institution_subject = new InstitutionSubject;
        $institution_subject->institution_id = $institution->id;
        $institution_subject->subject_id = $request->input('Subject');
        $institution_subject->Student_count = 1;
        $institution_subject->Teacher_count = 1;
        $institution_subject->buyment_method_id = 1;
        $institution_subject->save();  
        //
        $current_date = Carbon::now();
        $Temp_current_date = new Carbon();
        $Duration_Course_institution = new DurationCourseInstitution;
        $Duration_Course_institution->institution_subject_id = $institution_subject->id;
        $Duration_Course_institution->duration_course_id = 4;
        $Duration_Course_institution->From = $current_date;
        if($institution->academicLevels_id == 1)
        {
            $Duration_Course_institution->To = $Temp_current_date->addMonths(3);
        }
        if($institution->academicLevels_id == 2)
        {
            $Duration_Course_institution->To = $Temp_current_date->addYear();
        }
        $Duration_Course_institution->save();
        //
        $institution_subject_coordinator = new SubjectCoordinator;
        $institution_subject_coordinator->user_id = $user->id;   
        $institution_subject_coordinator->institution_subject_id = $institution_subject->id;
        $institution_subject_coordinator->save(); 
        //
        $Activation_code = new ActivationCodes;
        $Activation_code->user_id = $user->id;
        $Activation_code->Activate_code = Keygen::alphanum(8)->generate();
        $Activation_code->save();
   
        $data = $Activation_code->Activate_code;
        // Mail::to($user->email)->send(new SendMail($data));
        
        return response()->json( ['status' => 'success'] );
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
