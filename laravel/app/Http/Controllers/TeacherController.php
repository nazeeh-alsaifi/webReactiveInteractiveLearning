<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\settings\Nationality;
use App\Models\institutions\Institution;
use App\Models\Institutions\InstitutionSubject;
use App\Models\Institutions\InstitutionClass;
use App\Models\Institutions\StudentClass;
use App\Models\settings\Subject;
use App\Models\users\Teacher;
use App\Models\users\Student;
use App\Models\users\SubjectCoordinator;
use App\Models\User;
use App\Models\Activity;

class TeacherController extends Controller
{
         /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('teacher');
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
    public function getMyTeacher()
    {
        $you = auth()->user();
        $Teacher = Teacher::where('user_id',$you->id)->first();
        return $Teacher;
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
    public function getTeacherClasses()
    {
        $you = auth()->user();
        $Teacher = Teacher::where('user_id',$you->id)->first();
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
        })->where('teacher_id',$Teacher->id)->orderBy($sortField,$sortDirection)->paginate(5);
        return $Institution_keyClasses;
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
    public function getTeachers()
    {
        return Teacher::all();
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
    public function getAvailableActivities($id)
    {
       $myClass = InstitutionClass::find($id);
       $myInstitutionSubject = InstitutionSubject::find($myClass->institution_subject_id);
       $Activities = Activity::where('subject_id',$myInstitutionSubject->subject_id)->get();
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
       $Activities = InstitutionClass::find($id)->activities()->paginate(5);
     //    $items = DB::table('activities')
     //    ->join('activities_institution_calsses', 'activities.id', 'activities_institution_calsses.institution_class_id')
     //    ->where('activities.id','0')->where('Item__langs.lang_id','6')
     //    ->pluck('Item__langs.title', 'Item__langs.item_id');
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
