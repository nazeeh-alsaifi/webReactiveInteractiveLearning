<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\institutions\Institution;
use App\Models\Institutions\InstitutionSubject;
use App\Models\durations\DurationCourseInstitution;
use App\Models\durations\DurationCourse;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
use App\Models\institutions\StudentClass;
use App\Models\institutions\InstitutionClass;
use App\Models\User;
use Carbon\Carbon;
use Keygen\Keygen;
use DB;
use App\Models\settings\City;
use App\Models\settings\Country;
use App\Models\settings\Subject;
use App\Models\settings\AcademicLevel;
use App\Models\users\Teacher;
use App\users\SubjectCoordinator;
use App\Models\Users\ActivationCodes;

class InstitiutionController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Institution::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getpage()
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','Institu_name','academicLevels_id','country_id','city_id','Mobile','Email','Address','Address1'])){
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
        $Institutions = Institution::when(request('search','') != '', function($query){
            $query->where(request('column',''),'LIKE','%'.request('search').'%');
        })->orderBy($sortField,$sortDirection)->paginate(5);
        return $Institutions;
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
             'Instititution_Name' => 'required',
             'Institution_Type' => 'required',
             'Country' => 'required',
             'City' => 'required',
             'Mobile' => 'required',
             'Email' => 'required',
             'Address1' => 'required',
             'Address2' => 'required',
             'First_name' => 'required',
             'Last_Name' => 'required',
             'Coordinator_password' => 'required',
             'Coordinator_email' => 'required',
      ]); 
          $user = new User;
          $user->name = $request->input('First_name').' '.$request->input('Last_Name');;
          $user->password = Hash::make($request->input('Coordinator_password'));
          $user->email = $request->input('Coordinator_email');;
          $user->assignRole('coordinator');
          $user->menuroles = 'coordinator';
          $user->status = 'Active';
          $user->save();
        //coordinator
           $Teacher = new Teacher;
           $Teacher->user_id = $user->id;
           $Teacher->First_name =  $request->input('First_name');
           $Teacher->Last_Name =  $request->input('Last_Name');
           $Teacher->Mobile =  $request->input('Mobile');
           $Teacher->Is_Coordinator = 1;
           $Teacher->save();
         //
         $Institution = new Institution;
         $Institution->Institu_name = $request->input('Instititution_Name');
         $Institution->academicLevels_id = $request->input('Institution_Type');
         $Institution->country_id = $request->input('Country');
         $Institution->city_id = $request->input('City');
         $Institution->coordinator_id = $user->id;
         $Institution->Mobile = $request->input('Mobile');
         $Institution->Email = $request->input('Email');
         $Institution->Address = $request->input('Address1');
         $Institution->Address1 = $request->input('Address2');
         $Institution->save();
         return $user;
    }

   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store1(Request $request)
    {
        $this->validate($request, [
            'Institu_name' => 'required',
            'academicLevels_id' => 'required',
            'country_id' => 'required',
            'city_id' => 'required',
            'Mobile' => 'required',
            'Email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'Address' => 'required',
            'Address1' => 'required'
     ]);
         $id = $request->input('id');
         $Institution = Institution::find($id);
         $Institution->Institu_name = $request->input('Institu_name');
         $Institution->academicLevels_id = $request->input('academicLevels_id');
         $Institution->country_id = $request->input('country_id');
         $Institution->city_id = $request->input('city_id');
         $Institution->Mobile = $request->input('Mobile');
         $Institution->Email = $request->input('Email');
         $Institution->Address = $request->input('Address');
         $Institution->Address1 = $request->input('Address1');
         $Institution->save();
         return $Institution;
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
        $Institution = Institution::find($id);
        $user = User::find($Institution->coordinator_id);
        if(($user->status != 'Active'))
        {
             $Institution->delete();
             $user->delete();
             return Institution::all();
        }
         return redirect('/Institution')->with('error','Delete Related Data First');
    }
}
