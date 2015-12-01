<?php
	/**
	  RowObject Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('RowObject'))
	{
		abstract class RowObject
		{
			public abstract function fetch(array $row = array());
		}
	}
