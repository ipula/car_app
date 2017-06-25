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


    Route::get('getBrand',['as' => 'getBrand', 'uses' =>'BrandModelController@getBrand']);
    Route::post('createBrand',['as' => 'createBrand', 'uses' =>'BrandModelController@createBrand']);
    Route::put('editBrand/{id}',['as' => 'editBrand', 'uses' =>'BrandModelController@editBrand']);


    Route::get('getModels',['as' => 'getBrand', 'uses' =>'BrandModelController@getBrand']);
    Route::post('createModels',['as' => 'createModels', 'uses' =>'BrandModelController@createModels']);
    Route::put('editModels/{id}',['as' => 'editModels', 'uses' =>'BrandModelController@editModels']);


});
