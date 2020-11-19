<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\settings\Nationality;
use App\Models\users\Teacher;
use App\Models\User;

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
    public function getTeachers()
    {
        return Teacher::all();
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
