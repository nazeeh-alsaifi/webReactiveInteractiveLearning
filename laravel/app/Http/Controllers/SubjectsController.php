<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\settings\Subject;
use App\Models\institutions\InstitutionSubject;
use App\Models\settings\Category;
use App\Models\settings\SubSubject;
use DB;

class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Subject::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getpage()
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','Subject_name'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $Subjects = Subject::when(request('search','') != '', function($query){
            $query->where('Subject_name','LIKE','%'.request('search').'%');
        })->orderBy($sortField,$sortDirection)->paginate(5);
        return $Subjects;
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
            'Subject_name' => 'required'
     ]);
         $Subject = new Subject;
         $Subject->Subject_name = $request->input('Subject_name');
         $Subject->save();
         return $Subject;
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
            'Subject_name' => 'required'
     ]);
         $id = $request->input('id');
         $Subject = Subject::find($id);
         $Subject->Subject_name = $request->input('Subject_name');
         $Subject->save();
         return $Subject;
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
        $Institution_Subjects = InstitutionSubject::get();
        $Categories = Category::get();
        $sub_subjects = SubSubject::get();
        $Subject = Subject::find($id);
        foreach($Institution_Subjects as $Institution_Subject)
        {
            if($Institution_Subject->subject_id == $id)
            {
                return redirect('/Institution')->with('error','Delete Related Data First');
            }
        }
        foreach($Categories as $Category)
        {
            if($Category->subject_id == $id)
            {
                return redirect('/Institution')->with('error','Delete Related Data First');
            }
        }
        foreach($sub_subjects as $sub_subject)
        {
            if($sub_subject->subject_id == $id)
            {
                return redirect('/Institution')->with('error','Delete Related Data First');
            }
        }

        $Subject->delete();
        return true;
    }
}
