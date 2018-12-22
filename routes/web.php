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

Route::get('/', function () {
    return redirect('/restaurants');
});
// Restaurant CRUD routes
Route::resource('/restaurants','RestaurantController');

// Restaurant Review CRUD routes
Route::resource('restaurants.reviews', 'ReviewController',['except' => ['index','show']]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
