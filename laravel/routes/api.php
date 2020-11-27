<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
//Route::apiResource('AcademicLevel','AcademiclevelController');
Route::group(['middleware' => 'api'], function ($router) {
    Route::get('menu', 'MenuController@index');
    Route::get('user/getUsersRoles', 'UsersController@getUsersRoles');
    Route::get('user/getUserPermissions', 'UsersController@getUserPermissions');

Route::post('activation-code','JoinClassController@checkActivationCode');
Route::post('joinClass/updateCoordinatorProfile','JoinClassController@updateCoordinatorProfile');
Route::post('joinClass/createTeachers','JoinClassController@createTeachers');
Route::post('joinClass/updateTeachers','JoinClassController@updateTeachers');

Route::post('joinClass/updateTeacherProfile','JoinClassController@updateTeacherProfile');
Route::get('joinClass/getNationalities','JoinClassController@getNationalities');
Route::post('joinClass/getRemainingSeats','JoinClassController@getRemainingSeats');
Route::post('joinClass/createStudents','JoinClassController@createStudents');

Route::post('joinClass/updateStudentProfile','JoinClassController@updateStudentProfile');


// Route::get('joinClass/getTeacher','JoinClassController@getTeacher');

////
Route::resource('Purchase','PurchaseController');
Route::post('Purchase/Free_Trail','PurchaseController@Free_Trail');
Route::post('Purchase/Free_Student','PurchaseController@Free_Student');
Route::get('purchase/getacademiclevels','PurchaseController@getAcademicLevels');
Route::get('purchase/getcountries','PurchaseController@getCountries');
Route::get('purchase/getcities','PurchaseController@getCities');
Route::get('purchase/getsubjects','PurchaseController@getSubjects');
////
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('register', 'AuthController@register'); 
    Route::resource('notes', 'NotesController');

    Route::resource('resource/{table}/resource', 'ResourceController');
    
    Route::group(['middleware' => 'student'], function ($router) {
      Route::resource('Student','StudentController');
      Route::get('student/getNationalities','StudentController@getNationalities');
      Route::get('student/getUsers','StudentController@getUsers');
      Route::get('student/getStudent','StudentController@getStudent');
      Route::post('Students/storeuserprofile','StudentController@storeuserprofile');
      Route::post('Students/storestudentprofile','StudentController@storestudentprofile');
    });
    Route::group(['middleware' => 'coordinator'], function ($router) {
      Route::resource('Coordintor','CoordinatorController');
      Route::get('Coordintors/getNationalities','CoordinatorController@getNationalities');
      Route::get('Coordintors/getSubjects','CoordinatorController@getSubjects');
      Route::get('Coordintors/getInstitutionSubject','CoordinatorController@getInstitutionSubject');
      Route::get('Coordintors/getAllInstitutionSubject','CoordinatorController@getAllInstitutionSubject');
      Route::get('Coordintors/getInstitution','CoordinatorController@getInstitution');
      Route::get('Coordintors/{id}/getMySubject','CoordinatorController@getMySubject');
      Route::get('Coordintors/{id}/getMyTeacher','CoordinatorController@getMyTeacher');
      Route::get('Coordintors/{id}/getClasses','CoordinatorController@getClasses');
      Route::get('Coordintors/{id}/getTeacherClasses','CoordinatorController@getTeacherClasses');
      Route::get('Coordintors/{id}/getStudentClasses','CoordinatorController@getStudentClasses');
      Route::get('Coordintors/{id}/getMyClassSubject','CoordinatorController@getMyClassSubject');
      Route::get('Coordintors/getNoPageInstitutionSubject','CoordinatorController@getNoPageInstitutionSubject');
      Route::get('Coordintors/getNoPageClasses','CoordinatorController@getNoPageClasses');
      Route::get('Coordintors/getStudents','CoordinatorController@getStudents');
      Route::get('Coordintors/getSortTeachers','CoordinatorController@getSortTeachers');      
      Route::get('Coordintors/getUsers','CoordinatorController@getUsers');
      Route::get('Coordintors/getTeachers','CoordinatorController@getTeachers');
      Route::get('Coordintors/getCoordinatorTeachers','CoordinatorController@getCoordinatorTeachers');
      Route::post('coordintors/storeuserprofile','CoordinatorController@storeuserprofile');
      Route::post('coordintors/storeteacherprofile','CoordinatorController@storeteacherprofile');
      Route::post('coordintors/new_subject','CoordinatorController@new_subject');    
    });
    //
    Route::group(['middleware' => 'subjectcoordinator'], function ($router) {
        Route::resource('SubjectCoordinator','SubjectCoordinatorController');
        Route::get('SubjectCoordinators/myInstitutionClasses','SubjectCoordinatorController@myInstitutionClasses');
        Route::get('SubjectCoordinators/getSortTeachers','SubjectCoordinatorController@getSortTeachers');
        Route::get('SubjectCoordinators/{id}/getMyTeacher','SubjectCoordinatorController@getMyTeacher');
        Route::get('SubjectCoordinators/getSubjects','SubjectCoordinatorController@getSubjects'); 
        Route::get('SubjectCoordinators/{id}/getTeacherClasses','SubjectCoordinatorController@getTeacherClasses');
        Route::get('SubjectCoordinators/getTeachers','SubjectCoordinatorController@getTeachers');
        Route::get('SubjectCoordinators/getAllInstitutionSubject','SubjectCoordinatorController@getAllInstitutionSubject');
        Route::get('SubjectCoordinators/{id}/getMyClassSubject','SubjectCoordinatorController@getMyClassSubject');
        Route::get('SubjectCoordinators/getStudents','SubjectCoordinatorController@getStudents');
        Route::get('SubjectCoordinators/{id}/getStudentClasses','SubjectCoordinatorController@getStudentClasses');
        Route::get('SubjectCoordinators/getUsers','SubjectCoordinatorController@getUsers');
        Route::get('SubjectCoordinators/getNationalities','SubjectCoordinatorController@getNationalities');
        Route::post('SubjectCoordinators/storeuserprofile','SubjectCoordinatorController@storeuserprofile');
        Route::post('SubjectCoordinators/storeteacherprofile','SubjectCoordinatorController@storeteacherprofile');
    });
    
    //
    //
    Route::group(['middleware' => 'teacher'], function ($router) {
        Route::resource('Teacher','TeacherController');
        Route::get('Teachers/getMyTeacher','TeacherController@getMyTeacher');
        Route::get('Teachers/getSubjects','TeacherController@getSubjects');
        Route::get('Teachers/getTeacherClasses','TeacherController@getTeacherClasses');
        Route::get('Teachers/getAllInstitutionSubject','TeacherController@getAllInstitutionSubject');
        Route::get('Teachers/getTeachers','TeacherController@getTeachers');
        Route::get('Teachers/{id}/getMyClassSubject','TeacherController@getMyClassSubject');
        Route::get('Teachers/getStudents','TeacherController@getStudents');
        Route::get('Teachers/{id}/getStudentClasses','TeacherController@getStudentClasses');
        Route::get('Teachers/getUsers','TeacherController@getUsers');
        Route::get('Teachers/getNationalities','TeacherController@getNationalities');
        Route::post('Teachers/storeuserprofile','TeacherController@storeuserprofile');
      Route::post('Teachers/storeteacherprofile','TeacherController@storeteacherprofile');
    });
    //
    Route::group(['middleware' => 'admin'], function ($router) {
    /*  Activity Routes */


    ////////my routes
    Route::resource('AcademicLevels','AcademiclevelController');
    Route::resource('Subjects','SubjectsController');
    Route::resource('Cities','CityController');
    Route::resource('Countries','CountryController');
    Route::resource('Category','CategoryController');
    Route::resource('Component','ComponentController');
    Route::resource('Measuretool','MeasureToolsController');
    Route::resource('Nationality','NationalityController');
    Route::resource('SubCategory','SubCategoryController');
    Route::resource('SubSubject','SubSubjectController');
    Route::resource('Unit','UnitController');
    Route::resource('UnitMeasure','UnitsMeasureController');
    Route::resource('Institution','InstitiutionController');
    Route::resource('Employee','EmployeeController');
    Route::resource('Permissions','PermissionsController');
    Route::resource('InstructionalPurpose','InstructionalPurposeController');
    Route::resource('LevelOfScaffolding','LevelOfScaffoldingController');
    Route::resource('LocationInstructional','LocationInstructionalController');
   
    ////
    Route::get('academiclevel/getpage','AcademiclevelController@getpage');
    Route::get('country/getpage','CountryController@getpage');
    Route::get('category/getpage','CategoryController@getpage');
    Route::get('city/getpage','CityController@getpage');
    Route::get('component/getpage','ComponentController@getpage');
    Route::get('measuretool/getpage','MeasureToolsController@getpage');
    Route::get('nationality/getpage','NationalityController@getpage');
    Route::get('subCategory/getpage','SubCategoryController@getpage');
    Route::get('subjects/getpage','SubjectsController@getpage');
    Route::get('suSubject/getpage','SubSubjectController@getpage');
    Route::get('unit/getpage','UnitController@getpage');
    Route::get('unitMeasure/getpage','UnitsMeasureController@getpage');
    Route::get('institution/getpage','InstitiutionController@getpage');
    Route::get('employee/getpage','EmployeeController@getpage');
    Route::get('instructionalPurpose/getpage','InstructionalPurposeController@getpage');
    Route::get('levelOfScaffolding/getpage','LevelOfScaffoldingController@getpage');
    Route::get('locationInstructional/getpage','LocationInstructionalController@getpage');
    

    //
    Route::post('academiclevels/store1','AcademiclevelController@store1');
    Route::post('academiclevels/delete','AcademiclevelController@delete');
    Route::post('countries/store1','CountryController@store1');
    Route::post('countries/delete','CountryController@delete');
    Route::post('categories/store1','CategoryController@store1');
    Route::post('categories/delete','CategoryController@delete');
    Route::post('cities/store1','CityController@store1');
    Route::post('cities/delete','CityController@delete');
    Route::post('components/store1','ComponentController@store1');
    Route::post('components/delete','ComponentController@delete');
    Route::post('measuretools/store1','MeasureToolsController@store1');
    Route::post('measuretools/delete','MeasureToolsController@delete');
    Route::post('nationalities/store1','NationalityController@store1');
    Route::post('nationalities/delete','NationalityController@delete');
    Route::post('subCategories/store1','SubCategoryController@store1');
    Route::post('subCategories/delete','SubCategoryController@delete');
    Route::post('subject/store1','SubjectsController@store1');
    Route::post('subject/delete','SubjectsController@delete');
    Route::post('suSubjects/store1','SubSubjectController@store1');
    Route::post('suSubjects/delete','SubSubjectController@delete');
    Route::post('units/store1','UnitController@store1');
    Route::post('units/delete','UnitController@delete');
    Route::post('unitMeasures/store1','UnitsMeasureController@store1');
    Route::post('unitMeasures/delete','UnitsMeasureController@delete');
    Route::post('institutions/store1','InstitiutionController@store1');
    Route::post('institutions/delete','InstitiutionController@delete');
    Route::post('employees/store1','EmployeeController@store1');
    Route::post('employees/delete','EmployeeController@delete');
    Route::post('instructionalPurpose/store1','InstructionalPurposeController@store1');
    Route::post('instructionalPurpose/delete','InstructionalPurposeController@delete');
    Route::post('levelOfScaffolding/store1','LevelOfScaffoldingController@store1');
    Route::post('levelOfScaffolding/delete','LevelOfScaffoldingController@delete');
    Route::post('locationInstructional/store1','LocationInstructionalController@store1');
    Route::post('locationInstructional/delete','LocationInstructionalController@delete');
    //
    Route::get('employee/myusers','EmployeeController@myusers');
    Route::post('employees/store_user_profile','EmployeeController@storeuserprofile');
    Route::post('employees/store_employee_profile','EmployeeController@storeemployeeprofile');    
    //
    Route::get('permissions/roles_permissions','PermissionsController@rolesPermissions');
    Route::post('permissions/addtorole','PermissionsController@addtorole');
    Route::get('permissions/{id}/delete','PermissionsController@delete');
    //


        Route::resource('mail',        'MailController');
        Route::get('prepareSend/{id}', 'MailController@prepareSend')->name('prepareSend');
        Route::post('mailSend/{id}',   'MailController@send')->name('mailSend');

        Route::resource('bread',  'BreadController');   //create BREAD (resource)

        Route::resource('users', 'UsersController')->except( ['create', 'store'] );

        Route::prefix('menu/menu')->group(function () { 
            Route::get('/',         'MenuEditController@index')->name('menu.menu.index');
            Route::get('/create',   'MenuEditController@create')->name('menu.menu.create');
            Route::post('/store',   'MenuEditController@store')->name('menu.menu.store');
            Route::get('/edit',     'MenuEditController@edit')->name('menu.menu.edit');
            Route::post('/update',  'MenuEditController@update')->name('menu.menu.update');
            Route::get('/delete',   'MenuEditController@delete')->name('menu.menu.delete');
        });
        Route::prefix('menu/element')->group(function () { 
            Route::get('/',             'MenuElementController@index')->name('menu.index');
            Route::get('/move-up',      'MenuElementController@moveUp')->name('menu.up');
            Route::get('/move-down',    'MenuElementController@moveDown')->name('menu.down');
            Route::get('/create',       'MenuElementController@create')->name('menu.create');
            Route::post('/store',       'MenuElementController@store')->name('menu.store');
            Route::get('/get-parents',  'MenuElementController@getParents');
            Route::get('/edit',         'MenuElementController@edit')->name('menu.edit');
            Route::post('/update',      'MenuElementController@update')->name('menu.update');
            Route::get('/show',         'MenuElementController@show')->name('menu.show');
            Route::get('/delete',       'MenuElementController@delete')->name('menu.delete');
        });
        Route::prefix('media')->group(function ($router) {
            Route::get('/',                 'MediaController@index')->name('media.folder.index');
            Route::get('/folder/store',     'MediaController@folderAdd')->name('media.folder.add');
            Route::post('/folder/update',   'MediaController@folderUpdate')->name('media.folder.update');
            Route::get('/folder',           'MediaController@folder')->name('media.folder');
            Route::post('/folder/move',     'MediaController@folderMove')->name('media.folder.move');
            Route::post('/folder/delete',   'MediaController@folderDelete')->name('media.folder.delete');;

            Route::post('/file/store',      'MediaController@fileAdd')->name('media.file.add');
            Route::get('/file',             'MediaController@file');
            Route::post('/file/delete',     'MediaController@fileDelete')->name('media.file.delete');
            Route::post('/file/update',     'MediaController@fileUpdate')->name('media.file.update');
            Route::post('/file/move',       'MediaController@fileMove')->name('media.file.move');
            Route::post('/file/cropp',      'MediaController@cropp');
            Route::get('/file/copy',        'MediaController@fileCopy')->name('media.file.copy');

            Route::get('/file/download',    'MediaController@fileDownload');
        });

        Route::resource('roles',        'RolesController');
        Route::get('/roles/move/move-up',      'RolesController@moveUp')->name('roles.up');
        Route::get('/roles/move/move-down',    'RolesController@moveDown')->name('roles.down');
    });
});

