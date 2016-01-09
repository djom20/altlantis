<?php

	/**
	  FilesLoader Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace Framework;

	if(!class_exists('FilesLoader'))
	{
		abstract class FilesLoader
		{
			private function __construct(){}

			public static function requireOnce($route)
			{
				$files = glob( $route . '/*.php' );
				foreach ( $files as $file ){
					require_once( $file );
				}
			}

			public function chargeConfig($route = array())
			{
				$c = Config::init();
				foreach ($route as $k => $r) {
					if(file_exists($r .'.php')) $v = require_once($r. '.php');
					else throw new InvalidArgumentException('Unroutable file '.$r);

					if(!empty($v) && is_array($v))
					{
						$c->setArray($v);
					}
				}

				return $c->getArray();
			}

			public function chargeLang($__locale = null)
			{
				$c = Config::init();

				$f = glob($c->get('dir_lang') . ((is_null($__locale)) ? $c->get('locale') : $__locale) . '/*.php');
				foreach ($f as $k => $r) {
					if(file_exists($r)) $v = require_once($r);
					else throw new InvalidArgumentException('Unroutable file '.$r);

					if(!empty($v) && is_array($v))
					{
						$c->setArray(array('lang' => $v));
					}
				}

				return $c->getArray();
			}
		}
	}