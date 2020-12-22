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

//Route::get('index','Auth\FirebaseController@index');
Route::view('customers', 'customers');
Route::view('test', 'test');
Route::view('companies','companies_crud');
//Route::view('loginByGoogleEmail','loginByGoogleEmail');

Route::view('loginByGoogleEmail','google/index');
