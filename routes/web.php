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

//Login
Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

//Top
Route::get('auth/top', 'App\Http\Controllers\Auth\TopController@index')->name("top");
Route::post('auth/top','App\Http\Controllers\Auth\TopController@postIndex')->name("top");
//Top.xxx
Route::get('auth/top/list', 'App\Http\Controllers\Auth\TopController@postIndex')->name("top.list");
Route::get('auth/top/test', 'App\Http\Controllers\Auth\TopController@postIndex')->name("top.test");
Route::get('auth/top/history', 'App\Http\Controllers\Auth\TopController@postIndex')->name("top.history");
//List
Route::post('auth/top/list','App\Http\Controllers\Auth\ListController@postList')->name("top.list");
//List.xxx
Route::get('auth/top/list/register', 'App\Http\Controllers\Auth\ListController@postList')->name("list.register");
Route::get('auth/top/list/edit', 'App\Http\Controllers\Auth\ListController@postList')->name("list.edit");
Route::get('auth/top/list/delete', 'App\Http\Controllers\Auth\ListController@postList')->name("list.delete");
//Register
Route::post('auth/top/list/register', 'App\Http\Controllers\Auth\RegisterNewController@postRegister')->name("list.register");
Route::get('auth/top/list/confirm/register', 'App\Http\Controllers\Auth\RegisterNewController@postRegister')->name("confirm.register");
Route::post('auth/top/list/confirm/register', 'App\Http\Controllers\Auth\RegisterNewController@postRegister')->name("confirm.register");
//Delete
Route::post('auth/top/list/delete', 'App\Http\Controllers\Auth\DeleteController@postDelete')->name("list.delete");
//Test
Route::post('auth/top/test','App\Http\Controllers\Auth\TestController@postCheck')->name("top.test");