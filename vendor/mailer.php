<?php
	/**
	  Mailer Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

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