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

Route::post('login',['as' => 'login', 'uses' =>'Auth\LoginController@login']);

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => 'jwt.auth'], function () {

#user routes..........................................
    Route::get('user',['as' => 'user', 'uses' =>'Auth\LoginController@getUsers']);
    Route::get('user/{id}',['as' => 'loadUser', 'uses' =>'Auth\LoginController@loadUser']);
    Route::post('createUser', ['as' => 'createUser', 'uses' => 'Auth\LoginController@createUser']);
    Route::put('editUser/{id}',['as' => 'editUser', 'uses' =>'Auth\LoginController@editUser']);

//brand routes..........................................
    Route::get('getBrand',['as' => 'getBrand', 'uses' =>'BrandModelController@getBrand']);
    Route::post('createBrand',['as' => 'createBrand', 'uses' =>'BrandModelController@createBrand']);
    Route::put('editBrand/{id}',['as' => 'editBrand', 'uses' =>'BrandModelController@editBrand']);

//models routys..........................................
//    Route::get('getModels',['as' => 'getBrand', 'uses' =>'BrandModelController@getBrand']);
    Route::post('createModels',['as' => 'createModels', 'uses' =>'BrandModelController@createModels']);
//    Route::put('editModels/{id}',['as' => 'editModels', 'uses' =>'BrandModelController@editModels']);
    Route::get('loadModels/{id}',['as' => 'loadModels', 'uses' =>'BrandModelController@loadModels']);

//service & service_type routes...........................
    Route::get('getService',['as' => 'getService', 'uses' =>'ServiceController@getService']);
    Route::post('createService',['as' => 'createService', 'uses' =>'ServiceController@createService']);
    Route::post('createServiceType',['as' => 'createServiceType', 'uses' =>'ServiceController@createServiceType']);
    Route::put('editService/{id}',['as' => 'editService', 'uses' =>'ServiceController@editService']);
    Route::get('loadServiceTypes/{id}',['as' => 'loadServiceTypes', 'uses' =>'ServiceController@loadServiceTypes']);
    Route::get('loadServiceByModels/{id}',['as' => 'loadServiceByModels', 'uses' =>'ServiceController@loadServiceByModels']);
    Route::get('loadServiceByModelsBrand/{brandId}/{modelId}',['as' => 'loadServiceByModelsBrand', 'uses' =>'ServiceController@loadServiceByModelsBrand']);
    Route::get('loadServiceTypesDetails',['as' => 'loadServiceTypesDetails', 'uses' =>'ServiceController@loadServiceTypesDetails']);

//technician routes.......................................
    Route::get('getTechnician',['as' => 'getTechnician', 'uses' =>'TechnicianController@getTechnician']);
    Route::post('createTechnician',['as' => 'createTechnician', 'uses' =>'TechnicianController@createTechnician']);
    Route::put('editTechnician/{id}',['as' => 'editTechnician', 'uses' =>'TechnicianController@editTechnician']);
    Route::get('loadTechnician/{id}',['as' => 'loadTechnician', 'uses' =>'TechnicianController@loadTechnician']);

//vehicle routes.......................................
    Route::get('getVehicle',['as' => 'getVehicle', 'uses' =>'VehicleController@getVehicle']);
    Route::post('createVehicle',['as' => 'createVehicle', 'uses' =>'VehicleController@createVehicle']);
    Route::put('editVehicle/{id}',['as' => 'editVehicle', 'uses' =>'VehicleController@editVehicle']);
    Route::get('loadVehicle/{id}',['as' => 'loadTechnician', 'uses' =>'VehicleController@loadVehicle']);
    Route::get('searchVehicle/{number}',['as' => 'searchVehicle', 'uses' =>'VehicleController@searchVehicle']);

//job card routes

     Route::get('getAllJobCards',['as' => 'getAllJobCards', 'uses' =>'JobCardController@getAllJobCards']);
     Route::get('getUsersJobCards/{id}',['as' => 'getUsersJobCards', 'uses' =>'JobCardController@getUsersJobCards']);
     Route::post('createJobCard',['as' => 'createJobCard', 'uses' =>'JobCardController@createJobCard']);
     Route::get('loadJobCard/{id}',['as' => 'loadJobCard', 'uses' =>'JobCardController@loadJobCard']);
     Route::put('editJobDetails/{id}',['as' => 'editJobDetails', 'uses' =>'JobCardController@editJobDetails']);
     Route::put('completeJobCard/{id}',['as' => 'completeJobCard', 'uses' =>'JobCardController@completeJobCard']);


});
