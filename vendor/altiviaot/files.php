<?php

	/**
	  Files Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('Files'))
	{
		abstract class Files
		{
			private function __construct(){}

			public static function requireOnce($route)
			{
				$files = glob( $route . '/*.php' );
				foreach ( $files as $file ){
					require_once( $file );
				}
			}
		}
	}