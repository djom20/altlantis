<?php
	return array(
		'default' 		=> 'mysql',
		'migrations' 	=> 'migrations',
		'development'  	=> array(
			'fetch'		=> PDO::FETCH_CLASS
			'driver'   	=> 'mysql',
			'host'     	=> 'localhost',
			'database' 	=> 'altiviao_atlantis',
			'username' 	=> 'altiviao_dbatlan',
			'password' 	=> 'DbEMTU]N2TR9',
			'charset'  	=> 'utf8',
			'prefix'   	=> '',
			'schema'   	=> 'public'
		),
		'test' 		   	=> array(
			'fetch' 	=> PDO::FETCH_CLASS
			'driver'   	=> 'postgresql',
			'host'     	=> 'localhost',
			'database' 	=> 'altiviao_atlantis',
			'username' 	=> 'altiviao_dbatlan',
			'password' 	=> 'DbEMTU]N2TR9',
			'charset'  	=> 'utf8',
			'prefix'   	=> '',
			'schema'   	=> 'public'
		),
		'production'   	=> array(
			'fetch' 	=> PDO::FETCH_CLASS
			'driver'   	=> 'oracle',
			'host'     	=> 'localhost',
			'database' 	=> 'altiviao_atlantis',
			'username' 	=> 'altiviao_dbatlan',
			'password' 	=> 'DbEMTU]N2TR9',
			'charset'  	=> 'utf8',
			'prefix'   	=> '',
			'schema'   	=> 'public'
		)
	);