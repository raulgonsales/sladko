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

Route::get('/', 'MainController@index')->name('main');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/product/{id}', 'ProductController@index')->name('product')->where('id', '[0-9]+');
Route::get('/category/{id}', 'CategoryController@index')->name('category')->where('id', '[0-9]+');
Route::get('/cart', 'CartController@index')->name('cart');

Route::group(['prefix' => 'ajax'], function () {
    Route::post('/loadReviews', 'AjaxReviewsController@loadReviews');
    Route::post('/cart/add', 'AjaxCartController@addProduct')->name('cart.add');
    Route::post('/cart/delete', 'AjaxCartController@deleteProduct')->name('cart.delete');
    Route::post('/cart/change', 'AjaxCartController@changeProductQuantity')->name('cart.change');
    Route::post('/cart/delete-row', 'AjaxCartController@deleteProductRow')->name('cart.delete-row');
    Route::post('/cart/set-delivery', 'AjaxCartController@setDeliveryMethod');
    Route::post('/cart/loadCartBlock', 'AjaxCartController@loadCartBlock')->name('cart.loadProducts');
});
