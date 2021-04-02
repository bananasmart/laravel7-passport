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

Route::post('register', 'RegisterController@register');
Route::post('login', 'RegisterController@login');
   
Route::middleware('auth:api')->group( function () {
    Route::prefix('customer')->group(function(){
        Route::get('getCustomers/{customerid?}', 'CustomersController@getCustomers');
        Route::post('createNewCustomer', 'CustomersController@createCustomer');
        Route::put('updateCustomer', 'CustomersController@updateCustomer');
        Route::delete('deleteCustomer/{customerid}', 'CustomersController@deleteCustomer');
    });

    Route::prefix('sale')->group(function(){
        Route::get('getSales/{invoicenumber?}', 'SalesController@getSales');
        Route::get('getSalesCustomer/{invoicenumber}', 'SalesController@getSalesCustomer');
    });

});
