<?php

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

Auth::routes(['verify' => true]);


Route::get('logout', 'Auth\LoginController@logout');

Route::group(['middleware' => 'verified-user'] , function (){
    Route::get('/home', 'HomeController@index')->name('home');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'] , function (){
   
    Route::get('/dashboard', 'HomeController@adminDashboard');
});
