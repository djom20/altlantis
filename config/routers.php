<?php
	/*
	|--------------------------------------------------------------------------
	| Application Routes
	|--------------------------------------------------------------------------
	|
	| Here is where you can register all of the routes for an application.
	|
	*/

	Router::path('/', function () {
		return View::make('home/index');
	});

 //    Router::path('/user/{iduser}/buy/{idbuy}', function ($iduser, $idbuy) {
 //        return new Response('Your id user is ' . $iduser . ' and your id buy is '. $idbuy);
 //    });