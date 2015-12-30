<?php

	/**
	  Files Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace altiviaot\atlantis;

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