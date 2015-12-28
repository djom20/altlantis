<?php
	require __DIR__.'/vendor/altiviaot/framework/atlantis/booth.php';
	require __DIR__.'vendor/autoload.php';
	$app = Booth::init(); // Declare instance
	$app->run(); // Init Server