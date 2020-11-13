<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\settings\Subject;
use App\Models\settings\SubSubject;

class SubSubjectController extends Controller
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
        return SubSubject::all();
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getpage()
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','subject_id','sub_subject_name'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $sub_subjects = SubSubject::when(request('search','') != '', function($query){
            $query->where('sub_subject_name','LIKE','%'.request('search').'%');
        })->orderBy($sortField,$sortDirection)->paginate(5);
        return $sub_subjects;
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
            'Id_subject' => 'required',
             'sub_subject_name' => 'required'
      ]);
          $sub_subject = new SubSubject;
          $sub_subject->subject_id = $request->input('Id_subject');
          $sub_subject->sub_subject_name = $request->input('sub_subject_name');
          $sub_subject->save();
          return $sub_subject;
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
            'subject_id' => 'required',
             'sub_subject_name' => 'required'
      ]);
          $id = $request->input('id');
          $sub_subject = SubSubject::find($id);
          $sub_subject->subject_id = $request->input('subject_id');
          $sub_subject->sub_subject_name = $request->input('sub_subject_name');
          $sub_subject->save();
          return $sub_subject;
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
        $sub_subject = SubSubject::find($id);
        $sub_subject->delete();
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
        $sub_subject = SubSubject::find($id);
        $sub_subject->delete();
        return true;
    }
}
