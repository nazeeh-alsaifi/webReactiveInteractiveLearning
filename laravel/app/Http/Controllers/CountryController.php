<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\settings\Country;
use App\Models\settings\City;
use App\Models\institutions\Institution;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Country::all();
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getpage()
    {
        $sortField = request('sort_field','id');
        if(!in_array($sortField,['id','country_name'])){
            $sortField = 'id';
        }
        $sortDirection = request('sort_direction','desc');
        if(!in_array($sortDirection,['asc','dec'])){
            $sortDirection = 'desc';
        }
        $countries = Country::when(request('search','') != '', function($query){
            $query->where('country_name','LIKE','%'.request('search').'%');
        })->orderBy($sortField,$sortDirection)->paginate(5);
        return $countries;
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
            'country_name' => 'required'
     ]);
         $country = new Country;
         $country->country_name = $request->input('country_name');
         $country->save();
         return $country;
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
            'country_name' => 'required'
     ]);
         $id = $request->input('id');
         $country = Country::find($id);
         $country->country_name = $request->input('country_name');
         $country->save();
         return $country;
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cities = City::get();
        $Institutions = Institution::get();
        $country = Country::find($id);
        foreach($cities as $city)
        {
            if($city->country_id == $id)
            {
                return redirect('/Institution')->with('error','Delete Related Data First');
            }
        }
        foreach($Institutions as $Institution)
        {
            if($Institution->country_id == $id)
            {
                return redirect('/Institution')->with('error','Delete Related Data First');
            }
        }
        $country->delete();
        return true;
    }
}
