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
Route::group(['middleware' => ['auth']], function () {
    Route::resource('items', 'ItemsController');
    Route::resource('genres', 'GenresController');
    Route::post('json/parents/{lang}', 'GenresController@json_parents');
    Route::post('json/genres/{lang}', 'GenresController@json_genres');
});

Route::get('{lang}/{genre}/items', 'ItemsController@genre');
Route::get('{lang}/{genre}/json_items', 'ItemsController@json_items');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
