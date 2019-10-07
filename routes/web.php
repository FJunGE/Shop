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

Auth::routes(['verify'=>true]);

Route::get('/', 'PageController@root')->name('home')->middleware('verified');
Route::redirect('/', '/products')->name('root');
Route::get('/products', 'ProductsController@index')->name('products.index');
Route::group(['middleware'=>['auth','verified']], function () {
    Route::get('user_addresses', 'UserAddressesController@index')->name('user_addresses.index');
    Route::get('user_addresses/create', 'UserAddressesController@create')->name('user_addresses.create');
    Route::post('user_addresses', 'UserAddressesController@store')->name('user_addresses.store');
    Route::get('user_addresses/{user_address}','UserAddressesController@edit')->name('user_addresses.edit');
    Route::put('user_addresses/{user_address}', 'UserAddressesController@update')->name('user_addresses.update');
    Route::delete('user_addresses/{user_address}', 'UserAddressesController@destroy')->name('user_addresses.destroy');

    // product 产品
    Route::post('/products/{product}/favor', 'ProductsController@favor')->name('products.favor');
    Route::delete('/products/{product}/disfavor', 'ProductsController@disfavor')->name('products.disfavor');
    Route::get('/products/favorites', 'ProductsController@favorites')->name('products.favorites');
    Route::get('/products/{product}', 'ProductsController@show')->name('products.show');

    // cart 购物车
    Route::post('cart', 'CartController@add')->name('cart.add');
    Route::get('cart', 'CartController@index')->name('cart.index');
    Route::delete('cart/{sku}', 'CartController@remove')->name('cart.remove');

    // order 订单
    Route::post('order', 'OrdersController@store')->name('orders.store');
    Route::get('order', 'OrdersController@index')->name('orders.index');
    Route::get('order/{order}', 'OrdersController@show')->name('orders.show');
});