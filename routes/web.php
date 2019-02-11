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


//myself routes for working on vuejs
Route::get('vuejs','VueController@index')->name('index');

//delte user
Route::get('delete/{id}','VueController@delete');

//update or edit user
Route::post('update','VueController@update');

//search user
Route::get('search/{text}','VueController@search');


Route::post('getinfo','VueController@update')->name('form');
Route::get('form',function(){
    return view('form');
});


