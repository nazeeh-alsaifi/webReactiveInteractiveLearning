<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\settings\Nationality;
use App\Models\institutions\Institution;
use App\Models\Institutions\InstitutionSubject;
use App\Models\Institutions\InstitutionClass;
use App\Models\Institutions\StudentClass;
use App\Models\settings\Subject;
use App\Models\settings\SubSubject;
use App\Models\settings\LevelOfScaffolding;
use App\Models\settings\LocationInstructionalCycle;
use App\Models\settings\InstructionalPurpose;
use App\Models\users\Teacher;
use App\Models\users\Student;
use App\Models\users\SubjectCoordinator;
use App\Models\User;
use App\Models\durations\DurationCourseInstitution;
use App\Models\durations\DurationCourse;
use App\Models\users\ActivationCodes;
use App\Models\Activity;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use Keygen\Keygen;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class CoordinatorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('coordinator');
    }
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
    public function getNationalities()
    {
        return Nationality::all();
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInstitution()
    {
        $you = auth()->user();
        $Institution = Institution::where('coordinator_id',$you->id)->first();
        return $Institution;
    }

      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInstitutionSubject()
    {
        $you = auth()->user();
        $Institution = Institution::where('coordinator_id',$you->id)->first();
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','subject_id','Teacher_count','Student_count'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $column= request('column','Institu_name');
        if(!in_array($column,['Institu_name','Email','Mobile','Address','Address1'])){
            $column = 'Component_name';
        }
        $Institution_Subjects = InstitutionSubject::when(request('search','') != '', function($query){
            $query->where('id','LIKE','%'.request('search').'%');
        })->where('institution_id',$Institution->id)->orderBy($sortField,$sortDirection)->paginate(5);
        return $Institution_Subjects;
    }
//
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTeachers()
    {
        return Teacher::all();
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSortTeachers()
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','First_name','Last_Name','Mobile'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $column= request('column','First_name');
        if(!in_array($column,['First_name','Last_Name','Mobile'])){
            $column = 'First_name';
        }
        $Teachers = Teacher::where('Is_Coordinator','0')->when(request('search','') != '', function($query){
            $query->where(request('column',''),'LIKE','%'.request('search').'%');
        })->orderBy($sortField,$sortDirection)->get();
        return $Teachers;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers()
    {
        $you = auth()->user()->id;
        $users = User::whereNull('deleted_at')->get();
        return response()->json( compact('users', 'you') );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNoPageInstitutionSubject()
    {
        $you = auth()->user();
        $Institution = Institution::where('coordinator_id',$you->id)->first();
        $Institution_Subjects = InstitutionSubject::where('institution_id',$Institution->id)->get();
        return $Institution_Subjects;
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllInstitutionSubject()
    {
        return InstitutionSubject::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNoPageClasses()
    {
        return InstitutionClass::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCoordinatorTeachers()
    {
        $coordinator = auth()->user();


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getSubSubjects($id)
    {
        $myClass = InstitutionClass::find($id);
        $myInstitutionSubject = InstitutionSubject::find($myClass->institution_subject_id);
        // get subsubject belongs to our subject and save there ids in array
        $SubSubjects = SubSubject::where('subject_id',$myInstitutionSubject->subject_id)->get();
 
        return $SubSubjects;
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLocationInstructionalCycle()
    {
        return LocationInstructionalCycle::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInstructionalPurpose()
    {
        return InstructionalPurpose::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLevelsOfScaffolding()
    {
        return LevelOfScaffolding::all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getAvailableActivities($id)
    {
       // get subject from institution_subject
       $myClass = InstitutionClass::find($id);
       $myInstitutionSubject = InstitutionSubject::find($myClass->institution_subject_id);
       // get subsubject belongs to our subject and save there ids in an array
       $SubSubjects = SubSubject::where('subject_id',$myInstitutionSubject->subject_id)->get();
       $SubSubjects_id = [];
       foreach($SubSubjects as $SubSubject)
            {
                $array = array($SubSubject->id);
                $SubSubjects_id [] = $array;
            }
        //get activities that already exist in our class and save ids in an array    
        $Class_Activities = InstitutionClass::find($id)->activities()->get();
        $Class_Activities_id = [];
        foreach($Class_Activities as $Class_Activity)
             {
                 $array = array($Class_Activity->id);
                 $Class_Activities_id [] = $array;
             }    
       //$Activities = Activity::whereIn('subsubject_id',$SubSubjects_id)->paginate(6);
       $Activities = Activity::when(request('search','') != '', function($query){
        $query->where('title','LIKE','%'.request('search').'%')->orWhere('objectives','LIKE','%'.request('search').'%');
        })->when(count(request()->input('SubSubjectsFilter',[])), function($query){
        $query->whereIn('subsubject_id',request()->input('SubSubjectsFilter'));
                 })->when(count(request()->input('LocationFilter',[])), function($query){
                 $query->whereIn('location_in_cycle_id',request()->input('LocationFilter'));
                    })->when(count(request()->input('LevelFilter',[])), function($query){
                    $query->whereIn('level_id',request()->input('LevelFilter'));
                         })->when(count(request()->input('InstructionalFilter',[])), function($query){
                         $query->whereIn('purpose_id',request()->input('InstructionalFilter'));
                          })->when(request('is_free','') != 'false', function($query){
                            $query->where('is_free','1');
                            })->whereIn('subsubject_id',$SubSubjects_id)
                            ->whereNotIn('id',$Class_Activities_id)->paginate(6);
       return $Activities;
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMyActivities($id)
    {
       $Activities = InstitutionClass::find($id)->activities()->when(request('search','') != '', function($query){
        $query->where('title','LIKE','%'.request('search').'%')->orWhere('objectives','LIKE','%'.request('search').'%');
          })->when(count(request()->input('SubSubjectsFilter',[])), function($query){
          $query->whereIn('subsubject_id',request()->input('SubSubjectsFilter'));
                 })->when(count(request()->input('LocationFilter',[])), function($query){
                 $query->whereIn('location_in_cycle_id',request()->input('LocationFilter'));
                    })->when(count(request()->input('LevelFilter',[])), function($query){
                    $query->whereIn('level_id',request()->input('LevelFilter'));
                         })->when(count(request()->input('InstructionalFilter',[])), function($query){
                         $query->whereIn('purpose_id',request()->input('InstructionalFilter'));
                          })->when(request('is_free','') != 'false', function($query){
                            $query->where('is_free','1');
                            })->paginate(6);
        return $Activities;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeuserprofile(Request $request)
    {
        $this->validate($request, [
            'email'=> 'required',
           // 'password'=> 'required'
        ]);
        $id = $request->input('id');
        $user = User::find($id);
        if($request->input('password'))
        {
          $user->password = Hash::make($request->input('password'));
        }
        $user->email = $request->input('email');
        //$user->Is_delete = 0;
        $user->save();
        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeteacherprofile(Request $request)
    {
        $this->validate($request, [
            'First_name'=> 'required',
            'Last_Name'=> 'required',
            'Mobile'=> 'required',
            'birth_date'=> 'required',
            'Gender'=> 'required',
            'nationality_id'=> 'required',
        ]);
         if($request->hasFile('image')){
             $filenameWithExt = $request->file('image')->getClientOriginalName();
             $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
             $extension = $request->file('image')->getClientOriginalExtension();
             $fileNameToStore= $filename.'_'.time().'.'.$extension;
             $path = $request->file('image')->storeAs('public/image',$fileNameToStore);
         }
        //$path = $request->file('image')->store('images','public');
        $id = $request->input('id');
        $Teacher = Teacher::find($id);
        $user = User::find($Teacher->user_id);
        $user->name = $request->input('First_name').' '.$request->input('Last_Name');
        if($request->hasFile('image'))
        {
          $user->image = $fileNameToStore;
        }
        $user->save();
        $Teacher->First_name = $request->input('First_name');
        $Teacher->Last_Name = $request->input('Last_Name');
        $Teacher->Mobile = $request->input('Mobile');
        $Teacher->Gender = $request->input('Gender');
        $Teacher->birth_date = $request->input('birth_date');
        $Teacher->nationality_id = $request->input('nationality_id');       
        $Teacher->save();
        return $Teacher;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function new_subject(Request $request)
    {
        //     $this->validate($request, [
        //         'Id_subj' => 'required',
        //         'Student_count' => 'required',
        //         'Teacher_count' => 'required',
        //         //'Id_Duration_tearm' => 'required',
        //         'Subject_Coordinator_password'=>'required',
        //         'Subject_Coordinator_Email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
        //         'Subject_Coordinator_name'=>'required',
        //  ]);
        $user = new User;
        $user->name = $request->input('First_name').' '.$request->input('Last_Name');
        $user->password = Hash::make('password');
        $user->email = $request->input('Subject_Coordinator_Email');
        $user->assignRole('subject_coordinator');
        $user->menuroles = 'subject_coordinator';
        $user->save();
        
        //coordinator//
        $Teacher = new Teacher;
        $Teacher->user_id = $user->id;
        $Teacher->subject_id =  $request->input('subject_id');
        $Teacher->First_name =  $request->input('First_name');
        $Teacher->Last_Name =  $request->input('Last_Name');
        $Teacher->Mobile =  $request->input('Mobile');
        $Teacher->Is_Coordinator = 1;
        $Teacher->save();
        //        
        $you = auth()->user();
        $Institution = Institution::where('coordinator_id',$you->id)->first();
        $Institution_Subject = new InstitutionSubject;
        $Institution_Subject->institution_id = $Institution->id;
        $Institution_Subject->subject_id = $request->input('subject_id');
        $Institution_Subject->Student_count = $request->input('Student_count');
        $Institution_Subject->Teacher_count = $request->input('Teacher_count');

        $Institution_Subject->buyment_method_id = 1;
        $Institution_Subject->save();
           //
           $current_date = Carbon::now();
           $Temp_current_date = new Carbon(); 
           $Duration_Course_institution = new DurationCourseInstitution;
           $Duration_Course_institution->institution_subject_id = $Institution_Subject->id;
           if($Institution->academicLevels_id == 1)
           {
            $Duration_Course_institution->duration_course_id = 1;
           }
           if($Institution->academicLevels_id == 2)
            {
                $Duration_Course_institution->duration_course_id = 2;
            }
           $Duration_Course_institution->From = $current_date;
           if($Institution->academicLevels_id == 1)
           {
               $Duration_Course_institution->To = $Temp_current_date->addMonths(3);
           }
           if($Institution->academicLevels_id == 2)
           {
               $Duration_Course_institution->To = $Temp_current_date->addYear();
           }
           $Duration_Course_institution->save();
   
        $institution_subject_coordinator = new SubjectCoordinator;
        $institution_subject_coordinator->user_id = $user->id;
        $institution_subject_coordinator->institution_subject_id = $Institution_Subject->id;
        $institution_subject_coordinator->save();
        
       //
       $Activation_code = new ActivationCodes;
       $Activation_code->user_id = $user->id;
       $Activation_code->Activate_code = Keygen::alphanum(8)->generate();
       $Activation_code->save();
       $data = $Activation_code->Activate_code;
       Mail::to($user->email)->send(new SendMail($data));
       
        return $Institution_Subject;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMySubject($id)
    {
       $InstitutionSubject = InstitutionSubject::find($id);
       $Subject = Subject::find($InstitutionSubject->subject_id);
       return $Subject;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMyTeacher($id)
    {
       $Teacher = Teacher::find($id);
       return $Teacher;
    }

     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getClasses($id)
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','institution_subject_id','teacher_id','keyclass'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $Institution_keyClasses = InstitutionClass::when(request('search','') != '', function($query){
            $query->where('keyclass','LIKE','%'.request('search').'%');
        })->where('institution_subject_id',$id)->orderBy($sortField,$sortDirection)->paginate(5);
        return $Institution_keyClasses;
    }
    
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getTeacherClasses($id)
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','institution_subject_id','teacher_id','keyclass'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $Institution_keyClasses = InstitutionClass::when(request('search','') != '', function($query){
            $query->where('keyclass','LIKE','%'.request('search').'%');
        })->where('teacher_id',$id)->orderBy($sortField,$sortDirection)->paginate(5);
        return $Institution_keyClasses;
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getStudentClasses($id)
    {
       $StudentClass = StudentClass::where('institution_class_id',$id)->get();
       return $StudentClass;
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMyClassSubject($id)
    {
       $InstitutionClasses = InstitutionClass::find($id);
       $InstitutionSubject = InstitutionSubject::find($InstitutionClasses->institution_subject_id);
       $Subject = Subject::find($InstitutionSubject->subject_id);
       return $Subject;
    }

  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStudents()
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','First_Name','Last_Name','Mobile'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $column= request('column','First_Name');
        if(!in_array($column,['First_Name','Last_Name','Mobile'])){
            $column = 'First_Name';
        }
        $Students = Student::when(request('search','') != '', function($query){
            $query->where(request('column',''),'LIKE','%'.request('search').'%');
        })->orderBy($sortField,$sortDirection)->get();
        return  $Students;

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
