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



Auth::routes();
Route::get('/', 'UserController@front_page')->name('welcome');
Route::get('/home', 'HomeController@index')->name('home');
    Route::prefix('front')->group(function(){
        Route::post('{id}', 'UserController@showFunctions')->name('all-functions');
    });


