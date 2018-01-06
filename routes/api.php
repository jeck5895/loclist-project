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
    Route::apiResource('maintainance/industries', 'Maintainance\IndustriesController');
    Route::apiResource('maintainance/nationalities', 'Maintainance\NationalitiesController');
    Route::apiResource('maintainance/certificates','Maintainance\CertificatesController');
    Route::apiResource('clients', 'Clients\ClientsController');
    Route::apiResource('maintainance/sourcing_practices','Maintainance\SourcingPracticesController');
    Route::apiResource('maintainance/departments', 'Maintainance\DepartmentsController');
    Route::apiResource('maintainance/positions', 'Maintainance\PositionsController');
    Route::apiResource('maintainance/manpowers', 'Maintainance\ManpowersController');
    Route::apiResource('maintainance/statuses', 'Maintainance\StatusesController');
    Route::apiResource('maintainance/saturations','Maintainance\SaturationController');
    Route::apiResource('maintainance/confirmations','Maintainance\ConfirmationController');
    Route::apiResource('clients.calls','Clients\ClientCallController');
    Route::apiResource('clients.saturations','Clients\ClientSaturationController');
    Route::apiResource('maintainance/mode-of-presentations','Maintainance\PresentationModesController');
    Route::apiResource('maintainance/presentation-statuses', 'Maintainance\PresentationStatusesController');
    Route::apiResource('maintainance/action-plans', 'Maintainance\ActionPlansController');
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
