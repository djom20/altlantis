<?php
	/**
	  Logs Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace Framework;

	use Monolog\Logger;

	if(!class_exists('Logs'))
	{
		class Logs
		{
			public function debuger($message, array $context = array())
			{
				$config = Config::init();
				$log 	= new Logger($config->get('app_name'));
				$log->addInfo($message, $context);
			}

			public function showMe()
			{
				echo nl2br(file_get_contents($nombre_archivo));
			}
		}
	}