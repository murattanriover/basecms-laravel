<?php
header('Access-Control-Allow-Origin: *');
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::controllers(['auth' => 'Auth\AuthController']);//'password' => 'Auth\PasswordController']);


Route::get("home",function(){
    return "ok";
});

Route::group(['middleware' => 'auth'], function()
{
    Route::get('/','Admin\homeController@index');
    Route::get('dashboard','Admin\homeController@index');

    // Settings
    // Users Management
    Route::resource('settings/users','Admin\Settings\UserController');
    Route::controller('settings/users/data','Admin\Settings\UserController');
    // Groups Management
    Route::resource('settings/groups','Admin\Settings\GroupController');
    Route::controller('settings/groups/data','Admin\Settings\GroupController');
    // Config Management
    Route::resource('settings/config','Admin\Settings\ConfigController');
    Route::controller('settings/config/data','Admin\Settings\ConfigController');


});





