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

Route::get('/welcome', function () {
    // return redirect('/restaurants');
    return view('welcome');
})->name('root');

Route::get('/', function () {
    // return redirect('/restaurants');
    $myTitle = 'Homepage';
    return view('temp', compact('myTitle'));
})->name('root');

// Restaurant CRUD routes
Route::resource('/restaurants','RestaurantController');

// Restaurant Review CRUD routes
Route::resource('restaurants.reviews', 'ReviewController',['except' => ['index','show']]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/account',function(){
    $myTitle = 'My Account';
    return view('temp', compact('myTitle'));
})->name('account');

//About links
Route::get('/about',function(){
    $myTitle = 'About';
    return view('temp', compact('myTitle'));
})->name('about');

Route::get('/about/history',function(){
    $myTitle = 'Company History';
    return view('temp', compact('myTitle'));
})->name('about.history');

Route::get('/about/team',function(){
    $myTitle = 'The Team';
    return view('temp', compact('myTitle'));
})->name('about.team');


//Support links
Route::get('/support',function(){
     $myTitle = 'Support';
     return view('temp', compact('myTitle'));
})->name('support');

Route::get('/support/contact',function(){
     $myTitle = 'Contact';
     return view('temp', compact('myTitle'));
})->name('support.contact');

Route::get('/support/faqs',function(){
     $myTitle = 'FAQs';
     return view('temp', compact('myTitle'));
})->name('support.faqs');


//Legal links
Route::get('/legal',function(){
    $myTitle = 'Legal';
    return view('temp', compact('myTitle'));
})->name('legal');

Route::get('/legal/terms',function(){
     $myTitle = 'Terms & Conditions';
     return view('temp', compact('myTitle'));
})->name('legal.terms');

Route::get('/legal/privacy',function(){
     $myTitle = 'Privacy Policy';
     return view('temp', compact('myTitle'));
})->name('legal.privacy');

Route::get('/legal/cookie',function(){
     $myTitle = 'Cookie Policy';
     return view('temp', compact('myTitle'));
})->name('legal.cookie');