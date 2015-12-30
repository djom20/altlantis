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
				$_params	= $display->getParams();
				$path       = $config->get('templatesfolder') . $config->get('template') . '.php';

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
