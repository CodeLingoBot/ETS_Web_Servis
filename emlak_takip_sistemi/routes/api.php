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
Route::group(['prefix' => 'account'], function() {

  Route::post('create', 'UsersController@RegisterService');
  Route::get('login', 'UsersController@LoginService');
});

Route::group(['prefix' => 'sales'], function() {

  Route::get('property_type', 'SalesController@Property_type');
  Route::post('sales_type', 'SalesController@Sales_type');
  Route::post('product_type', 'SalesController@Product_type');
});
