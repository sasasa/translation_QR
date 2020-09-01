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
Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::resource('items', 'ItemsController');
    Route::resource('genres', 'GenresController');
    Route::post('json/parents/{lang}', 'GenresController@json_parents');
    Route::post('json/genres/{lang}', 'GenresController@json_genres');

    Route::resource('orders', 'OrdersController', ['except'=>['store']]);
    Route::resource('seats', 'SeatsController');
    Route::patch('seats/{seat}/rehash', 'SeatsController@rehash');
    Route::get('qr_code/{seat}', 'SeatsController@qr_code');
    
});

Route::post('{seat_hash}/{lang}/{genre}/json_items', 'ItemsController@json_items');
Route::get('{seat_hash}/{lang}/{genre}/items', 'ItemsController@genre');

Route::post('orders', 'OrdersController@store');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
