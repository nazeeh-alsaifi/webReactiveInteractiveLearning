<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\settings\Nationality;
use App\Models\users\Student;
use App\Models\users\Teacher;
use App\Models\users\Employee;
use App\Models\User;
use DB;

class NationalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Nationality::all();
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getpage()
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','Nationality_name'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $Nationalities = Nationality::when(request('search','') != '', function($query){
            $query->where('Nationality_name','LIKE','%'.request('search').'%');
        })->orderBy($sortField,$sortDirection)->paginate(5);
        return $Nationalities;
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
            'Nationality_name' => 'required'
     ]);
         $nationality = new Nationality;
         $nationality->Nationality_name = $request->input('Nationality_name');
         $nationality->save();
         return $nationality;
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
            'Nationality_name' => 'required'
     ]);
         $id = $request->input('id');
         $nationality = Nationality::find($id);
         $nationality->Nationality_name = $request->input('Nationality_name');
         $nationality->save();
         return $nationality;
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
        $users = User::get();
        $Students = Student::get();
        $Teachers = Teacher::get();
        $Employees = Employee::get();
        $nationality = Nationality::find($id);
        foreach($users as $user)
        {
            foreach($Students as $Student)
            {
                if(($user->id == $Student->user_id)&&($Student->nationality_id == $id))
                {
                    return redirect('/Institution')->with('error','Delete Related Data First');
                }
            }
            foreach($Teachers as $Teacher)
            {
                if(($user->id == $Teacher->user_id)&&($Teacher->nationality_id == $id))
                {
                    return redirect('/Institution')->with('error','Delete Related Data First');
                }
            }
            foreach($Employees as $Employee)
            {
                if(($user->id == $Employee->user_id)&&($Employee->nationality_id == $id))
                {
                    return redirect('/Institution')->with('error','Delete Related Data First');
                }
            }
        }
        $nationality->delete();
        return true;
    }
}
