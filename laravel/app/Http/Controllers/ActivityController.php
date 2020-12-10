<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivitySection;
use App\Models\EndQuestions;
use App\Models\AnswerQuestions;
use App\Models\MultiQuestions;
use App\Models\MultiQuestionsSettings;
use Illuminate\Support\Facades\Auth;

class ActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin',['only' => [ 'store','getUserId']]);
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
            "level_id" => 'required|string',
            "instructionalPurpose_id" => 'required|string',
            "locationCycle_id" => 'required|string',
            "active" => 'required',
            "free" => 'required',
            "sections" => 'required',
            "tags" => 'required',

        ]);
       
        if($request->hasFile('image')){
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            $path = $request->file('image')->storeAs('public/image',$fileNameToStore);
            //$image = $request->image->store('public/avatar');
        }
        // $sections = json_decode($validatedRequest["sections"]);

        $userId = auth()->user()->id;
        $activity=Activity::create([
            "title" => $validatedRequest["title"],
            "objectives" => $validatedRequest["objective"],
            "subsubject_id" => $validatedRequest["subSubject_id"],
            "is_free" => $validatedRequest["free"],
           "is_active" => $validatedRequest["active"],
           "user_id" => $userId,
            // "subSubject_id" => $validatedRequest["subSubject_id"],
            // "category_id" => $validatedRequest["category_id"],
            // "subCategory_id" => $validatedRequest["subCategory_id"],
            "level_id" => $validatedRequest["level_id"],
            "purpose_id" => $validatedRequest["instructionalPurpose_id"],
            "location_in_cycle_id" => $validatedRequest["locationCycle_id"],

        ]);
        if(isset($fileNameToStore)){
            $activity->image =$fileNameToStore;
            $activity->save();
        }
        // sections and components handling
        $sections = json_decode($validatedRequest["sections"]);
        /* $sections_objects=array();
        foreach($sections as $section){
            $section_obj = new ActivitySection();
            $section_obj->title = $section ->title;
            $section_obj->created_at = now();
            $section_obj->updated_at = now();
            $sections_objects[] = $section_obj;
        }
        $activity->sections()->saveMany($sections_objects); */

        // sections and components handling
        foreach($sections as $section){
            $section_saved = ActivitySection::create([
                "activity_id" => $activity->id,
                "title" => $section->title,
                "created_at" => now(),
                "updated_at" => now(),
            ]);
            $components_ids=array();
            foreach($section->components as $component_obj){
                $components_ids[] = $component_obj->name;
            }
            $section_saved->components()->attach($components_ids);
            //save section_component_ids in an array
            $end_sections_components_ids = array();
            $multi_sections_components_ids = array();
            foreach($section_saved->components as $component_obj){
                if($component_obj->id == 4)
                {
                    $end_sections_components_ids[]  = $component_obj->pivot->id;
                }
                if($component_obj->id == 5)
                {
                    $multi_sections_components_ids[]  = $component_obj->pivot->id;
                }
            }
            //
            $end_question_index = 0;
            $multi_question_index = 0;
            foreach($section->components as $component_obj){
                if($component_obj->name == 4)
                {
                    $EndQuestions = new EndQuestions();
                    $EndQuestions->sections_components_id = $end_sections_components_ids[$end_question_index];
                    $EndQuestions->text_description = $component_obj->data->text_description;
                    $EndQuestions->Question = $component_obj->data->Question;
                    $EndQuestions->img_src = $component_obj->data->img_src;
                    $EndQuestions->save();
                    $end_question_index ++;
                }
                if($component_obj->name == 5)
                {
                    if($request->hasFile('question_img_src')){
                        $filenameWithExt = $request->file('question_img_src')->getClientOriginalName();
                        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        $extension = $request->file('question_img_src')->getClientOriginalExtension();
                        $fileNameToStore= $filename.'_'.time().'.'.$extension;
                        $path = $request->file('question_img_src')->storeAs('public/image',$fileNameToStore);
                        //$image = $request->image->store('public/avatar');
                    }
                    $MultiQuestions = new MultiQuestions();
                    $MultiQuestions->sections_components_id = $multi_sections_components_ids[$multi_question_index];
                    $MultiQuestions->text_description = $component_obj->data->question_text_description;
                    $MultiQuestions->Question = $component_obj->data->question_Question;
                    $MultiQuestions->img_src = $fileNameToStore;
                    $MultiQuestions->save();
                    
                    $MultiQuestionsSettings = new MultiQuestionsSettings();
                    $MultiQuestionsSettings->multi_questions_id = $MultiQuestions->id;
                    $MultiQuestionsSettings->trays_count = $component_obj->data->Trays_Count;
                    $MultiQuestionsSettings->degree = $component_obj->data->Question_Degree;
                    $MultiQuestionsSettings->save();
                    foreach($component_obj->data->answers as $myanswer)
                    {
                        $AnswerQuestions = new AnswerQuestions();
                        $AnswerQuestions->multi_questions_id = $MultiQuestions->id;
                        $AnswerQuestions->Answer = $myanswer->answer;
                        $AnswerQuestions->img_src = $myanswer->answer_img_src;
                        $AnswerQuestions->is_true = $myanswer->answer_is_true;
                        $AnswerQuestions->save();
                    }                    
                    $multi_question_index ++;
                }
            }
        }

        // tags handling
        $tags = json_decode($validatedRequest["tags"]);
        foreach($tags as $tag){
            $activity->tags()->attach($tag->value);
        }
        

        
        return response()->json(array('success' => true));
    }
}
