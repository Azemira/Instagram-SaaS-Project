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

Route::group(['as'=>'client','middleware' => 'verified-user'] , function (){
    
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/email-verify', 'UserController@verify')->name('verify');
});

Route::group(['prefix' => 'admin', 'middleware' => 'admin'] , function (){
   
    Route::get('/dashboard', 'HomeController@adminDashboard')->name('admin-dashboard');

    // User Routes 
    Route::get('/users', 'UserController@getAllUsers')->name('users-list');
    Route::get('/users/create', 'UserController@createUserPage')->name('create-user');
    Route::post('/user/store', ['uses' => 'UserController@store', 'as' => 'user.store']);


});
Route::get('/404', function () {
    return view('errors.404');
});