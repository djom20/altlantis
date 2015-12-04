<?php
	/**
	  Logger Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('Logger'))
	{
		abstract class Logger
		{
			public function __construct(){}

			public function _Always(){}

			public function log($msj)
			{
				$logFile = 'log-'.php_sapi_name().'.txt';
				sefl::writte($config->get('loggerfolder').$logFile, $msj);
			}

			private function write($url, $msj)
			{
				//Escibir en el log del dia
			}
		}
	}