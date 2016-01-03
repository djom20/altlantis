<?php
	/**
	 *
	 	Helpers Class
	 *
	 */

	if(!class_exists('upperTitle'))
	{
		function upperTitle($t)
		{ // Convert title to lowercase at uppercase
			return strtoupper($t);
		}
	}