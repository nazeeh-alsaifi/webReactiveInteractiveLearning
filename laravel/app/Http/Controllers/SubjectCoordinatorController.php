<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

class SubjectCoordinatorController extends Controller
{
      /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('subjectcoordinator');
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
    public function myInstitutionClasses()
    {
        $you = auth()->user();
        $SubjectCoordinator = SubjectCoordinator::where('user_id',$you->id)->first();
        $InstitutionSubject = InstitutionSubject::find($SubjectCoordinator->institution_subject_id);
        $InstitutionClasses = InstitutionClass::where('institution_subject_id',$InstitutionSubject->id)->get();
        return $InstitutionClasses;
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getSubjects()
    {
        return Subject::all();
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
    public function getAllInstitutionSubject()
    {
        return InstitutionSubject::all();
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
