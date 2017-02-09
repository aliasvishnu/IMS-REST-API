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