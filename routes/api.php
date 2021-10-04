<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'auth'], function () {
	Route::post('login', 'App\Http\Controllers\Auth\AuthControllerApi@login');
	Route::get('login', 'App\Http\Controllers\Auth\AuthControllerApi@dataForLogin');
	Route::post('signup', 'App\Http\Controllers\Auth\AuthControllerApi@signup');

	Route::group(['middleware' => 'auth:api'], function () {
		Route::get('logout', 'App\Http\Controllers\Auth\AuthControllerApi@logout');
		Route::get('user', 'App\Http\Controllers\Auth\AuthControllerApi@user');
	});
});

// Route::prefix('events')->group(function () {
//     Route::get('/', 'App\Http\Controllers\EventControllerApi@index');
//     Route::get('/{id}', 'App\Http\Controllers\EventControllerApi@show');
//     Route::post('/', 'App\Http\Controllers\EventControllerApi@store');
//     Route::put('/{id}', 'App\Http\Controllers\EventControllerApi@update');
//     Route::delete('/{id}', 'App\Http\Controllers\EventControllerApi@destroy');
// });
Route::apiResource('events', 'App\Http\Controllers\EventController');
Route::apiResource('teachers', 'App\Http\Controllers\TeacherController');
Route::apiResource('students', 'App\Http\Controllers\StudentController');
Route::get('home', 'App\Http\Controllers\HomeController@index');
Route::get('user', 'App\Http\Controllers\UserController@index');

