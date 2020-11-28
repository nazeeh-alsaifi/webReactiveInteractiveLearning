<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin',['only' => [ 'store']]);
    }
    //
    public function store(Request $request){
        return $request;
    }
}
