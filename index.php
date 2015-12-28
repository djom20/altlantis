<?php
	require __DIR__.'/vendor/altiviaot/booth.php';
	require __DIR__.'vendor/autoload.php';
	$app = Booth::init(); // Declare instance
	$app->run(); // Init Server