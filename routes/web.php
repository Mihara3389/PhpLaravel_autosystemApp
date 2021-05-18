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
//Index
Route::post('auth/top', 'App\Http\Controllers\Auth\IndexController@postIndex')->name("top");
Route::post('auth/top', function () {return view('auth/history');})->name('history');