<?php
	$config = Config::singleton();

	//Folders' Direction
	$config->set('controllersfolder', 'app/controllers/');
	$config->set('modelsfolder', 'app/models/');
	$config->set('viewsfolder', 'app/views/');
	$config->set('templatesfolder', 'app/templates/');
	$config->set('template', 'default.php');
	$config->set('environment', 'development');