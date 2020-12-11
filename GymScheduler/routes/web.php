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

Auth::routes([
    'register' => false
]);
Route::get('/purposes','PurposeController@all');
Route::post('/schedule/add','ScheduleController@store');
Route::delete('/schedule/{id}','ScheduleController@delete');
Route::get('/schedule/{user_id}','ScheduleController@getByUser');
Route::get('/schedule/edit/{id}','ScheduleController@getById');
Route::post('/schedule/edit/{id}','ScheduleController@update');
Route::get('/home', 'HomeController@index')->name('home');
