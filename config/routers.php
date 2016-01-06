<?php
	/*
	|--------------------------------------------------------------------------
	| Application Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register all of the routes for an application.
	|
	*/

	Route::get('/', function(){
		return View::make('index');
	});