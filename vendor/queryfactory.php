<?php
	/**
	  QueryFactory Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('QueryFactory'))
	{
		class QueryFactory
		{
			public static function query($query, $values = array())
			{
				$db = SPDO::init();

				$result = $db->prepare($query);
				$result->execute($values);

				return $result->fetchAll();
			}

			public static function executeOnly($query, $values = array())
			{
				$db = SPDO::init();

				$result = $db->prepare($query);
				$result->execute($values);

				return $result->rowCount();
			}
		}
	}