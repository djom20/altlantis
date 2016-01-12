<?php
	/**
	  SPDO Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace Framework;

	if(!class_exists('SPDO'))
	{
		class SPDO extends PDO
		{
			private $config;
			private $connName;
			private $conections;
			protected $conn;
			private static $instance;

			public function __construct()
			{
				$this->config = Config::init();

				if(!empty($db) && is_array($db)){
					$config->setArray($db[]);
				}
				$this->connName 	= strtolower($config->get('environment'));
				$this->conections 	= $db[strtolower($config->get('environment'))];

				$this->conn = parent::__construct($config->get('driver') . ':host=' . $config->get('host') . ';dbname=' . $config->get('database'), $config->get('username'), $config->get('password'), array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . $config->get('charset')));
			}

			public static function init()
			{
				if (self::$instance == null) {
					self::$instance = new self();
				}

				return self::$instance;
			}

			public function getConection()
			{
				return $this->conn;
			}

			public function setDefaultConnection(){
				$db = require_once 'config/database.php';
			}

			public function getConectionName(){
				return strtolower($this->config->get('environment'));
			}
		}
	}