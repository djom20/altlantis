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
				$this->_VARS = (object)$_VARS;
			}

			public function show()
			{
				$config = Config::init();
				$path = $config->get('viewsfolder') . $this->name . '.php';

				if (file_exists($path) == false) {
					trigger_error('View `' . $path . '` does not exist.', E_USER_NOTICE);
					return false;
				}

				$_params = $this->_VARS;
				include($path);
			}
		}
	}