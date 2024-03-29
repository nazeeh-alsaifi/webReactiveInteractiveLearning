<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\settings\MeasureTool;

class MeasureToolsController extends Controller
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
        return MeasureTool::all();
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getpage()
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','measureTool_name','Description','src_link'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $column= request('column','measureTool_name');
        if(!in_array($column,['measureTool_name','Description','src_link'])){
            $column = 'measureTool_name';
        }
        $MeasureTools = MeasureTool::when(request('search','') != '', function($query){
            $query->where(request('column',''),'LIKE','%'.request('search').'%');
        })->orderBy($sortField,$sortDirection)->paginate(5);
        return $MeasureTools;
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
            'measureTools_name' => 'required',
            'Description' => 'required',
            'src_link' => 'required',
     ]);
         $MeasureTool = new MeasureTool;
         $MeasureTool->measureTool_name = $request->input('measureTools_name');
         $MeasureTool->Description = $request->input('Description');
         $MeasureTool->src_link = $request->input('src_link');
         $MeasureTool->save();
         return $MeasureTool;
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
            'measureTool_name' => 'required',
            'Description' => 'required',
            'src_link' => 'required',
     ]);
         $id = $request->input('id');
         $MeasureTool = MeasureTool::find($id);
         $MeasureTool->Description = $request->input('Description');
         $MeasureTool->src_link = $request->input('src_link');
         $MeasureTool->save();
         return $MeasureTool;
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
        $MeasureTool = MeasureTool::find($id);
        $MeasureTool->delete();
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

    }
}
