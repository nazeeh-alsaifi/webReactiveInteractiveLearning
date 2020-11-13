<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\settings\Unit;
use App\Models\settings\UnitMeasure;
use DB;

class UnitsMeasureController extends Controller
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
        return UnitMeasure::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getpage()
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','unit_id','Unit_measure','Measure_sample'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $Units_measures = UnitMeasure::when(request('search','') != '', function($query){
            $query->where('Unit_measure','LIKE','%'.request('search').'%');
        })->orderBy($sortField,$sortDirection)->paginate(5);
        return $Units_measures;
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
            'Unit_id' => 'required',
            'Unit_measure' => 'required',
            'Measure_sample' => 'required'
     ]);
         $unit_measure = new UnitMeasure;
         $unit_measure->unit_id = $request->input('Unit_id');
         $unit_measure->Unit_measure = $request->input('Unit_measure');
         $unit_measure->Measure_sample = $request->input('Measure_sample');
         $unit_measure->save();
         return $unit_measure;
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
            'unit_id' => 'required',
            'Unit_measure' => 'required',
            'Measure_sample' => 'required'
     ]);
         $id = $request->input('id');
         $unit_measure = UnitMeasure::find($id);
         $unit_measure->unit_id = $request->input('unit_id');
         $unit_measure->Unit_measure = $request->input('Unit_measure');
         $unit_measure->Measure_sample = $request->input('Measure_sample');
         $unit_measure->save();
         return $unit_measure;
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
        $Unit_measure = UnitMeasure::find($id);
        $Unit_measure->delete();
        return true;
    }
}
