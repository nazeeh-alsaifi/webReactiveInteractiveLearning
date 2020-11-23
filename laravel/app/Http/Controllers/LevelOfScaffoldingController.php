<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\settings\LevelOfScaffolding;


class LevelOfScaffoldingController extends Controller
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
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getpage()
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','Level_Name'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $LevelsOfScaffolding = LevelOfScaffolding::when(request('search','') != '', function($query){
            $query->where('Level_Name','LIKE','%'.request('search').'%');
        })->orderBy($sortField,$sortDirection)->paginate(5);
        return $LevelsOfScaffolding;
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
            'Level_Name' => 'required'
     ]);
         $LevelOfScaffolding = new LevelOfScaffolding;
         $LevelOfScaffolding->Level_Name = $request->input('Level_Name');
         $LevelOfScaffolding->save();
         return $LevelOfScaffolding;
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
            'Level_Name' => 'required'
     ]);
         $id = $request->input('id');
         $LevelOfScaffolding = LevelOfScaffolding::find($id);
         $LevelOfScaffolding->Level_Name = $request->input('Level_Name');
         $LevelOfScaffolding->save();
         return $LevelOfScaffolding;
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
        $LevelOfScaffolding = LevelOfScaffolding::find($id);
        $LevelOfScaffolding->delete();
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
