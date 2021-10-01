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

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/home/read', 'HomeController@read')->middleware('auth');
Route::get('/home/read/today', 'HomeController@readToday');
Route::get('/home/read/calendar', 'HomeController@calendar');
Route::get('/home/create', 'HomeController@create');
Route::post('/home', 'HomeController@store');



Route::delete('home/{task}/delete', 'HomeController@destroy');

Route::get('home/{task}/edit', 'HomeController@edit');
Route::put('home/{task}/update', 'HomeController@update');

Route::get('home/{task}/finished', 'HomeController@finished');

Route::get('home/{subtask}/subtasks', 'SubtaskController@index')->name('subtask.index');
Route::post('/home/{subtask}/subtask/create', 'SubtaskController@store');

Route::get('/home/{subtask}/subtask/edit', 'SubtaskController@edit');
Route::get('/home/{subtask}/subtask/update', 'SubtaskController@update');

Route::get('/home/{subtask}/subtask/delete', 'SubtaskController@destroy');

Route::get('home/{subtask}/subtask/finished', 'SubtaskController@finished');


//chapters
Route::get('/home/chapter', 'ChaptersController@index')->name('index.chapter');
Route::post('/home/chapter', 'ChaptersController@store')->name('chapter');

Route::get('/home/chapter/{chapter}/show', 'ChaptersController@show')->name('show.chapter');
Route::get('/home/chapter/{chapter}/edit', 'ChaptersController@edit')->name('edit.chapter');
Route::put('/home/chapter/{chapter}/update', 'ChaptersController@update')->name('update.chapter');

Route::delete('/home/chapter/{chapter}/delete', 'ChaptersController@destroy');