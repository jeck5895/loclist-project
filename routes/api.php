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
    Route::apiResource('users', 'Users\UsersController');
    Route::apiResource('user_types', 'Maintainance\UserTypesController');
    Route::apiResource('companies', 'Companies\CompaniesController');
    Route::apiResource('industries', 'Maintainance\IndustriesController');
    Route::apiResource('nationalities', 'Maintainance\NationalitiesController');
    Route::apiResource('certificates','Maintainance\CertificatesController');
    Route::apiResource('clients', 'Clients\ClientsController');
    Route::apiResource('sourcing_practices','Maintainance\SourcingPracticesController');
    Route::apiResource('departments', 'Maintainance\DepartmentsController');
    Route::apiResource('positions', 'Maintainance\PositionsController');
    Route::apiResource('manpowers', 'Maintainance\ManpowersController');
    Route::apiResource('statuses', 'Maintainance\StatusesController');
    Route::apiResource('saturations','Maintainance\SaturationController');
    Route::apiResource('confirmations','Maintainance\ConfirmationController');
    Route::apiResource('clients.calls','Clients\ClientCallController');
    Route::apiResource('clients.saturations','Clients\ClientSaturationController');
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
