<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\RoleHierarchy;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use App\Models\settings\Subject;
use App\Models\settings\Country;
use App\Models\settings\City;
use App\Models\settings\Nationality;
use App\Models\users\Teacher;
use App\Models\users\Employee;
use App\Models\users\Student;


class UsersAndNotesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numberOfUsers = 7;
        $numberOfNotes = 100;
        $usersIds = array();
        $statusIds = array();
        $userStatus = array(
            'Active',
            'Inactive',
            'Pending',
            'Banned'
        );
        /* Create roles */
        $adminRole = $roleAdmin = Role::create(['name' => 'admin']);
        RoleHierarchy::create([
            'role_id' => $adminRole->id,
            'hierarchy' => 1,
        ]);
        $userRole = Role::create(['name' => 'user']);
        RoleHierarchy::create([
            'role_id' => $userRole->id,
            'hierarchy' => 2,
        ]);
        $guestRole = Role::create(['name' => 'guest']); 
        RoleHierarchy::create([
            'role_id' => $guestRole->id,
            'hierarchy' => 3,
        ]);
        $editorRole = Role::create(['name' => 'editor']); 
        RoleHierarchy::create([
            'role_id' => $editorRole->id,
            'hierarchy' => 4,
        ]);
        $coordinatorRole = Role::create(['name' => 'coordinator']); 
        RoleHierarchy::create([
            'role_id' => $coordinatorRole->id,
            'hierarchy' => 5,
        ]);
        $teacherRole = Role::create(['name' => 'teacher']); 
        RoleHierarchy::create([
            'role_id' => $teacherRole->id,
            'hierarchy' => 6,
        ]);
        $studentRole = Role::create(['name' => 'student']); 
        RoleHierarchy::create([
            'role_id' => $studentRole->id,
            'hierarchy' => 7,
        ]);
        $freeStudentRole = Role::create(['name' => 'free_student']); 
        RoleHierarchy::create([
            'role_id' => $freeStudentRole->id,
            'hierarchy' => 8,
        ]);
        $subjectCoordinator = Role::create(['name' => 'subject_coordinator']); 
        RoleHierarchy::create([
            'role_id' => $subjectCoordinator->id,
            'hierarchy' => 9,
        ]);

        
        //  admin
        //  user
        //  guest
        // editor
        // coordinator
        // teacher
        // student
        // free_student
        // subject_coordinator
        

        $faker = Faker::create();
        /*  insert status  */
        DB::table('status')->insert([
            'name' => 'ongoing',
            'class' => 'primary',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        DB::table('status')->insert([
            'name' => 'stopped',
            'class' => 'secondary',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        DB::table('status')->insert([
            'name' => 'completed',
            'class' => 'success',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        DB::table('status')->insert([
            'name' => 'expired',
            'class' => 'warning',
        ]);
        array_push($statusIds, DB::getPdo()->lastInsertId());
        /*  insert users   */
        $user = User::create([ 
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make("password"), // password
            'remember_token' => Str::random(10),
            'menuroles' => 'admin',
            'status' => 'Active'
        ]);
        // $user->assignRole('user');
        $usersRoles = [$userRole,$editorRole,$coordinatorRole,$teacherRole,$studentRole,$freeStudentRole,$subjectCoordinator];
        $user->assignRole($roleAdmin);
        for($i = 0; $i<$numberOfUsers; $i++){
            $userName = $usersRoles[$i]->name;
            $user = User::create([
                'name' => $faker->name(),
                'email' => $userName . "@" . $userName .".com",
                'email_verified_at' => now(),
                'password' => Hash::make("password"), // password
                'remember_token' => Str::random(10),
                'menuroles' => $userName,
                'status' => $userStatus[ random_int(0,count($userStatus) - 1) ]
            ]);
            $user->assignRole($usersRoles[$i]);
            array_push($usersIds, $user->id);

            if($usersRoles[$i]->name == 'student'){
                $natio =Nationality::create([
                    "Nationality_name" => "britsh",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                Student::create([
                    'First_name' =>$faker->name(),
                    'Last_Name' => $faker->name(),
                    'nationality_id'=> $natio->id,
                    'Mobile' => Str::random(10),
                    'Gender' => 'male',
                    'birth_date' => now(),
                    'user_id' => $user->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            if($usersRoles[$i]->name == 'teacher'){
                $subject =Subject::create([
                    "Subject_name" =>"Math",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $natio =Nationality::create([
                    "Nationality_name" => "lebanese",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                Teacher::create([
                    'First_name' =>$faker->name(),
                    'Last_Name' => $faker->name(),
                    'subject_id' => $subject->id,
                    'nationality_id'=> $natio->id,
                    'Mobile' => Str::random(10),
                    'Gender' => 'male',
                    'birth_date' => now(),
                    'user_id' => $user->id,
                    'Is_Coordinator' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            if($usersRoles[$i]->name == 'coordinator'){
                $subject =Subject::create([
                    "Subject_name" =>"Physics",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $natio =Nationality::create([
                    "Nationality_name" => "German",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                Teacher::create([
                    'First_name' =>$faker->name(),
                    'Last_Name' => $faker->name(),
                    'subject_id' => $subject->id,
                    'nationality_id'=> $natio->id,
                    'Mobile' => Str::random(10),
                    'Gender' => 'male',
                    'birth_date' => now(),
                    'user_id' => $user->id,
                    'Is_Coordinator' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            if($usersRoles[$i]->name == 'editor'){
                $country=Country::create([
                    // 'id'=>2,
                    'country_name' => "Egypt",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $city =City::create([
                    // "id"=>3,
                    "Country_id" => $country->id,
                    "city_name" => "Cairo",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $natio =Nationality::create([
                    "Nationality_name" => "egyptian",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                Employee::create([
                    'First_name' =>$faker->name(),
                    'Last_Name' => $faker->name(),
                    'Mobile' => Str::random(10),
                    'Gender' => 'male',
                    'country_id'=> $country->id,
                    'city_id' => $city->id,
                    'nationality_id'=> $natio->id,
                    'Address' => Str::random(10),
                    'Address1' => Str::random(10),
                    'user_id' => $user->id,
                    'birth_date' => now(),
                    'jop_date' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            
        }
        /*  insert notes  */
        for($i = 0; $i<$numberOfNotes; $i++){
            $noteType = $faker->word();
            if(random_int(0,1)){
                $noteType .= ' ' . $faker->word();
            }
            DB::table('notes')->insert([
                'title'         => $faker->sentence(4,true),
                'content'       => $faker->paragraph(3,true),
                'status_id'     => $statusIds[random_int(0,count($statusIds) - 1)],
                'note_type'     => $noteType,
                'applies_to_date' => $faker->date(),
                'users_id'      => $usersIds[random_int(0,$numberOfUsers-1)]
            ]);
        }


        // /**   PERMISSIONS */
        // Permission::create(['name' => 'view dashboard']);
        // Permission::create(['name' => 'view Setting']);
        // Permission::create(['name' => 'Add Setting']);
        // Permission::create(['name' => 'Edit Setting']);
        // Permission::create(['name' => 'Delete Setting']);
        // Permission::create(['name' => 'view institution']);
        // Permission::create(['name' => 'Add institution']);
        // Permission::create(['name' => 'Edit institution']);
        // Permission::create(['name' => 'Delete institution']);
        // Permission::create(['name' => 'view permissions']);
        // Permission::create(['name' => 'Add permissions']);
        // Permission::create(['name' => 'Delete permissions']);

        // //== admin
        //  $adminRole->givePermissionTo('view dashboard');
        //  $adminRole->givePermissionTo('view Setting');
        //  $adminRole->givePermissionTo('Add Setting');
        //  $adminRole->givePermissionTo('Edit Setting');
        //  $adminRole->givePermissionTo('Delete Setting');
        //  $adminRole->givePermissionTo('view institution');
        //  $adminRole->givePermissionTo('Add institution');
        //  $adminRole->givePermissionTo('Edit institution');
        //  $adminRole->givePermissionTo('Delete institution');
        //  $adminRole->givePermissionTo('view permissions');
        //  $adminRole->givePermissionTo('Add permissions');
        //  $adminRole->givePermissionTo('Delete permissions');


    }

    
}