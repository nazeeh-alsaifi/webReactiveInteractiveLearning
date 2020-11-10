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
        Country::create([
            // 'id'=>1,
            'country_name' => "Syria",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Country::create([
            // 'id'=>2,
            'country_name' => "Egypt",
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        // City
        City::create([
            // "id"=>1,
            "Country_id" => 1,
            "city_name" => "Damscuss",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        City::create([
            // "id"=>2,
            "Country_id" => 1,
            "city_name" => "Aleppo",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        City::create([
            // "id"=>3,
            "Country_id" => 2,
            "city_name" => "Cairo",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        City::create([
            // "id"=>4,
            "Country_id" => 2,
            "city_name" => "Jiza",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Subject
        Subject::create([
            "Subject_name" =>"Math",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Subject::create([
            "Subject_name" =>"Physics",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Nationalities
        Nationality::create([
            "Nationality_name" => "German",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Nationality::create([
            "Nationality_name" => "Syrian",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       
        // Categories
        Category::create([
            "subject_id" => 1,
            "Cat_name" => "Category 1 of subject 1",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Category::create([
            "subject_id" => 1,
            "Cat_name" => "Category 2 of subject 1",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Category::create([
            "subject_id" => 2,
            "Cat_name" => "Category 1 of subject 2",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        Category::create([
            "subject_id" => 2,
            "Cat_name" => "Category 2 of subject 2",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       
        // Sub Categories
        SubCategory::create([
            "category_id" => 1,
            "sub_cat_name" => "SubCategory 1 of catergory 1",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        SubCategory::create([
            "category_id" => 1,
            "sub_cat_name" => "SubCategory 2 of category 1",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        SubCategory::create([
            "category_id" => 2,
            "sub_cat_name" => "SubCategory 1 of category 2",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        SubCategory::create([
            "category_id" => 2,
            "sub_cat_name" => "SubCategory 2 of category 2",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

}
