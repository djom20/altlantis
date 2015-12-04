<?php
	/**
		Installer Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('Installer'))
	{
		class Installer
		{
			protected $config;
			private static $instance;

			public function __construct(){
				$this->config 	= Config::init();
			}

			public function init(){
				if (!isset(self::$instance)) {
					$c = __CLASS__;
					self::$instance = new $c;
				}

				return self::$instance;
			}

			public function validInstall($config)
			{
				$u = $config->get('urlbase');
				echo $config->get('urlbase'); exit();
				if(empty($u)){
					error_log('No existe el parametro de la URL');
					return false;
				}

				return true;
			}

			public static function install(){

			}
		}
	}