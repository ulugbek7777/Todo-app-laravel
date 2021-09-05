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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@store');

Route::get('/home/{id}/delete', 'HomeController@delete');
Route::delete('home/{id}/delete', 'HomeController@destroy');

Route::get('home/{id}/edit', 'HomeController@edit');
Route::put('home/{id}/edit', 'HomeController@update');

Route::get('home/{id}/finished', 'HomeController@finished');

Route::get('home/{id}/subtasks', 'SubtaskController@index');
Route::post('/home/{id}/subtask/create', 'SubtaskController@store');

Route::get('/home/{id}/subtask/edit', 'SubtaskController@edit');
Route::put('/home/{id}/subtask/edit', 'SubtaskController@update');

Route::get('/home/{id}/subtask/delete', 'SubtaskController@delete');
Route::delete('/home/{id}/subtask/delete', 'SubtaskController@destroy');

Route::get('home/{id}/subtask/finished', 'SubtaskController@finished');