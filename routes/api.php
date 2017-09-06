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

Route::post('v1/login',['as' => 'login', 'uses' =>'Auth\LoginController@login']);
Route::get('v1/getForgetPwd/{email}',['as' => 'getForgetPwd', 'uses' =>'Auth\LoginController@getForgetPwd']);
Route::post('v1/getRestPwdUser/{token}',['as' => 'getRestPwdUser', 'uses' =>'Auth\ResetPasswordController@getRestPwdUser']);

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::group(['middleware' => 'jwt.auth'], function () {

#user routes..........................................
    Route::get('v1/user',['as' => 'user', 'uses' =>'Auth\LoginController@getUsers']);
    Route::get('v1/user/{id}',['as' => 'loadUser', 'uses' =>'Auth\LoginController@loadUser']);
    Route::post('v1/createUser', ['as' => 'createUser', 'uses' => 'Auth\LoginController@createUser']);
    Route::put('v1/editUser/{id}',['as' => 'editUser', 'uses' =>'Auth\LoginController@editUser']);
    Route::put('v1/activeUser/{id}',['as' => 'activeUser', 'uses' =>'Auth\LoginController@activeUser']);


//brand routes..........................................
    Route::get('v1/getBrand',['as' => 'getBrand', 'uses' =>'BrandModelController@getBrand']);
    Route::get('v1/loadBrand/{id}',['as' => 'loadBrand', 'uses' =>'BrandModelController@loadBrand']);
    Route::post('v1/createBrand',['as' => 'createBrand', 'uses' =>'BrandModelController@createBrand']);
    Route::put('v1/editBrand/{id}',['as' => 'editBrand', 'uses' =>'BrandModelController@editBrand']);

//models routes..........................................
//    Route::get('getModels',['as' => 'getBrand', 'uses' =>'BrandModelController@getBrand']);
    Route::post('v1/createModels',['as' => 'createModels', 'uses' =>'BrandModelController@createModels']);
//    Route::put('editModels/{id}',['as' => 'editModels', 'uses' =>'BrandModelController@editModels']);
    Route::get('v1/loadModels',['as' => 'loadModels', 'uses' =>'BrandModelController@loadModels']);

//service & service_type routes...........................
    Route::get('v1/getService',['as' => 'getService', 'uses' =>'ServiceController@getService']);
    Route::get('v1/loadService/{id}',['as' => 'getService', 'uses' =>'ServiceController@loadService']);
    Route::post('v1/createService',['as' => 'createService', 'uses' =>'ServiceController@createService']);
    Route::post('v1/createServiceType',['as' => 'createServiceType', 'uses' =>'ServiceController@createServiceType']);
    Route::put('v1/editService/{id}',['as' => 'editService', 'uses' =>'ServiceController@editService']);
    Route::get('v1/loadServiceTypes/{id}',['as' => 'loadServiceTypes', 'uses' =>'ServiceController@loadServiceTypes']);
    Route::get('v1/loadServiceByModels/{id}',['as' => 'loadServiceByModels', 'uses' =>'ServiceController@loadServiceByModels']);
    Route::get('v1/loadServiceByModelsBrand/{modelId}',['as' => 'loadServiceByModelsBrand', 'uses' =>'ServiceController@loadServiceByModelsBrand']);
    Route::post('v1/loadServiceTypesDetails',['as' => 'loadServiceTypesDetails', 'uses' =>'ServiceController@loadServiceTypesDetails']);
    Route::get('v1/loadEditServiceTypes/{id}',['as' => 'loadEditServiceTypes', 'uses' =>'ServiceController@loadEditServiceTypes']);
    Route::put('v1/editServiceType/{id}',['as' => 'editServiceType', 'uses' =>'ServiceController@editServiceType']);


    //////////////////////////
    Route::post('v1/addPrice',['as' => 'addPrice', 'uses' =>'ServiceController@addPrice']);
    Route::put('v1/addEditPrice/{id}',['as' => 'addEditPrice', 'uses' =>'ServiceController@addEditPrice']);

//technician routes.......................................
    Route::get('v1/getTechnician',['as' => 'getTechnician', 'uses' =>'TechnicianController@getTechnician']);
    Route::post('v1/createTechnician',['as' => 'createTechnician', 'uses' =>'TechnicianController@createTechnician']);
    Route::put('v1/editTechnician/{id}',['as' => 'editTechnician', 'uses' =>'TechnicianController@editTechnician']);
    Route::get('v1/loadTechnician/{id}',['as' => 'loadTechnician', 'uses' =>'TechnicianController@loadTechnician']);
    Route::get('v1/searchTechnician/{name}',['as' => 'searchTechnician', 'uses' =>'TechnicianController@searchTechnician']);
    Route::get('v1/searchTechnicianPaginate/{name}',['as' => 'searchTechnicianPaginate', 'uses' =>'TechnicianController@searchTechnicianPaginate']);

//vehicle routes.......................................
    Route::get('v1/getVehicle',['as' => 'getVehicle', 'uses' =>'VehicleController@getVehicle']);
    Route::post('v1/createVehicle',['as' => 'createVehicle', 'uses' =>'VehicleController@createVehicle']);
    Route::put('v1/editVehicle/{id}',['as' => 'editVehicle', 'uses' =>'VehicleController@editVehicle']);
    Route::get('v1/loadVehicle/{id}',['as' => 'loadTechnician', 'uses' =>'VehicleController@loadVehicle']);
    Route::get('v1/searchVehicle/{number}',['as' => 'searchVehicle', 'uses' =>'VehicleController@searchVehicle']);
    Route::get('v1/searchVehiclePaginate/{number}',['as' => 'searchVehiclePaginate', 'uses' =>'VehicleController@searchVehiclePaginate']);

//job card routes

     Route::get('v1/getAllJobCards',['as' => 'getAllJobCards', 'uses' =>'JobCardController@getAllJobCards']);
     Route::get('v1/getUsersJobCards/{id}',['as' => 'getUsersJobCards', 'uses' =>'JobCardController@getUsersJobCards']);
     Route::post('v1/createJobCard',['as' => 'createJobCard', 'uses' =>'JobCardController@createJobCard']);
     Route::get('v1/loadJobCard/{id}',['as' => 'loadJobCard', 'uses' =>'JobCardController@loadJobCard']);
     Route::put('v1/editJobDetails/{id}',['as' => 'editJobDetails', 'uses' =>'JobCardController@editJobDetails']);
     Route::put('v1/completeJobCard/{id}',['as' => 'completeJobCard', 'uses' =>'JobCardController@completeJobCard']);
     Route::get('v1/getCompleteJobCard',['as' => 'getCompleteJobCard', 'uses' =>'JobCardController@getCompleteJobCard']);
    Route::get('v1/loadJobCardByVehicle/{vehicle_id}',['as' => 'loadJobCardByVehicle', 'uses' =>'JobCardController@loadJobCardByVehicle']);
    Route::get('v1/searchJobCard/{no}',['as' => 'searchJobCard', 'uses' =>'JobCardController@searchJobCard']);
    Route::post('v1/createJobCardByWeb',['as' => 'createJobCardByWeb', 'uses' =>'JobCardController@createJobCardByWeb']);


    //service material.................

    Route::get('v1/getMaterial',['as' => 'getMaterial', 'uses' =>'ServiceMaterialController@getMaterial']);
    Route::post('v1/addServiceMaterial',['as' => 'addServiceMaterial', 'uses' =>'ServiceMaterialController@addServiceMaterial']);
    Route::get('v1/loadServiceMaterial/{id}',['as' => 'addServiceMaterial', 'uses' =>'ServiceMaterialController@loadServiceMaterial']);
    Route::put('v1/editServiceMaterial/{id}',['as' => 'editServiceMaterial', 'uses' =>'ServiceMaterialController@editServiceMaterial']);
    Route::get('v1/searchServiceMaterial/{name}',['as' => 'searchServiceMaterial', 'uses' =>'ServiceMaterialController@searchServiceMaterial']);
    Route::get('v1/searchServiceMaterialByCode/{code}',['as' => 'searchServiceMaterialByCode', 'uses' =>'ServiceMaterialController@searchServiceMaterialByCode']);


    Route::get('v1/searchServiceMaterialWeb/{name}',['as' => 'searchServiceMaterialWeb', 'uses' =>'ServiceMaterialController@searchServiceMaterialWeb']);
    Route::get('v1/getMaterialWeb',['as' => 'getMaterialWeb', 'uses' =>'ServiceMaterialController@getMaterialWeb']);


    //invoice....................

    Route::get('v1/getAllInvoice',['as' => 'getAllInvoice', 'uses' =>'InvoiceController@getAllInvoice']);
    Route::get('v1/loadInvoiceById/{id}',['as' => 'loadInvoiceById', 'uses' =>'InvoiceController@loadInvoiceById']);
    Route::post('v1/createInvoice',['as' => 'createInvoice', 'uses' =>'InvoiceController@createInvoice']);
    Route::get('v1/searchInvoice/{no}',['as' => 'searchInvoice', 'uses' =>'InvoiceController@searchInvoice']);

    //Grn.........................

    Route::get('v1/getGrn',['as' => 'getGrn', 'uses' =>'GrnController@getGrn']);
    Route::post('v1/createGrn',['as' => 'createGrn', 'uses' =>'GrnController@createGrn']);
    Route::get('v1/getGrnDetail/{id}',['as' => 'getGrnDetail', 'uses' =>'GrnController@getGrnDetail']);

    //supplier............

    Route::get('v1/getSupplier',['as' => 'getSupplier', 'uses' =>'SupplierController@getSupplier']);
    Route::post('v1/createSupplier',['as' => 'createSupplier', 'uses' =>'SupplierController@createSupplier']);
    Route::get('v1/loadSupplier/{id}',['as' => 'loadSupplier', 'uses' =>'SupplierController@loadSupplier']);
    Route::put('v1/editSupplier/{id}',['as' => 'editSupplier', 'uses' =>'SupplierController@editSupplier']);
    Route::get('v1/searchSupplier/{name}',['as' => 'searchSupplier', 'uses' =>'SupplierController@searchSupplier']);
    Route::get('v1/searchSupplierPaginate/{name}',['as' => 'searchSupplierPaginate', 'uses' =>'SupplierController@searchSupplierPaginate']);

    //current stock...........


    Route::get('v1/getStock',['as' => 'getStock', 'uses' =>'StockController@getStock']);
    Route::get('v1/getAllStock',['as' => 'getAllStock', 'uses' =>'StockController@getAllStock']);
    Route::get('v1/getLowStock',['as' => 'getStock', 'uses' =>'StockController@getLowStock']);
    Route::get('v1/searchStock/{name}',['as' => 'searchStock', 'uses' =>'StockController@searchStock']);
    Route::get('v1/searchLowStock/{name}',['as' => 'searchLowStock', 'uses' =>'StockController@searchLowStock']);
    Route::get('v1/getItemStock',['as' => 'getItemStock', 'uses' =>'StockController@getItemStock']);
    Route::get('v1/getItemStockSearch/{name}',['as' => 'searchStock', 'uses' =>'StockController@getItemStockSearch']);


    //dashboard .............
    Route::get('v1/totalServiceIncome',['as' => 'totalServiceIncome', 'uses' =>'ServiceController@totalServiceIncome']);
    Route::get('v1/getJobCardCount',['as' => 'getJobCardCount', 'uses' =>'DashBoardController@getJobCardCount']);

    //agent routes...............

    Route::get('v1/getAgent',['as' => 'getAgent', 'uses' =>'AgentController@getAgent']);
    Route::post('v1/createAgent',['as' => 'createAgent', 'uses' =>'AgentController@createAgent']);
    Route::get('v1/loadAgent/{id}',['as' => 'loadAgent', 'uses' =>'AgentController@loadAgent']);
    Route::put('v1/editAgent/{id}',['as' => 'editAgent', 'uses' =>'AgentController@editAgent']);
    Route::get('v1/searchAgent/{name}',['as' => 'searchAgent', 'uses' =>'AgentController@searchAgent']);
    Route::get('v1/searchAgentPaginate/{name}',['as' => 'searchAgentPaginate', 'uses' =>'AgentController@searchAgentPaginate']);

//    report routes............

    Route::get('v1/getAgentDueAmount',['as' => 'getAgentDueAmount', 'uses' =>'ReportController@getAgentDueAmount']);
    Route::get('v1/sales',['as' => 'sales', 'uses' =>'ReportController@sales']);
    Route::get('v1/dayEndSummary',['as' => 'dayEndSummary', 'uses' =>'ReportController@dayEndSummary']);
    Route::get('v1/customerHistory',['as' => 'customerHistory', 'uses' =>'ReportController@customerHistory']);



    //warranty routes................

    Route::get('v1/getWarranty',['as' => 'getWarranty', 'uses' =>'WarrantyController@getWarranty']);
    Route::post('v1/createWarranty',['as' => 'createWarranty', 'uses' =>'WarrantyController@createWarranty']);
    Route::get('v1/searchByVehicle/{id}',['as' => 'searchByVehicle', 'uses' =>'WarrantyController@searchByVehicle']);
    Route::get('v1/searchWarrantyVehicle/{id}',['as' => 'searchWarrantyVehicle', 'uses' =>'WarrantyController@searchWarrantyVehicle']);

});
