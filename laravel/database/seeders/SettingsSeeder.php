<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\settings\AcademicLevel;
use App\Models\settings\Country;
use App\Models\settings\City;
use App\Models\settings\Subject;
use App\Models\settings\Nationality;
use App\Models\settings\Category;
use App\Models\settings\SubCategory;
use App\Models\settings\Component;
use App\Models\settings\LevelOfScaffolding;
use App\Models\settings\InstructionalPurpose;
use App\Models\settings\LocationInstructionalCycle;
use App\Models\settings\MeasureTool;
use App\Models\settings\Unit;


use App\Models\User;
use App\Models\Tag;
use App\Models\Activity;
use App\Models\ActivitySection;


use App\Models\durations\DurationCourse;


class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Acadimic levels
        AcademicLevel::create([
            // "id"=>1,
            "AcademicLevel" => "University",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        

       
       
       

        
        // Nationalities
        Nationality::create([
            "Nationality_name" => "default",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       
        Nationality::create([
            "Nationality_name" => "Syrian",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Subject
       
        $subject = Subject::find(1);

        // Categories
        $cat1 =Category::create([
            "subject_id" => $subject->id,
            "Cat_name" => "Category 1 of subject " . $subject->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $cat2 =Category::create([
            "subject_id" => $subject->id,
            "Cat_name" => "Category 2 of subject " . $subject->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
      
        // Sub Categories
        SubCategory::create([
            "category_id" => $cat1->id,
            "sub_cat_name" => "SubCategory 1 of catergory " . $cat1->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        SubCategory::create([
            "category_id" => $cat1->id,
            "sub_cat_name" => "SubCategory 2 of category " . $cat1->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        SubCategory::create([
            "category_id" => $cat2->id,
            "sub_cat_name" => "SubCategory 2 of category " . $cat2->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        SubCategory::create([
            "category_id" => $cat2->id,
            "sub_cat_name" => "SubCategory 2 of category " . $cat2->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $subject2 = Subject::find(2);

        // Categories
        $cat3 =Category::create([
            "subject_id" => $subject2->id,
            "Cat_name" => "Category 1 of subject " . $subject2->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $cat4 =Category::create([
            "subject_id" => $subject2->id,
            "Cat_name" => "Category 2 of subject " . $subject2->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
      
        // Sub Categories
        SubCategory::create([
            "category_id" => $cat3->id,
            "sub_cat_name" => "SubCategory 1 of catergory " . $cat3->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        SubCategory::create([
            "category_id" => $cat3->id,
            "sub_cat_name" => "SubCategory 2 of category " . $cat3->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        SubCategory::create([
            "category_id" => $cat4->id,
            "sub_cat_name" => "SubCategory 2 of category " . $cat4->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        SubCategory::create([
            "category_id" => $cat4->id,
            "sub_cat_name" => "SubCategory 2 of category " . $cat4->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        /**=======  Duration Seeding ================= */
        DurationCourse::create([
            "Duration" => "Semester",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DurationCourse::create([
            "Duration" => "Academic year",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DurationCourse::create([
            "Duration" => "Free_trial_Institution",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DurationCourse::create([
            "Duration" => "Free_student",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /* ======== 


        /* ========== LevelOfScaffolding ==========*/
       $level = LevelOfScaffolding::create([
            "Level_Name" => "Very High (intro to using Pivot)",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        LevelOfScaffolding::create([
            "Level_Name" => "High (step by step)",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        LevelOfScaffolding::create([
            "Level_Name" => "Medium (guided)",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        LevelOfScaffolding::create([
            "Level_Name" => "Low (open-ended)",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        LevelOfScaffolding::create([
            "Level_Name" => "Goal Less",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        /* ================ LocationInstructionalCycle ==========*/

        $location = LocationInstructionalCycle::create([
            "Location_Instructional_Cycle" => "Early (Introduction to concept)",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $location = LocationInstructionalCycle::create([
            "Location_Instructional_Cycle" => "Middle (Application)",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $location = LocationInstructionalCycle::create([
            "Location_Instructional_Cycle" => "End (Assessment)",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        /* ============== InstructionalPurpose ===========*/
        $purpose = InstructionalPurpose::create([
            'Instructional_Purpose' => "Instructor Video Upload",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $purpose = InstructionalPurpose::create([
            'Instructional_Purpose' => "Create An Argument From Evidence",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $purpose = InstructionalPurpose::create([
            'Instructional_Purpose' => "Modeling Instructor",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $purpose = InstructionalPurpose::create([
            'Instructional_Purpose' => "ISEL",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $purpose = InstructionalPurpose::create([
            'Instructional_Purpose' => "Lab Skills",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        //============Tag
        Tag::create([
            "keyword" => "velocity",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Tag::create([
            "keyword" => "mass",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Tag::create([
            "keyword" => "projectile",
            'created_at' => now(),
            'updated_at' => now(),
        ]);



        //-------- section component seeder to test the relationships
        // level_of_scaffoldings
        
        $activity =Activity::create([
            "title" => "this is the title of the first activity",
            "objectives" => "this is the objective of the first",
            "subsubject_id" => $subject->subsubjects[0]->id,
            "user_id" => 1, // admin
            "level_id" => $level->id,
            "location_in_cycle_id" => $location->id,
            "purpose_id" => $purpose->id,
            "is_free" => 1,
            "is_active" => 1,
        ]);
        for($noa=2; $noa<=10; $noa++){
            Activity::create([
                "title" => "this is the title of the num". $noa ."activity",
                "objectives" => "this is the objective of the first",
                "subsubject_id" => $subject->subsubjects[0]->id,
                "user_id" => 1, // admin
                "level_id" => $level->id,
                "location_in_cycle_id" => $location->id,
                "purpose_id" => $purpose->id,
                "is_free" => 1,
                "is_active" => 1,
            ]);
        }


        $activitySection = ActivitySection::create([
            "activity_id" => $activity->id,
            "title" => "first section of first activity",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $activitySection2 = ActivitySection::create([
            "activity_id" => $activity->id,
            "title" => "second section of first activity",
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        $comp1 =Component::create([
            'created_at' => now(),
            'updated_at' => now(),
            'Component_name'=> 'Video',
            'Description' => 'this component is used by the students to interact with the activity and measure data'
        ]);

        $comp2 =Component::create([
            'created_at' => now(),
            'updated_at' => now(),
            'Component_name'=> 'Sheet and a chart',
            'Description' => 'this component is used store the data taken by the user using measurment tools'
        ]);
        $comp3 =Component::create([
            'created_at' => now(),
            'updated_at' => now(),
            'Component_name'=> 'Sheet only',
            'Description' => 'this component is used by the students to interact with the activity and take data'
        ]);
        $comp4 =Component::create([
            'created_at' => now(),
            'updated_at' => now(),
            'Component_name'=> 'End_question',
            'Description' => 'this component is used by the students to interact with the activity and take data'
        ]);
        $comp5 =Component::create([
            'created_at' => now(),
            'updated_at' => now(),
            'Component_name'=> 'Multi Question',
            'Description' => 'this component is used by the students to interact with the activity and take data'
        ]);

        $activitySection->components()->attach([$comp1->id,$comp2->id,$comp3->id]);
        $activitySection2->components()->attach([$comp1->id]);


        $measureTool1=MeasureTool::create([
            "measureTool_name" => "Ruler",            
        ]);
        $measureTool2=MeasureTool::create([
            "measureTool_name" => "Protactor",            
        ]);
        MeasureTool::create([
            "measureTool_name" => "Timer",            
        ]);

        //========== protactor
        Unit::create([
            "measureTool_id"=>$measureTool2->id,
            "unit_name" => "180_degree",     
            "src_link" => "/player_tools/protactor180.svg",     
        ]);
        Unit::create([
            "measureTool_id"=>$measureTool2->id,
            "unit_name" => "360_degree", 
            "src_link" => "/player_tools/protactor180.svg",                
        ]);

        //========== ruler
        Unit::create([
            "measureTool_id"=>$measureTool1->id,
            "unit_name" => "mm",     
            "src_link" => "/player_tools/exportedRuler2.svg",     
        ]);
        Unit::create([
            "measureTool_id"=>$measureTool1->id,
            "unit_name" => "cm", 
            "src_link" => "/player_tools/exportedRuler2.svg",                
        ]);
        Unit::create([
            "measureTool_id"=>$measureTool1->id,
            "unit_name" => "m", 
            "src_link" => "/player_tools/exportedRuler2.svg",                
        ]);
       
       
    }

}
