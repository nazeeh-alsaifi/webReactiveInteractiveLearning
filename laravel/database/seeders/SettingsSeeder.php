<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\settings\AcademicLevel;
use App\Models\settings\Country;
use App\Models\settings\City;


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
            "Country_id" => 2,
            "city_name" => "Cairo",
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
