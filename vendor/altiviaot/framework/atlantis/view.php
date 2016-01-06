<?php
	/**
	  View Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace altiviaot\atlantis;

	if(!class_exists('View'))
	{
		class View
		{
			public function make($name, $_vars = array())
			{
				$config     = Config::init();
				$display    = new Display($name, $_vars);
				$path       = $config->get('dir_templates') . $config->get('template') . '.php';
				$_params	= $display->getParams();

				$_params	= (array)$_params;
				$_params['is_webapp'] = $config->get('web_app');
				$_params	= (object)$_params;

				if (file_exists($path) == false) {
					trigger_error('View `' . $path . '` does not exist.', E_USER_NOTICE);
					return false;
				}

				include($path);
			}

			// public function make($__view){
			// 	echo $__view;
			// }
		}
	}
