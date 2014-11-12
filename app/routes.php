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

/* Product */
Route::get('api/product/{id}', array("uses" => "ProductController@getProductInfoByID"));
Route::delete('api/product/{id}', array("uses" => "ProductController@deleteProductByID"));
Route::post('api/product/{name}', array("uses" => "ProductController@postProductByName"));
Route::put('api/product/{id}', array("uses" => "ProductController@putProductByID"));

Route::get('api/product', array("uses" => "ProductController@getProductList"));

/* Seller */
Route::get('api/seller/{id}', array("uses" => "SellerController@getSellerInfoByID"));
Route::delete('api/seller/{id}', array("uses" => "SellerController@deleteSellerByID"));
Route::post('api/seller/{name}', array("uses" => "SellerController@postSellerByName"));
Route::put('api/seller/{id}', array("uses" => "SellerController@putSellerByID"));

Route::get('api/seller', array("uses" => "SellerController@getSellerList"));

/* Product-Seller Relationship */
Route::get('api/getsellersof/{id}', array("uses" => "ProductController@getSellersOfProductID"));
Route::get('api/getproductsof/{id}', array("uses" => "SellerController@getProductsOfSellerID"));

