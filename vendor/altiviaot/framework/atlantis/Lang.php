<?php
	/**
	  Lang Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace Framework;

	if(!class_exists('Lang'))
	{
		class Lang
		{
			private $config;
			protected $lang;
			protected $langColletions;

			public function __construct(){
				$this->config			= Config::init();
				$this->lang 			= $this->config->get('locale');
				$this->langColletions 	= $this->config->get('lang');
			}

			public function get($__name, $__params = null)
			{
				if(isset($this->langColletions[$name])){
					if(!is_null($__params)){
						return str_replace($this->config->get('name_param_lang'), $__params, $this->langColletions[$name]);
					}

					return $this->langColletions[$name];
				}

				return false;
			}

			public function getCurrent()
			{
				return $this->lang;
			}

			public function has($__name)
			{
				if(is_null($__name)){ throw new InvalidArgumentException("Invalid 1 param, Its don't null."); }
				return (isset($this->langColletions[$name]));
			}
		}
	}