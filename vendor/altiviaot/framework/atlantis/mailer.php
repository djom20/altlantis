<?php
	/**
	  Mailer Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	namespace altiviaot\atlantis;

	if(!class_exists('Mailer'))
	{
		abstract class Mailer
		{
			public function __construct($_vars = array())
			{}

			public function _Always()
			{}

			public function send()
			{}
		}
	}