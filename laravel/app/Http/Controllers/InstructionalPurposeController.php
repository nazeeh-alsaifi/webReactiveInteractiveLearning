<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\settings\InstructionalPurpose;

class InstructionalPurposeController extends Controller
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
        return InstructionalPurpose::all();
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getpage()
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','Instructional_Purpose'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $Instructional_Purposes = InstructionalPurpose::when(request('search','') != '', function($query){
            $query->where('Instructional_Purpose','LIKE','%'.request('search').'%');
        })->orderBy($sortField,$sortDirection)->paginate(5);
        return $Instructional_Purposes;
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
            'Instructional_Purpose' => 'required'
     ]);
         $Instructional_Purpose = new InstructionalPurpose;
         $Instructional_Purpose->Instructional_Purpose = $request->input('Instructional_Purpose');
         $Instructional_Purpose->save();
         return $Instructional_Purpose;
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
            'Instructional_Purpose' => 'required'
     ]);
         $id = $request->input('id');
         $Instructional_Purpose = InstructionalPurpose::find($id);
         $Instructional_Purpose->Instructional_Purpose = $request->input('Instructional_Purpose');
         $Instructional_Purpose->save();
         return $Instructional_Purpose;
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
        $Instructional_Purpose = InstructionalPurpose::find($id);
        $Instructional_Purpose->delete();
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
        //
    }
}
