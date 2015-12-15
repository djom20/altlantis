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