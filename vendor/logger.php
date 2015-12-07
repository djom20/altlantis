<?php
	/**
	  Logger Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('Logger'))
	{
		class Logger
		{
			protected $logFile;

			public function log($msj)
			{
				$this->logFile = $config->get('loggerfolder').'server-'.php_sapi_name().'.log';
				sefl::writte($this->logFile, $msj);
			}

			private function write($url, $msj)
			{
				error_log($msj, 3, $url);
			}

			public function showMe()
			{
				echo nl2br(file_get_contents($nombre_archivo));
			}
		}
	}