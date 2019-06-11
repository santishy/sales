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


Route::resource('products','ProductController');
Route::get('last-ten-products','ProductController@lastTenProducts');
Auth::routes();
Route::get('/', 'HomeController@index')->name('dashboard');
Route::get('sales/products-count','SaleController@productsCount');
Route::resource('sales','SaleController');
Route::resource('product_sale','ProductSaleController')->middleware('sale');
