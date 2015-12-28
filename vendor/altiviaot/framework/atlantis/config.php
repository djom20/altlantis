<?php
	/**
	  Config Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	namespace altiviaot\atlantis;

	if(!class_exists('Config'))
	{
		class Config
		{
			private $vars;
			private static $instance;

			private function __construct()
			{
				$this->vars = array();
			}

			public function set($name, $value)
			{
				$this->vars[$name] = $value;
			}

			public function setArray($arr = array())
			{
				$this->vars = array_merge($this->vars, $arr);
			}

			public function get($name)
			{
				if (isset($this->vars[$name])) {
					return $this->vars[$name];
				}
			}

			public static function init()
			{
				if (!isset(self::$instance)) {
					$c = __CLASS__;
					self::$instance = new $c;
				}

				return self::$instance;
			}
		}

		$config = Config::init();
	}