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







Route::get('hello','HelloController@index');
Route::post('hello','HelloController@store');

Route::get('/hello/add','HelloController@add');
Route::post('hello/add','HelloController@add');

Route::get('hello/key','HelloController@key');

Route::get('hello/sagyou','HelloController@sagyou');

Route::get('hello/seisaku','HelloController@seisaku');

Route::get('hello/edit','HelloController@edit');
Route::post('hello/edit','HelloController@update');

Route::get('hello/del','HelloController@del');
Route::post('hello/del','HelloController@remove');

Route::post('hello/show','HelloController@show');

Route::get('hello/exa','HelloController@exa');

Route::get('hello/ban','HelloController@ban');
Route::post('hello/ban','HelloController@banread');

Route::get('hello/cmmeta','HelloController@cmmeta');
Route::post('hello/cmmeta','HelloController@cmread');
Route::post('hello/cmcreate','HelloController@cmcreate');
Route::post('hello/csvread','HelloController@csvread');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
