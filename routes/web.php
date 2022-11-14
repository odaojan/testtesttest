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

Route::get('/', 'TaskController@create');
Route::post('/', 'TaskController@store')->name('taskStore');
Route::get('/admin', 'AdminController@index');
Route::post('/admin', 'AdminController@TaskDone')->name('taskDone');
