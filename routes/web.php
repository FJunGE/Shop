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
    return view('welcome');
});

Route::get('/test', function (){
    return "Hello Docker";	
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/root', 'PageController@root')->name('home.root');
Route::get('/paypal', 'PaypalController@index')->name('paypal.index');
Route::post('paypal', 'PaypalController@payment')->name('paypal.payment');

