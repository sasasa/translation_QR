<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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

// editting
Route::group(['middleware' => ['auth', 'verified', 'can:editting']], function () {
    Route::resource('items', 'ItemsController');
    Route::get('items/create_by_key/{item}', 'ItemsController@create_by_key');
    Route::post('items/create_by_key/{item}', 'ItemsController@store_by_key');
    Route::patch('items/out_of_stock/{item}', 'ItemsController@out_of_stock');

    Route::resource('allergens', 'AllergensController');
    Route::post('allergens/{allergen}/store_by_key', 'AllergensController@store_by_key');

    Route::resource('genres', 'GenresController');
    Route::post('genres/{genre}/store_by_key', 'GenresController@store_by_key');

    Route::post('json/parents/{lang}', 'GenresController@json_parents');
    Route::post('json/genres/{lang}', 'GenresController@json_genres');

    Route::resource('seats', 'SeatsController');
    Route::patch('seats/{seat}/rehash', 'SeatsController@rehash');
    Route::get('seats/{seat}/print', 'SeatsController@print');

    Route::get('qr_code/{seat}', 'SeatsController@qr_code');

    Route::resource('users', 'UsersController');
    Route::get('users/{user}/edit_pass', 'UsersController@edit_pass');
    Route::patch('users/{user}/update_pass', 'UsersController@update_pass');
});

// browsing
Route::group(['middleware' => ['auth', 'verified', 'can:browsing']], function () {
    Route::resource('payments', 'PaymentsController');
    Route::resource('api/payments', 'PaymentsController');

    Route::resource('orders', 'OrdersController', ['except'=>['store']]);
    Route::resource('api/orders', 'OrdersController', ['except'=>['store']]);
    Route::get('aggregate', 'OrdersController@aggregate');

    Route::post('api/json_orders', 'OrdersController@json_orders');
    Route::patch('api/orders/{order}/takeout', 'OrdersController@takeout');
    Route::get('print/{seatSession}', 'OrdersController@print');

    Route::get('sum_total', 'PaymentsController@sum_total');
});

Route::post('api/json_items', 'ItemsController@json_items');
Route::post('api/item_ids', 'ItemsController@item_ids');
Route::get('{seat_hash}/items', 'ItemsController@items');

Route::post('api/json_payment', 'OrdersController@json_payment');
Route::post('api/json_ordered_orders', 'OrdersController@json_ordered_orders');
Route::post('api/orders', 'OrdersController@store');
Route::post('api/pay', 'OrdersController@pay');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
