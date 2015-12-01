<?php
	switch ($config->get('environment')) {
		case 'development':
			$config->set('driver', 'mysql');
			$config->set('BaseUrl', 'http://api.altiviaot.com/');
			$config->set('dbhost', 'localhost');
			$config->set('dbname', 'altiviao_web');
			$config->set('dbuser', 'altiviao_dbroot');
			$config->set('dbpass', 'q6td9.9fmq3');
			break;
		case 'test':
			$config->set('driver', 'mysql');
			$config->set('BaseUrl', 'http://api.altiviaot.com/');
			$config->set('dbhost', 'localhost');
			$config->set('dbname', 'altiviao_web');
			$config->set('dbuser', 'altiviao_dbroot');
			$config->set('dbpass', 'q6td9.9fmq3');
			break;
		case 'production':
			$config->set('driver', 'mysql');
			$config->set('BaseUrl', 'http://api.altiviaot.com/');
			$config->set('dbhost', 'localhost');
			$config->set('dbname', 'altiviao_web');
			$config->set('dbuser', 'altiviao_dbroot');
			$config->set('dbpass', 'q6td9.9fmq3');
			break;
		default:
			die("Error en la conexion a la base de datos");
			break;
	}