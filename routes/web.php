<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Country Routes
Route::patch('countries/{country}/restore', 'CountryController@restore')->name('countries.restore');
Route::delete('countries/{country}/force-delete', 'CountryController@forceDelete')->name('countries.force-delete');
Route::get('countries/trashed', 'CountryController@viewTrashed')->name('countries.trashed');

Route::resource('countries', 'CountryController');
