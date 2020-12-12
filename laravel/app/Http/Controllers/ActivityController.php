<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Models\ActivitySection;
use App\Models\EndQuestions;
use App\Models\AnswerQuestions;
use App\Models\MultiQuestions;
use App\Models\MultiQuestionsSettings;
use App\Models\VideoOptions;

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
        $index = 0;
        foreach($sections as $section){
            $section_saved = ActivitySection::create([
                "activity_id" => $activity->id,
                "title" => $section->title,
                "created_at" => now(),
                "updated_at" => now(),
            ]);

            $innerindex=0;
            foreach($section->components as $component_obj){
                if($component_obj->name ==1){
                    // video upload
                    if($request->hasFile('video'. $index . $innerindex)){
                        $filenameWithExt = $request->file('video'. $index . $innerindex)->getClientOriginalName();
                        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        $extension = $request->file('video'. $index . $innerindex)->getClientOriginalExtension();
                        $fileNameToStore= $filename.'_'.time().'.'.$extension;
                        $path = $request->file('video'. $index . $innerindex)->storeAs('public/video',$fileNameToStore);
                    }
                    // video tools handling
                    $toolsNames=array();
                    foreach($component_obj->data->tools as $tool_obj){
                        $toolsNames[]=$tool_obj->toolName;
                    };

                    $json_options = [
                        "video_src" => "/storage/video/" . $fileNameToStore,
                        "fps" => $component_obj->data->fps,
                        "tools" => $toolsNames,
                    ];

                    $section_saved->components()->attach($component_obj->name,[
                        "options" => json_encode($json_options),
                    ]);

                }
                else{
                    $section_saved->components()->attach($component_obj->name);
                }
                $innerindex++;
            }

            // $section_saved->components()->attach($components_ids);
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
            $innerindex=0;
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
                    if($request->hasFile('qimage' . $index . $innerindex)){
                        $filenameWithExt = $request->file('qimage' . $index . $innerindex)->getClientOriginalName();
                        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                        $extension = $request->file('qimage' . $index . $innerindex)->getClientOriginalExtension();
                        $multiQuestionfileNameToStore= $filename.'_'.time().'.'.$extension;
                        $path = $request->file('qimage' . $index . $innerindex)->storeAs('public/image',$multiQuestionfileNameToStore);
                    }
                    $MultiQuestions = new MultiQuestions();
                    $MultiQuestions->sections_components_id = $multi_sections_components_ids[$multi_question_index];
                    $MultiQuestions->text_description = $component_obj->data->question_text_description;
                    $MultiQuestions->Question = $component_obj->data->question_Question;
                    if($request->hasFile('qimage' . $index . $innerindex))
                    {
                        $MultiQuestions->img_src = $multiQuestionfileNameToStore;
                    }
                    $MultiQuestions->save();                    
                    $MultiQuestionsSettings = new MultiQuestionsSettings();
                    $MultiQuestionsSettings->multi_questions_id = $MultiQuestions->id;
                    $MultiQuestionsSettings->trays_count = $component_obj->data->Trays_Count;
                    $MultiQuestionsSettings->degree = $component_obj->data->Question_Degree;
                    $MultiQuestionsSettings->save();
                    $AnswerIndex = 0;
                    foreach($component_obj->data->answers as $myanswer)
                    {
                        if($request->hasFile('answerimage' . $index . $innerindex . $AnswerIndex)){
                            $filenameWithExt = $request->file('answerimage' . $index . $innerindex . $AnswerIndex)->getClientOriginalName();
                            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                            $extension = $request->file('answerimage' . $index . $innerindex . $AnswerIndex)->getClientOriginalExtension();
                            $AnswerfileNameToStore= $filename.'_'.time().'.'.$extension;
                            $path = $request->file('answerimage' . $index . $innerindex . $AnswerIndex)->storeAs('public/image',$AnswerfileNameToStore);
                        }
                        $AnswerQuestions = new AnswerQuestions();
                        $AnswerQuestions->multi_questions_id = $MultiQuestions->id;
                        $AnswerQuestions->Answer = $myanswer->answer;
                        if($request->hasFile('answerimage' . $index . $innerindex . $AnswerIndex))
                        {
                            $AnswerQuestions->img_src = $AnswerfileNameToStore;
                        }
                        $AnswerQuestions->is_true = $myanswer->answer_is_true;
                        $AnswerQuestions->save();
                        $AnswerIndex++;
                    }                    
                    $multi_question_index ++;
                }
                $innerindex++;
            }
            $index++;
        }

        // tags handling
        $tags = json_decode($validatedRequest["tags"]);
        foreach($tags as $tag){
            $activity->tags()->attach($tag->value);
        }
        

        
        return response()->json(array('success' => true , 'video' => $sections));
    }
}
