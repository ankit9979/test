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


Route::get('categories', 'ProductsController@categoryList');
Route::any('create_category', 'ProductsController@createCategory')->name('create_category');
Route::get('category/{id}', 'ProductsController@getCategory')->name('category_edit')->where('id', '[0-9]+');
Route::any('category_update', 'ProductsController@category_update');
Route::get('category_delete/{id}', 'ProductsController@category_delete')->name('category_delete')->where('id', '[0-9]+');

Route::get('products', 'ProductsController@product_add')->name('product_add');
Route::post('product/store', 'ProductsController@productcreate')->name('product_store');
Route::get('product/{id}', 'ProductsController@getProduct')->name('product_edit')->where('id', '[0-9]+');
Route::post('product/update', 'ProductsController@product_update')->name('product_update');

Route::get('search', 'SearchController@search')->name('search');
Route::any('search_result', 'SearchController@search_result')->name('search_result');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
