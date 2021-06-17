<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('guest.index'); 
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Area pubblica
Route::get('/restaurants', 'Guest\GuestController@searchCat')->name('search');
Route::get('restaurant/{id}', 'Guest\GuestController@show')->name('restaurant.show');
Route::get('restaurant/{id}/checkout', 'Guest\OrderController@checkout')->name('restaurant.checkout');
Route::post('restaurant/checkout', 'Guest\OrderController@checkoutStore')->name('restaurant.checkout.store');

// Area Privata!!

Route::prefix('admin')->name('admin.')->namespace('User')->middleware('auth')->group( function() {
    Route::resource('plate', 'PlateController');
});
