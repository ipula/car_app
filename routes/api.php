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
    Route::get('loadModels',['as' => 'loadModels', 'uses' =>'BrandModelController@loadModels']);

//service & service_type routes...........................
    Route::get('getService',['as' => 'getService', 'uses' =>'ServiceController@getService']);
    Route::get('loadService/{id}',['as' => 'getService', 'uses' =>'ServiceController@loadService']);
    Route::post('createService',['as' => 'createService', 'uses' =>'ServiceController@createService']);
    Route::post('createServiceType',['as' => 'createServiceType', 'uses' =>'ServiceController@createServiceType']);
    Route::put('editService/{id}',['as' => 'editService', 'uses' =>'ServiceController@editService']);
    Route::get('loadServiceTypes/{id}',['as' => 'loadServiceTypes', 'uses' =>'ServiceController@loadServiceTypes']);
    Route::get('loadServiceByModels/{id}',['as' => 'loadServiceByModels', 'uses' =>'ServiceController@loadServiceByModels']);
    Route::get('loadServiceByModelsBrand/{modelId}',['as' => 'loadServiceByModelsBrand', 'uses' =>'ServiceController@loadServiceByModelsBrand']);
    Route::post('loadServiceTypesDetails',['as' => 'loadServiceTypesDetails', 'uses' =>'ServiceController@loadServiceTypesDetails']);
    Route::get('loadEditServiceTypes/{id}',['as' => 'loadEditServiceTypes', 'uses' =>'ServiceController@loadEditServiceTypes']);
    Route::put('editServiceType/{id}',['as' => 'editServiceType', 'uses' =>'ServiceController@editServiceType']);


    //////////////////////////
    Route::post('addPrice',['as' => 'addPrice', 'uses' =>'ServiceController@addPrice']);
    Route::put('addEditPrice/{id}',['as' => 'addEditPrice', 'uses' =>'ServiceController@addEditPrice']);

//technician routes.......................................
    Route::get('getTechnician',['as' => 'getTechnician', 'uses' =>'TechnicianController@getTechnician']);
    Route::post('createTechnician',['as' => 'createTechnician', 'uses' =>'TechnicianController@createTechnician']);
    Route::put('editTechnician/{id}',['as' => 'editTechnician', 'uses' =>'TechnicianController@editTechnician']);
    Route::get('loadTechnician/{id}',['as' => 'loadTechnician', 'uses' =>'TechnicianController@loadTechnician']);
    Route::get('searchTechnician/{name}',['as' => 'searchTechnician', 'uses' =>'TechnicianController@searchTechnician']);

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
     Route::get('getCompleteJobCard',['as' => 'getCompleteJobCard', 'uses' =>'JobCardController@getCompleteJobCard']);
    Route::get('loadJobCardByVehicle/{vehicle_id}',['as' => 'loadJobCardByVehicle', 'uses' =>'JobCardController@loadJobCardByVehicle']);


    //service material.................

    Route::get('getMaterial',['as' => 'getMaterial', 'uses' =>'ServiceMaterialController@getMaterial']);
    Route::post('addServiceMaterial',['as' => 'addServiceMaterial', 'uses' =>'ServiceMaterialController@addServiceMaterial']);
    Route::get('loadServiceMaterial/{id}',['as' => 'addServiceMaterial', 'uses' =>'ServiceMaterialController@loadServiceMaterial']);
    Route::put('editServiceMaterial/{id}',['as' => 'editServiceMaterial', 'uses' =>'ServiceMaterialController@editServiceMaterial']);
    Route::get('searchServiceMaterial/{name}',['as' => 'searchServiceMaterial', 'uses' =>'ServiceMaterialController@searchServiceMaterial']);

    //invoice....................

    Route::get('getAllInvoice',['as' => 'getAllInvoice', 'uses' =>'InvoiceController@getAllInvoice']);
    Route::get('loadInvoiceById/{id}',['as' => 'loadInvoiceById', 'uses' =>'InvoiceController@loadInvoiceById']);
    Route::post('createInvoice',['as' => 'createInvoice', 'uses' =>'InvoiceController@createInvoice']);

    //Grn.........................

    Route::get('getGrn',['as' => 'getGrn', 'uses' =>'GrnController@getGrn']);
    Route::post('createGrn',['as' => 'createGrn', 'uses' =>'GrnController@createGrn']);
    Route::get('getGrnDetail/{id}',['as' => 'getGrnDetail', 'uses' =>'GrnController@getGrnDetail']);



});
