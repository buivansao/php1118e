<?php

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
Auth::routes();

Route::get('customer/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('customer.password.request');
Route::post('customer/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('customer.password.email');
Route::get('customer/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('customer.password.reset');
Route::post('customer/password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['namespace' => 'Website'], function () {

    Route::group(['middleware' => 'CheckCustomerLogedIn'], function() {
        Route::post('/order', 'CustomerController@customerPlaceOrder')->name('order.place');
    });

    Route::get('customer/login', 'CustomerController@login')->name('customer.login.index');
    Route::post('customer/login', 'CustomerController@customerLogin')->name('customer.login');
    Route::get('customer/logout', 'CustomerController@logout')->name('customer.logout');
    Route::get('customer/register', 'CustomerController@register')->name('customer.register');
    Route::post('customer/register', 'CustomerController@customerRegister')->name('customer.register');

    Route::get('account', 'CustomerController@edit');
    Route::post('account', 'CustomerController@update');
    Route::get('order/history', 'CustomerController@order');
    Route::get('order/history/detail/{id}', 'CustomerController@orderDetail');

    Route::post('/order', 'CustomerController@customerOder')->name('order.place');
    Route::get('/cart', 'CartController@index')->name('cart.index');
    Route::get('/cart/{id}/add', 'CartController@addItem')->name('cart.add');
    Route::post('/cart/update', 'CartController@updateItem')->name('cart.update');
    Route::post('/cart/delete', 'CartController@deleteItem')->name('cart.delete');
    Route::post('/cart/delete', 'CartController@deleteItem')->name('cart.delete');

    Route::get('/', 'PageController@index');
    Route::get('new', 'PageController@newList');
    Route::get('new/{slug}', 'PageController@newDetail');
    Route::get('{slug}', 'PageController@show');
    Route::post('/customers/comment/{slug}', 'PageController@postComment')->name('customers.comment');
    Route::get('detail/{slug}', 'PageController@getDetail');
    Route::post('detail/{slug}', 'PageController@postComment');
    Route::get('detail/{id}/hidden', 'PageController@hidden');

});

Route::group(['namespace' => 'Admin'], function () {
    Route::group(['prefix' => 'login', 'middleware' => 'CheckLogedIn'], function () {
        Route::get('/', 'LoginController@getLogin');
        Route::post('/', 'LoginController@postLogin');
    });

    Route::group(['prefix' => 'admin', 'middleware' => 'CheckLogedOut'], function () {
        Route::post('/upload', 'TinyMCEController@store');

        Route::get('home', 'HomeController@getHome');

        Route::group(['prefix' => 'customer'], function () {
            Route::get('/', 'CustomerController@list');
            Route::post('{customer}/disable', 'CustomerController@disable');
            Route::post('{customer}/enable', 'CustomerController@enable');
        });

        Route::group(['prefix' => 'category'], function () {
            Route::get('/', 'CategoryController@list');
            Route::get('/add', 'CategoryController@create');
            Route::post('/add', 'CategoryController@store');
            Route::get('{id}/edit', 'CategoryController@edit');
            Route::post('{id}/edit', 'CategoryController@update');
            Route::get('{id}/delete', 'CategoryController@destroy');
        });

        Route::group(['prefix' => 'brand'], function () {
            Route::get('/', 'BrandController@list');
            Route::get('/add', 'BrandController@create');
            Route::post('/add', 'BrandController@store');
            Route::get('{id}/edit', 'BrandController@edit');
            Route::post('{id}/edit', 'BrandController@update');
            Route::get('{id}/delete', 'BrandController@destroy');
        });

        Route::group(['prefix' => 'product'], function () {
            Route::get('/', 'ProductController@list');
            Route::get('/add', 'ProductController@create');
            Route::post('/add', 'ProductController@store');
            Route::get('{id}/edit', 'ProductController@edit');
            Route::post('{id}/edit', 'ProductController@update');
            Route::get('{id}/{delete}', 'ProductController@destroy');
        });

        Route::group(['prefix' => 'customer'], function () {
            Route::get('/', 'CustomerController@list');
            Route::get('{id}/edit', 'CustomerController@edit');
            Route::post('{id}/edit', 'CustomerController@update');
            Route::get('{id}/delete', 'CustomerController@destroy');
        });

        Route::group(['prefix' => 'order'], function () {
            Route::get('/', 'OrderController@list');
            Route::get('{id}/detail', 'OrderController@detail');
            Route::get('/{id}/update', 'OrderController@edit');
            Route::post('/{id}/update', 'OrderController@update');
        });

        Route::group(['prefix' => 'account'], function () {
            Route::get('/', 'UserController@list');
            Route::get('/add', 'UserController@create');
            Route::post('/add', 'UserController@store');
            Route::post('{user}/disable', 'UserController@disable');
            Route::post('{user}/enable', 'UserController@enable');
        });

        Route::group(['prefix' => 'new'], function () {
            Route::get('/', 'NewController@list');
            Route::get('/add', 'NewController@create');
            Route::post('/add', 'NewController@store');
            Route::get('{id}/edit', 'NewController@edit');
            Route::post('{id}/edit', 'NewController@update');
            Route::get('{id}/delete', 'NewController@destroy');
        });
    });
});
