<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\settings\Nationality;
use App\Models\users\Student;
use App\Models\User;
use App\Models\settings\Subject;
use App\Models\settings\SubSubject;
use App\Models\settings\LevelOfScaffolding;
use App\Models\settings\LocationInstructionalCycle;
use App\Models\settings\InstructionalPurpose;
use App\Models\institutions\Institution;
use App\Models\Institutions\InstitutionSubject;
use App\Models\Institutions\InstitutionClass;
use App\Models\Institutions\StudentClass;
use App\Models\users\Teacher;
use App\Models\users\SubjectCoordinator;
use App\Models\Activity;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('student');
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
    public function getStudent()
    {
        return Student::all();
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
    public function getSubjects()
    {
        return Subject::all();
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStudentClasses()
    {
        $you = auth()->user();
        $Student = Student::where('user_id',$you->id)->first();
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','institution_subject_id','teacher_id','keyclass'])){
             $sortField = 'id';
         }
         $sortDirection = request('sort_direction','desc');
         if(!in_array($sortDirection,['asc','dec'])){
             $sortDirection = 'desc';
         }
        //get classes that belong to our student
        $Institution_keyClasses = DB::table('institution_classes')
         ->join('student_classes', 'student_classes.institution_class_id', 'institution_classes.id')
         ->join('students', 'student_classes.student_id', 'students.id')
         ->where('students.id',$Student->id)
         ->select('institution_classes.id as id','institution_classes.teacher_id as teacher_id',
        'institution_classes.keyclass as keyclass','institution_classes.institution_subject_id as institution_subject_id')
        ->when(request('search','') != '', function($query){
            $query->where('keyclass','LIKE','%'.request('search').'%');
        })->orderBy($sortField,$sortDirection)->paginate(5);
        return response()->json( compact('Institution_keyClasses', 'Student') );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getInstitutionSubject()
    {
        return InstitutionSubject::all();
    }

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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMyActivity($id)
    {
       $Activity = Activity::find($id);
       return $Activity;
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
    public function storestudentprofile(Request $request)
    {
        $this->validate($request, [
            'First_Name'=> 'required',
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
        $Students = Student::find($id);
        $user = User::find($Students->user_id);
        $user->name = $request->input('First_Name').' '.$request->input('Last_Name');
        if($request->hasFile('image'))
        {
          $user->image = $fileNameToStore;
        }
        $user->save();
        $Students->First_Name = $request->input('First_Name');
        $Students->Last_Name = $request->input('Last_Name');
        $Students->Mobile = $request->input('Mobile');
        $Students->Gender = $request->input('Gender');
        $Students->birth_date = $request->input('birth_date');
        $Students->nationality_id = $request->input('nationality_id');
        $Students->save();
        return $Students;
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
