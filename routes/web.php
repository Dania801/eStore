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

Route::get('/', 'mainController@viewContent');
Route::post('/category', 'mainController@addCategory');
Route::post('/product', 'mainController@addProduct');
Route::post('/customer', 'mainController@addCustomer');
Route::post('/order', 'mainController@addOrder');
Route::post('/category/{id}', 'mainController@updateCategory');
Route::post('/product/{id}', 'mainController@updateProduct');
Route::post('/customer/{id}', 'mainController@updateCustomer');
Route::post('/order/{id}', 'mainController@updateOrder');
Route::get('/category/{id}', 'mainController@deleteCategory');
Route::get('/product/{id}', 'mainController@deleteProduct');
Route::get('/customer/{id}', 'mainController@deleteCustomer');
Route::get('/order/{id}', 'mainController@deleteOrder');
Route::post('/', 'mainController@searchProduct');
Route::post('/product/{id}/comment', 'mainController@commentProduct');
