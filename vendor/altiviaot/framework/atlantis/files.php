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

			public static function chargeConfig($route = array())
			{
				$c = Config::init();
				foreach ($route as $k => $r) {
					$v = require_once($r. '.php');
					if(!empty($v) && is_array($v))
					{
						$c->setArray($v);
					}
				}
			}

			public static function chargeLang($__locale = null)
			{
				$c = Config::init();

				$f = glob($c->get('dir_lang') . ((is_null($__locale)) ? $c->get('locale') : $__locale) . '/*.php');
				foreach ($f as $k => $r) {
					$v = require_once($r);
					if(!empty($v) && is_array($v))
					{
						$c->setArray(array('lang' => $v));
					}
				}
			}
		}
	}