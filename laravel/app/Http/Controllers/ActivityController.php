<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivitySection;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin',['only' => [ 'store']]);
    }
    //
    public function store(Request $request){
        // return $request;
        $validatedRequest = $request->validate([
            "title" => 'required|string',
            "objective" => 'required|string',
            "image" => 'required|image',
            "subject_id" => 'required',
            "subSubject_id" => 'required',
            "category_id" => 'required',
            "subCategory_id" => 'required',
            "level" => 'required|string',
            "sections" => 'required',
        ]);
       
        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/image',$fileNameToStore);
            //$image = $request->image->store('public/avatar');
        }

        $sections = json_decode($validatedRequest["sections"]);
        $activity=Activity::create([
            "title" => $validatedRequest["title"],
            "objectives" => $validatedRequest["objective"],
            "subject_id" => $validatedRequest["subject_id"],
           "is_free" => 0,
           "is_active" => 0,
            // "subSubject_id" => $validatedRequest["subSubject_id"],
            // "category_id" => $validatedRequest["category_id"],
            // "subCategory_id" => $validatedRequest["subCategory_id"],
            // "level" => $validatedRequest["level"],
        ]);
        if(isset($fileNameToStore)){
            $activity->image =$fileNameToStore;
            $activity->save();
        }
        
        $sections_objects=array();
        foreach($sections as $section){
            $section_obj = new ActivitySection();
            $section_obj->title = $section ->title;
            $section_obj->created_at = now();
            $section_obj->updated_at = now();
            $sections_objects[] = $section_obj;
        }
        

        $activity->sections()->saveMany($sections_objects);
        
        return response()->json(array('success' => true));
    }
}
