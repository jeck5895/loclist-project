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
    Route::get('reports/target-lists/years', 'Reports\TargetListsController@years');
    Route::apiResource('users', 'Users\UsersController');
    Route::apiResource('user_types', 'Maintenance\UserTypesController');
    Route::apiResource('companies', 'Companies\CompaniesController');
    Route::apiResource('maintenance/industries', 'Maintenance\IndustriesController');
    Route::apiResource('maintenance/nationalities', 'Maintenance\NationalitiesController');
    Route::apiResource('maintenance/certificates','Maintenance\CertificatesController');
    Route::apiResource('clients', 'Clients\ClientsController');
    Route::apiResource('maintenance/sourcing_practices','Maintenance\SourcingPracticesController');
    Route::apiResource('maintenance/departments', 'Maintenance\DepartmentsController');
    Route::apiResource('maintenance/positions', 'Maintenance\PositionsController');
    Route::apiResource('maintenance/manpowers', 'Maintenance\ManpowersController');
    Route::apiResource('maintenance/statuses', 'Maintenance\StatusesController');
    Route::apiResource('maintenance/saturations','Maintenance\SaturationController');
    Route::apiResource('maintenance/confirmations','Maintenance\ConfirmationController');
    Route::apiResource('clients.calls','Clients\ClientCallController');
    Route::apiResource('clients.saturations','Clients\ClientSaturationController');
    Route::apiResource('clients.presentations','Clients\ClientPresentationController');
    Route::apiResource('clients.acquisitions','Clients\ClientAcquisitionController');
    Route::apiResource('maintenance/mode-of-presentations','Maintenance\PresentationModesController');
    Route::apiResource('maintenance/presentation-statuses', 'Maintenance\PresentationStatusesController');
    Route::apiResource('maintenance/action-plans', 'Maintenance\ActionPlansController');
    Route::apiResource('maintenance/acquisitions', 'Maintenance\AcquisitionsController');
    Route::apiResource('reports/report-months', 'Reports\ReportMonthsController');
    Route::apiResource('reports/target-lists','Reports\TargetListsController');
    
    Route::post('reports/kpi-analysis/export','Reports\KPIAnalysisReportController@export');
    // Route::get('reports/kpi-analysis/export/from_date/{from_date}/to_date/{to_date}','Reports\KPIAnalysisReportController@export');
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
