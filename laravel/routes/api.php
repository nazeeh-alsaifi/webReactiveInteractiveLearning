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

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('register', 'AuthController@register'); 
    ////////my routes
    Route::resource('AcademicLevels','AcademiclevelController');
    Route::resource('Subjects','SubjectsController');
    Route::resource('Cities','CityController');
    Route::resource('Countries','CountryController');
    Route::resource('Purchase','PurchaseController');
    Route::resource('Category','CategoryController');
    Route::resource('Component','ComponentController');
    Route::resource('Measuretool','MeasureToolsController');
    Route::post('Purchase/Free_Trail','PurchaseController@Free_Trail');
    Route::post('Purchase/Free_Student','PurchaseController@Free_Student');
    ////
    Route::get('academiclevel/getpage','AcademiclevelController@getpage');
    Route::get('country/getpage','CountryController@getpage');
    Route::get('category/getpage','CategoryController@getpage');
    Route::get('city/getpage','CityController@getpage');
    Route::get('component/getpage','ComponentController@getpage');
    Route::get('measuretool/getpage','MeasureToolsController@getpage');
    //
    Route::post('academiclevels/store1','AcademiclevelController@store1');
    Route::post('countries/store1','CountryController@store1');
    Route::post('categories/store1','CategoryController@store1');
    Route::post('cities/store1','CityController@store1');
    Route::post('components/store1','ComponentController@store1');
    Route::post('measuretools/store1','MeasureToolsController@store1');
    //
    Route::resource('notes', 'NotesController');

    Route::resource('resource/{table}/resource', 'ResourceController');
    
    Route::group(['middleware' => 'admin'], function ($router) {

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

