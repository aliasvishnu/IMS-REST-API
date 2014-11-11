<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('api/product/id/{id}', array("uses" => "ProductController@getProductInfoByID"));
Route::delete('api/product/id/{id}', array("uses" => "ProductController@deleteProductByID"));

Route::get('api/seller/id/{id}', array("uses" => "SellerController@getSellerInfoByID"));
Route::delete('api/seller/id/{id}', array("uses" => "SellerController@deleteSellerByID"));

