<?php
	/**
		Display Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('Display'))
	{
		class Display
		{
			private $name;
			public $_VARS;

			public function __construct($name, $_VARS = array())
			{
				$this->name = $name;
				$this->_VARS = $_VARS;
			}

			public function show()
			{
				$config = Config::init();
				$path = $config->get('viewsfolder') . $this->name;

				if (file_exists($path) == false) {
					trigger_error('Template `' . $path . '` does not exist.', E_USER_NOTICE);
					return false;
				}

				$_VARS = $this->_VARS;
				include($path);
			}
		}
	}