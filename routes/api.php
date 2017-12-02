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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function() {
    // Route::get('/users', 'UsersController@index');
    // Route::get('/users/{id}', 'UsersController@show');
    // Route::post('/user', 'UsersController@store');
    // Route::patch('/user/{id}', 'UsersController@update');
    Route::apiResource('users', 'users\UsersController');
    Route::apiResource('user_types', 'maintainance\UserTypesController');
    Route::apiResource('industries', 'maintainance\IndustriesController');
    Route::apiResource('nationalities', 'maintainance\NationalitiesController');
    Route::apiResource('certificates','maintainance\CertificatesController');
    Route::apiResource('clients', 'clients\ClientsController');
    Route::apiResource('sourcing_practices','maintainance\SourcingPracticesController');
    Route::apiResource('departments', 'maintainance\DepartmentsController');
    Route::apiResource('positions', 'maintainance\PositionsController');
    Route::apiResource('manpowers', 'maintainance\ManpowersController');
});

Route::get('/test',function(){
    // return response()->json([
    //     "user" => [
    //         'lastname' => 'Jerick',
    //         'firstname' => 'Labasan'
    //     ]
    // ]);
});

// Route::get('/users','Auth\LoginController@users');
