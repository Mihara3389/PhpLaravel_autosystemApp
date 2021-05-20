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
Route::get('auth/top/test', 'App\Http\Controllers\Auth\TopController@postIndex')->name("top.test");
Route::get('auth/top/history', 'App\Http\Controllers\Auth\TopController@postIndex')->name("top.history");
Route::post('auth/top/test','App\Http\Controllers\Auth\TestController@postCheck')->name("top.test");
