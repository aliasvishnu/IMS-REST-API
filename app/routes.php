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


Route::get('/', function(){
	$theLandmarks = array('St. Marks', 'Brooklyn Heights', 'Central Park', 'Times Square');
	return View::make('hello', array('theLocation' => 'NYC', 'theWeather' => 'Stormy', 'theLandmarks' => $theLandmarks));
});

Route::get('about', function(){
	return 'About Content goes here';
});

Route::get('about/directions', function(){
	return 'Directions go here';
});

Route::get('about/{theSubject}', function($theSubject){
	return $theSubject.' goes here';
});

Route::get('about/classes/{theSubject}', function($theSubject){
	return "Content about {$theSubject} classes goes here";
});

Route::get('signup', function(){	
	return View::make('signup');
});

Route::post('thanks', function(){
	$theEmail = Input::get('email');
	return View::make('thanks')->with('theEmail', $theEmail);
});


/* Product */
Route::get('api/product/{id}/{apikey}', array("before" => "apikeypermissions:1", "uses" => "ProductController@getProductInfoByID"));
Route::delete('api/product/{id}/{apikey}', array("before" => "apikeypermissions:2", "uses" => "ProductController@deleteProductByID"));
Route::post('api/product/{name}/{apikey}', array("before" => "apikeypermissions:2", "uses" => "ProductController@postProductByName"));
Route::put('api/product/{id}/{apikey}', array("before" => "apikeypermissions:2", "uses" => "ProductController@putProductByID"));

Route::get('api/product/{apikey}', array("before" => "apikeypermissions:1", "uses" => "ProductController@getProductList"));

/* Seller */
Route::get('api/seller/{id}/{apikey}', array("before" => "apikeypermissions:1", "uses" => "SellerController@getSellerInfoByID"));
Route::delete('api/seller/{id}/{apikey}', array("before" => "apikeypermissions:3", "uses" => "SellerController@deleteSellerByID"));
Route::post('api/seller/{name}/{apikey}', array("before" => "apikeypermissions:2", "uses" => "SellerController@postSellerByName"));
Route::put('api/seller/{id}/{apikey}', array("before" => "apikeypermissions:2", "uses" => "SellerController@putSellerByID"));

Route::get('api/seller/{apikey}', array("before" => "apikeypermissions:1", "uses" => "SellerController@getSellerList"));

/* Product-Seller Relationship */
Route::get('api/getsellersof/{id}/{apikey}', array("before" => "apikeypermissions:1", "uses" => "ProductSellerController@getSellersOfProductID"));
Route::get('api/getproductsof/{id}/{apikey}', array("before" => "apikeypermissions:1", "uses" => "ProductSellerController@getProductsOfSellerID"));
Route::post('api/updateProduct/{apikey}', array("before" => "apikeypermissions:2", "uses" => "ProductSellerController@addUpdateProduct")); 
Route::post('api/reduceProductCount/{apikey}/{productid}/{sellerid}', array("before" => "apikeypermissions:2", "uses" => "ProductSellerController@reduceProductCount"));
Route::post('api/removeProduct/{apikey}', array("before" => "apikeypermissions:2", "uses" => "ProductSellerController@removeProductFromSellerOffering"));

/* Register For API Key */
Route::post('api/register', array("uses" => "UserController@postRegister"));

/* Orders */
Route::get('api/order/{id}/{apikey}', array("uses" => "OrderController@getOrderInfoByID"));
Route::get('api/order/{apikey}', array("uses" => "OrderController@getOrders"));
Route::get('api/order/product/{id}/{apikey}', array("uses" => "OrderController@getOrdersByProductID"));
Route::get('api/order/seller/{id}/{apikey}', array("uses" => "OrderController@getOrdersBySellerID"));
Route::get('api/order/customer/{id}/{apikey}', array("uses" => "OrderController@getOrdersByCustomerID"));
Route::post('api/order/new', array("uses" => "OrderController@postOrders"));




