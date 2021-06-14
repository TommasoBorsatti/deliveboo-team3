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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// Route::get('search/', 'Api\SearchCatController@search')->name('guest.search');

// Area Privata!!

Route::prefix('admin')->name('admin.')->namespace('User')->middleware('auth')->group( function() {
    Route::resource('plate', 'PlateController');
});
