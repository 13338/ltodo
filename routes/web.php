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

Route::get('/', 'TaskController@index')->name('home');

Auth::routes();

Route::resource('tasks', 'TaskController')->except(['create', 'edit']);
Route::resource('subTasks', 'SubTaskController')->only(['store', 'update', 'destroy']);
