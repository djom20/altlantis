<?php

	/**
	  Schema Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('Schema'))
	{
		abstract class Schema
		{
			private function __construct(){}

			public static function init()
			{
				if (!isset(self::$instance)) {
					$c = __CLASS__;
					self::$instance = new $c;
				}

				return self::$instance;
			}

			public static function create($__table, $__func)
			{
				// Creando Schema at Database
				$this->run();
			}

			public static function drop($__table)
			{
				// Drop Schema at Database
				$this->drop();
			}
		}
	}