<?php

	/**
	  Files Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('Files'))
	{
		abstract class Files
		{
			private function __construct(){}

			public static function requireOnce($route)
			{
				$array = array();
				$d = dir($route);
				while (false !== ($entry = $d->read())){
					$ext = end(explode(".", $entry));
					if($ext == 'php' && $entry != 'config.php'){
						$entry = $route.'/'.$entry;
						if(!is_dir($entry)) {
							require_once($entry);
						}
					}
				}

				$d->close();
			}
		}
	}