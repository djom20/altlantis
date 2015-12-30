<?php
	/**
	  RowObject Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace altiviaot\atlantis;

	if(!class_exists('RowObject'))
	{
		abstract class RowObject
		{
			public abstract function fetch(array $row = array());
		}
	}
