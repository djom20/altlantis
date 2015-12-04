<?php
	/**
	  View Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('View'))
	{
		class View
		{
			public function show($name, $_VARS = array())
			{
				$config     = Config::init();
				$display    = new Display($name, $_VARS);
				$_params	= $display->getParams();
				$path       = $config->get('templatesfolder') . $config->get('template') . '.php';

				if (file_exists($path) == false) {
					trigger_error('View `' . $path . '` does not exist.', E_USER_NOTICE);
					return false;
				}

				include($path);
			}
		}
	}
