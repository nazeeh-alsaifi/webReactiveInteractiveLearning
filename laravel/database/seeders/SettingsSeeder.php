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
        AcademicLevel::create([
            // "id"=>2,
            "AcademicLevel" => "Primary",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Country
        $country=Country::create([
            // 'id'=>1,
            'country_name' => "Syria",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       

        // City
        City::create([
            // "id"=>1,
            "Country_id" => $country->id,
            "city_name" => "Damscuss",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        City::create([
            // "id"=>2,
            "Country_id" => $country->id,
            "city_name" => "Aleppo",
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
       
        $subject = Subject::create([
            "Subject_name" =>"Physics",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

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

    }

}
