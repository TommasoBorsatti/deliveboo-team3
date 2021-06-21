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

Route::get('/restaurants','Api\SearchCatController@getAll');
Route::get('/restaurants-cat','Api\CategoriesController@getCategories');
Route::get('/restaurant-plates','Api\PlatesController@getPlates');
Route::get('/restaurant/orders','Api\OrdersController@getOrders');
