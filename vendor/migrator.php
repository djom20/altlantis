<?php

	/**
	  Migrator Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('Migrator'))
	{
		abstract class Migrator
		{
			private function __construct()
			{
				// Connect to Database
			}

			public static function run()
			{
				// Runner a mirgation
			}

			public static function drop()
			{
				// Rollback a mirgation
			}
		}
	}