<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

use App\Models\User;
use App\Models\RoleHierarchy;

use App\Models\settings\Subject;
use App\Models\settings\SubSubject;
use App\Models\settings\Country;
use App\Models\settings\City;
use App\Models\settings\Nationality;
use App\Models\settings\AcademicLevel;
use App\Models\settings\Category;
use App\Models\settings\SubCategory;

use App\Models\users\Teacher;
use App\Models\users\Employee;
use App\Models\users\Student;
use App\Models\users\SubjectCoordinator;
use App\Models\users\ActivationCodes;

use App\Models\institutions\Institution;
use App\Models\institutions\InstitutionClass;
use App\Models\institutions\InstitutionSubject;


use App\Models\durations\DurationCourse;



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
            $this->command->comment("new round i=" . $i);

            $userName = $usersRoles[$i]->name;
            $this->command->comment("userName=" . $userName);

            $user = User::create([
                'name' => $faker->name(),
                'email' => $userName . "@" . $userName .".com",
                'email_verified_at' => now(),
                'password' => Hash::make("password"), // password
                'remember_token' => Str::random(10),
                'menuroles' => $userName,
                'status' => $userStatus[ random_int(0,count($userStatus) - 1) ]
            ]);
            $user->assignRole($usersRoles[$i]->name);
            array_push($usersIds, $user->id);

            if($usersRoles[$i]->name == 'student'){
                $this->command->comment("IF STATEMENT: STUDENT");
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
                $this->command->comment("IF STATEMENT: TEACHER");

                $subject =Subject::create([
                    "Subject_name" =>"Math",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $subject->subSubjects()->saveMany([new SubSubject([
                    "sub_subject_name" => "math sub 1",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]),new SubSubject([
                    "sub_subject_name" => "math sub 2",
                    'created_at' => now(),
                    'updated_at' => now(),
                ])]);

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

            if($usersRoles[$i]->name == 'coordinatory'){
                $this->command->info("IF STATEMENT: COORDINATOR");

                $subject = Subject::create([
                    "Subject_name" =>"Physics",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                              
                $subject->subSubjects()->saveMany([new SubSubject([
                    "sub_subject_name" => "physics sub 1",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]),new SubSubject([
                    "sub_subject_name" => "physics sub 2",
                    'created_at' => now(),
                    'updated_at' => now(),
                ])]);

                $natio =Nationality::create([
                    "Nationality_name" => "German",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $coordinator =Teacher::create([
                    'First_name' =>"coordinator_" . $i,
                    'Last_Name' => "coordinator_" . $i,
                    'subject_id' => $subject->id,
                    'nationality_id'=> $natio->id,
                    'Mobile' => "093333333333",
                    'Gender' => 'male',
                    'birth_date' => now(),
                    'user_id' => $user->id,
                    'Is_Coordinator' => 1,
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
                $city=City::create([
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

                $acadLevel= AcademicLevel::create([
                    // "id"=>2,
                    "AcademicLevel" => "Primary",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
                $institution =  Institution::create([
                    "Institu_name" => "syrian virtual university",
                    "coordinator_id" =>$coordinator->id,
                    "academicLevels_id" =>$acadLevel->id,
                    "country_id" => $country->id,
                    "city_id" => $city->id,
                    "Mobile" => "093333333",
                    "Email" => "svu@svu.com",
                    "Address" =>"damascus",
                    "Address1" =>"aleppo",
                ]);
                // $institution->save();

                //
                $institution_subject =  InstitutionSubject::create([
                    "institution_id" => $institution->id,
                    "subject_id" => $subject->id,
                    "Student_count" => 20,
                    "Teacher_count" => 5,
                    "buyment_method_id" => 1,
                ]);
                // $institution_subject->save();

                $institution_subject_coordinator =  SubjectCoordinator::create([
                    "user_id" => $user->id,
                    "institution_subject_id" => $institution_subject->id,
                ]);
                // $institution_subject_coordinator->save();   
               
                for($n=0; $n < $institution_subject->Teacher_count; $n++){

                    $user =User::create([
                        "name" => 'default',
                        "password" => Hash::make('First_Name'),
                        "email" => "teacher_" . $n . "@teacher.com",
                        "menuroles" => "teacher",
                        "status" => 'inactive',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    $user->assignRole("teacher");
                    // $user->save();

                    $teacher = Teacher::create([
                        'First_name' =>"teacher_" . $n,
                        'Last_Name' => "teacher_" . $n,
                        'subject_id' => $institution_subject->subject_id,
                        'nationality_id'=> 1,
                        'Mobile' => 0,
                        'Gender' => 'default',
                        'birth_date' => now(),
                        'user_id' => $user->id,
                        'Is_Coordinator' => 0,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    
                    $activeCode = ActivationCodes::create([
                        "Activate_code" => "testTeacher" . $n,
                        "user_id" => $user->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
        

                    $institutionClass = InstitutionClass::create([
                        "teacher_id" => $teacher->id,
                        "institution_subject_id" =>$institution_subject->id  ,
                        "keyclass" => "helloworld" ,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    
                }
                $this->command->info("END IF STATEMENT: COORDINATOR");

            }

            if($usersRoles[$i]->name == 'editor'){
                $this->command->comment("IF STATEMENT: EDITOR");

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
                City::create([
                    // "id"=>4,
                    "Country_id" => $country->id,
                    "city_name" => "Jiza",
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
                'users_id'      => $usersIds[array_rand($usersIds)]
            ]);
        }


        // /**   PERMISSIONS */
        // Permission::create(['name' => 'view dashboard']);
        // Permission::create(['name' => 'view Setting']);
        Permission::create(['name' => 'add Settings']);
        Permission::create(['name' => 'edit Settings']);
        Permission::create(['name' => 'delete Settings']);
        // Permission::create(['name' => 'view institution']);
        Permission::create(['name' => 'add Institution']);
        Permission::create(['name' => 'edit Institution']);
        Permission::create(['name' => 'delete Institution']);
        // Permission::create(['name' => 'view permissions']);
        // Permission::create(['name' => 'Add permissions']);
        // Permission::create(['name' => 'Delete permissions']);

        // //== admin
        //  $adminRole->givePermissionTo('view dashboard');
        //  $adminRole->givePermissionTo('view Setting');
         $adminRole->givePermissionTo('add Settings');
         $adminRole->givePermissionTo('edit Settings');
         $adminRole->givePermissionTo('delete Settings');
        //  $adminRole->givePermissionTo('view institution');
         $adminRole->givePermissionTo('add Institution');
         $adminRole->givePermissionTo('edit Institution');
         $adminRole->givePermissionTo('delete Institution');
        //  $adminRole->givePermissionTo('view permissions');
        //  $adminRole->givePermissionTo('Add permissions');
        //  $adminRole->givePermissionTo('Delete permissions');

        //========= editor
        $editorRole->givePermissionTo('add Settings');
        $editorRole->givePermissionTo('edit Settings');
        $editorRole->givePermissionTo('delete Settings');

        $editorRole->givePermissionTo('add Institution');
        $editorRole->givePermissionTo('edit Institution');
        $editorRole->givePermissionTo('delete Institution');
    }   

    
}