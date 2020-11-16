<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\settings\Nationality;
use App\Models\users\Student;
use App\Models\User;

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
