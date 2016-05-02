<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::post('/registerUser','MobileController@registerUser');
Route::post('/registerPictureProfile','MobileController@registerPictureProfile');
Route::post('/getNotification','MobileController@getNotification');
Route::post('/friendrequest','MobileController@friendRequest');
Route::post('/getworkout','MobileController@getWorkout');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/home',[
        'as' => 'home',
        'uses' => 'FitnessController@home'
    ]);

    Route::get('/',[
        'as' => 'home',
        'uses' => 'FitnessController@home'
    ]);
    Route::get('index',[
        'as' => 'home',
        'uses' => 'FitnessController@home'
    ]);

    Route::post('/search','FitnessController@search');


    Route::get('liste','FitnessController@listeUser');
    Route::get('waiting','FitnessController@waiting');
    Route::get('myuser','FitnessController@myuser');

// Authentication routes...
    Route::get('auth/login', 'Auth\AuthController@getlogin');
    Route::post('auth/login', 'Auth\AuthController@postLogin');
    Route::get('auth/logout', 'Auth\AuthController@logout');

// Registration routes...
    Route::get('auth/register', 'Auth\AuthController@getRegister');
    Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
    Route::get('password/email', 'Auth\PasswordController@getEmail');
    Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset');



    Route::post('/addUser','FitnessController@addUser');
    Route::post('/delUser','FitnessController@delUser');
    Route::post('/user/addWorkout','FitnessController@addWorkout');
    Route::get('/getInfoUser','FitnessController@getinfoUser');
    Route::get('/user/{id}','FitnessController@showUser');
    Route::get('/test','FitnessController@test');
    Route::post('/user/updateWorkout','FitnessController@updateWorkout');
    Route::post('/user/deleteWorkout','FitnessController@deleteWorkout');


});
