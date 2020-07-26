<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware('auth:api')->group(function () {

    $prefix = ['as' => 'admin'];

    Route::resource('products', 'Admin\ProductsController', $prefix)->except(['create', 'edit']);

    Route::resource('categories', 'Admin\CategoriesController', $prefix)->except(['create', 'show', 'edit']);

    Route::resource('/order', 'Admin\OrdersController', $prefix)->only('index');

    Route::resource('/user', 'Admin\UsersController', $prefix)->only('index');

});

Route::middleware('auth:api')->group(function () {

    Route::resource('/cart', 'Front\CartController')->except(['create', 'edit', 'update', 'show']);


    Route::resource('/order', 'Front\OrdersController')->only(['index', 'store']);

    Route::get('/user', 'Front\UserController@edit')->name('user.edit');
    Route::post('/user', 'Front\UserController@update')->name('user.update');

    Route::post('/logout', 'Auth\AuthController@logout');

});

Route::resource('products', 'Front\ProductsController')->only(['index', 'show']);

Route::post('/login', 'Auth\AuthController@login');
Route::post('/register', 'Auth\AuthController@register');

Route::resource('categories', 'Front\CategoriesController')->only('index');
Route::resource('search', 'Front\SearchController')->only('index');

