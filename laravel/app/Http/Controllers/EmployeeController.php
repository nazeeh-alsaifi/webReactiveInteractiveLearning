<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\users\Employee;
use App\Models\User;
use DB;

class EmployeeController extends Controller
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
        $employees = Employee::all();
        return $employees;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function myusers()
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
    public function getpage()
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','First_Name','Last_Name','Mobile','Address','Address1'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $column= request('column','First_Name');
        if(!in_array($column,['First_Name','Last_Name','Mobile','Address','Address1'])){
            $column = 'First_Name';
        }
        $employees = Employee::when(request('search','') != '', function($query){
            $query->where(request('column',''),'LIKE','%'.request('search').'%');
        })->orderBy($sortField,$sortDirection)->paginate(5);
        return $employees;
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
        $user = new User;
        $user->name =$request->input('First_Name').' '.$request->input('Last_Name');
        $user->password = Hash::make($request->input('password'));
        $user->email = $request->input('Email');
        $user->assignRole($request->input('Role'));
        $user->menuroles = $request->input('Role');
        $user->status = 'Active';
        $user->save();

       $employee = new Employee;
       $employee->user_id = $user->id; 
       $employee->First_Name = $request->input('First_Name');
       $employee->Last_Name = $request->input('Last_Name');
       $employee->Mobile = $request->input('Mobile');
       $employee->Gender = $request->input('Gender');
       $employee->country_id = $request->input('country_id');
       $employee->city_id = $request->input('city_id');
       $employee->birth_date = $request->input('birth_date');
       $employee->jop_date = $request->input('jop_date');
       $employee->Address = $request->input('Address');
       $employee->Address1 = $request->input('Address1');
       $employee->save();
       return $employee;
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
            //'password'=> 'required'
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

       //storeemployeeprofile
       public function storeemployeeprofile(Request $request)
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
                //$image = $request->image->store('public/avatar');
            }
           //$path = $request->file('image')->store('images','public');
           $id = $request->input('id');
           $employee = Employee::find($id);
           $user = User::find($employee->user_id);
           $user->name = $request->input('First_Name').' '.$request->input('Last_Name');
           if($request->hasFile('image'))
           {
             $user->image = $fileNameToStore;
           }
           $user->save();
           $employee->First_Name = $request->input('First_Name');
           $employee->Last_Name = $request->input('Last_Name');
           $employee->Mobile = $request->input('Mobile');
           $employee->Gender = $request->input('Gender');
           $employee->birth_date = $request->input('birth_date');
           $employee->nationality_id = $request->input('nationality_id');       
           $employee->save();
           return $employee;
       }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store1(Request $request)
    {
          $id = $request->input('id');
          $employee = Employee::find($id);
          $employee->First_Name = $request->input('First_Name');
          $employee->Last_Name = $request->input('Last_Name');
          $employee->Mobile = $request->input('Mobile');
          $employee->Gender = $request->input('Gender');
          $employee->country_id = $request->input('country_id');
          $employee->city_id = $request->input('city_id');
          $employee->birth_date = $request->input('birth_date');
          $employee->jop_date = $request->input('jop_date');
          $employee->Address = $request->input('Address');
          $employee->Address1 = $request->input('Address1');
          $employee->save();
          //
          $user = User::find($employee->user_id);
          $user->name =$request->input('First_Name').' '.$request->input('Last_Name');
          $user->syncRoles($request->input('Role'));
          $user->save();
          return true;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->input('id');
        $employee = Employee::find($id);
        $employee->delete();        
        $user = User::find($employee->user_id);
        $user->delete();
        return true;

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
        $employee = Employee::find($id);
        $employee->delete();        
        $user = User::find($employee->user_id);
        $user->delete();
        return true;
    }
}
