<?php
	/**
	  ControllerBase Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace altiviaot\atlantis;

	if(!class_exists('ControllerBase'))
	{
		abstract class ControllerBase
		{
			protected $post;
			protected $get;
			protected $view;
			protected $config;
			protected $files;
			protected $put;
			protected $delete;

			public function __construct($post, $get, $files, $put, $delete)
			{
				session_set_cookie_params(31536000, '/');
				session_start();

				$this->config   = Config::init();
				$this->get      = $get;
				$this->put      = $put;
				$this->post     = $post;
				$this->files    = $files;
				$this->delete   = $delete;
				$this->view     = new View();
			}

			public function _Always(){}

			public function getModel($model)
			{
				$modelName  = ucwords($model) . 'Model';
				$strmodel   = strtolower($model);
				$modelPath  = $this->config->get('modelsfolder') . $modelName . '.php';
				if (is_file($modelPath)) {
					require $modelPath;
					$modelObj = new $modelName($strmodel);
				} else {
					$this->db   = SPDO::init();
					$result 	= $this->db->query("SHOW TABLES;");
					$rows   	= $result->fetchAll();
					$sw     	= false;

					foreach ($rows as $row) {
						if (!$sw) {
							$sw = ($row[0] === $strmodel);
						}
					}

					if ($sw) {
						$modelObj = new ModelBase($strmodel);
					} else {
						die("<h1>404: No se pudo encontrar {$modelName}.</h1>");
					}
				}

				return $modelObj;
			}
		}
	}