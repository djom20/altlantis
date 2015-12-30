<?php
	/**
		Display Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace altiviaot\atlantis;

	if(!class_exists('Display'))
	{
		class Display
		{
			private $name;
			public $_VARS;

			public function __construct($name, $_VARS = array())
			{
				$this->name = $name;
				$this->_VARS = (object)$_VARS;
			}

			public function getParams(){
				return $this->_VARS;
			}

			public function show()
			{
				$config = Config::init();
				$path = $config->get('viewsfolder') . $this->name . '.php';

				if (file_exists($path) == false) {
					trigger_error('View `' . $path . '` does not exist.', E_USER_NOTICE);
					return false;
				}

				include($path);
			}
		}
	}