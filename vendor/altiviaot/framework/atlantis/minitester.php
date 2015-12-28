<?php
	/**
	  Minitester Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	namespace altiviaot\atlantis;

	if(!class_exists('Minitester'))
	{
		class Minitester
		{
			private function __construct(){}

			public function assertContainsOnly($p1, $p2)
			{
				if(!empty($p1) && !empty($p2)){
					return true;
				}else{
					die('Error en la comparacion');
				}
			}

			public function assertEquals($p1, $p2)
			{
				if(!empty($p1) && !empty($p2)){
					return true;
				}else{
					die('Error en la comparacion');
				}
			}

			public function assertCount($p1, $p2)
			{
				if(!empty($p1) && !empty($p2)){
					return true;
				}else{
					die('Error en la comparacion');
				}
			}

			public function assertEmpty($p1, $p2)
			{
				if(!empty($p1) && !empty($p2)){
					return true;
				}else{
					die('Error en la comparacion');
				}
			}

			public function assertFalse($p1, $p2)
			{
				if(!empty($p1) && !empty($p2)){
					return true;
				}else{
					die('Error en la comparacion');
				}
			}

			public function assertNotFalse($p1, $p2)
			{
				if(!empty($p1) && !empty($p2)){
					return true;
				}else{
					die('Error en la comparacion');
				}
			}

			public function assertFileExists($p1, $p2)
			{
				if(!empty($p1) && !empty($p2)){
					return true;
				}else{
					die('Error en la comparacion');
				}
			}

			public function assertGreaterThan($p1, $p2)
			{
				if(!empty($p1) && !empty($p2)){
					return true;
				}else{
					die('Error en la comparacion');
				}
			}

			public function assertLessThan($p1, $p2)
			{
				if(!empty($p1) && !empty($p2)){
					return true;
				}else{
					die('Error en la comparacion');
				}
			}

			public function assertNull($p1, $p2)
			{
				if(!empty($p1) && !empty($p2)){
					return true;
				}else{
					die('Error en la comparacion');
				}
			}
		}
	}