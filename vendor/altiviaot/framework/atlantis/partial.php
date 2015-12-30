<?php
	/**
	  Partial Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace altiviaot\atlantis;

	if(!class_exists('Partial'))
	{
		class Partial
		{
			public static function show($name, $_VARS = array())
			{
				$config = Config::init();
				$path = $config->get('viewsFolder') . $name;

				if (file_exists($path) == false) {
					trigger_error('Template `' . $path . '` does not exist.', E_USER_NOTICE);
					return false;
				}

				include($path);
			}

			public static function fetchRows($vars = array(), $row = "", $start = 0, $count = 1000)
			{
				$result = "";
				for ($i = $start; $i < $start + $count && isset($vars[$i]); $i++) {
					$rows   = $vars[$i];
					$tmp    = $row;
					foreach ($rows as $key => $value) {
						if (!is_numeric($key)) {
							$tmp = str_replace(":$key", $value, $tmp);
						}
					}

					if ($tmp !== "") {
						$result .= $tmp;
					}
				}

				return $result;
			}

			public static function toCsv($rows = array(), $csv_file = "", $csv_sep = ",")
			{
				$csv_end = "\n";
				$csv = "";
				if($csv_file == ''){ $csv_file = "csv/data_".date('d-m-Y_h-i-s').".csv"; }

				for ($i=0; $i < 2; $i++) {
					foreach ($rows as $key => $value) { // Rows de la base de datos
						foreach ($value as $key2 => $value2) { // Encabezados del fichero
							if($i == 0){
								$csv .= ucwords($key2).$csv_sep;
							} else {
								if(!empty($value2)){
									$csv .= $value2.$csv_sep;
								}
								else{ $csv .= '--'.$csv_sep; }
							}
						}

						$csv .= $csv_end;
						if($i == 0){ break; }
					}
				}

				$csv .= $csv_end;
				if (!$handle = fopen($csv_file, "w")){
					echo "Cannot open file";
					exit;
				}

				if (fwrite($handle, utf8_decode($csv)) === FALSE) {
					echo "Cannot write to file";
					exit;
				}

				fclose($handle);

				header("Expires: 0");
				header("Pragma: charset=iso-8859-3");
				header('Content-Transfer-Encoding: binary');
				header('Content-Description: File Transfer');
				header("Content-Length: ".filesize($csv_file));
				header("Content-Type: application/force-download;");
				header("Content-Disposition: attachment; filename=$csv_file");
				readfile($csv_file);

				return $csv;
			}

			public static function arrayNames($vars, $exclude = array())
			{
				$res = array();
				for ($i = 0; $i < count($vars); $i++) {
					$tmp = array();
					foreach ($vars[$i] as $key => $value) {
						if (!is_numeric($key) && !in_array($key, $exclude)) {
							$tmp[$key] = $value;
						}
					}

					array_push($res, $tmp);
				}

				return $res;
			}

			public static function response($header, $response)
			{
				$tmp = $header;
				$tmp['_response'] = $response;

				return $tmp;
			}

			public static function _empty($vars, $names)
			{
				foreach ($names as $name) {
					if (!empty($vars[$name])) {
						return false;
					}
				}

				return true;
			}

			public static function _filled($vars, $names)
			{
				foreach ($names as $name) {
					if (empty($vars[$name])) {
						return false;
					}
				}

				return true;
			}

			public static function prefix($vars, $prefix)
			{
				$tmp = array();
				foreach ($vars as $key => $value) {
					$tmp["{$prefix}{$key}"] = $value;
				}

				return $tmp;
			}
		}
	}