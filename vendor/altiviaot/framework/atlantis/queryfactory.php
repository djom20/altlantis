<?php
	/**
	  QueryFactory Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	namespace altiviaot\atlantis;

	if(!class_exists('QueryFactory'))
	{
		class QueryFactory
		{
			public static function query($query, $values = array())
			{
				$conn = SPDO::init();

				$result = $conn->prepare($query);
				$result->execute($values);

				return $result->fetchAll();
			}

			public static function executeOnly($query, $values = array())
			{
				$conn = SPDO::init();

				$result = $conn->prepare($query);
				$result->execute($values);

				return $result->rowCount();
			}
		}
	}