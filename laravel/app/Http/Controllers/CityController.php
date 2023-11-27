<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\settings\City;
use App\Models\settings\Country;
use App\Models\institutions\Institution;
use DB;
class CityController extends Controller
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
        return City::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getpage()
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','country_id','city_name'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $Cities = City::when(request('search','') != '', function($query){
            $query->where('city_name','LIKE','%'.request('search').'%');
        })->orderBy($sortField,$sortDirection)->paginate(5);
        return $Cities;
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
            'Country_id' => 'required',
             'city_name' => 'required'
      ]);
          $city = new City;
          $city->country_id = $request->input('Country_id');
          $city->city_name = $request->input('city_name');
          $city->save();
          return $city;
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
            'country_id' => 'required',
             'city_name' => 'required'
      ]);
          $id = $request->input('id');
          $city = City::find($id);
          $city->country_id = $request->input('country_id');
          $city->city_name = $request->input('city_name');
          $city->save();
          return $city;
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
        $Institutions = Institution::get();
        $city = City::find($id);
        foreach($Institutions as $Institution)
        {
            if($Institution->city_id == $id)
            {
                return redirect('/Institution')->with('error','Delete Related Data First');
            }
        }
        $city->delete();
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
        $Institutions = Institution::get();
        $city = City::find($id);
        foreach($Institutions as $Institution)
        {
            if($Institution->city_id == $id)
            {
                return redirect('/Institution')->with('error','Delete Related Data First');
            }
        }
        $city->delete();
        return false;
    }
}
