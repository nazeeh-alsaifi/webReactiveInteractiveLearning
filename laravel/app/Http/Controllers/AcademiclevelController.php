<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\settings\AcademicLevel;
use App\Models\institutions\Institution;

class AcademiclevelController extends Controller
{
    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('auth:api');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$academicLevels = AcademicLevel::all();
        return AcademicLevel::all();
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getpage()
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','AcademicLevel'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $AcademicLevels = AcademicLevel::when(request('search','') != '', function($query){
            $query->where('AcademicLevel','LIKE','%'.request('search').'%');
        })->orderBy($sortField,$sortDirection)->paginate(5);
        return $AcademicLevels;
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
            'AcademicLevel' => 'required'
        ]);
         $AcademicLevel = new AcademicLevel;
         $AcademicLevel->AcademicLevel = $request->input('AcademicLevel');
         $AcademicLevel->save();
         return $AcademicLevel;
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
            'AcademicLevel' => 'required'
        ]);
         $id = $request->input('id');
         $AcademicLevel = AcademicLevel::find($id);
         $AcademicLevel->AcademicLevel = $request->input('AcademicLevel');
         $AcademicLevel->save();
         return $AcademicLevel;
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
        $Institutions = Institution::get();
        $AcademicLevel = AcademicLevel::find($id);
         foreach($Institutions as $Institution)
         {
             if($Institution->academicLevels_id == $id)
             {
                 return redirect('/Institution')->with('error','Delete Related Data First');
             }
         }
        $AcademicLevel->delete();
        return true;
    }
}
