<?php
	/**
	  App Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace Framework;

	use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

	if(!class_exists('App'))
	{
		class App
		{
			const version 		= '1.0.0'; // The Atlantis framework version.
			private $config 	= null;
			private $name 		= null;
			private $log 		= null;
			private $console	= null;
			private $request	= null;
			// private $router		= null;
			private static $instance;

			public function __construct()
			{
				$this->config 	= Config::init();
				$this->request  = Request::createFromGlobals();
				$this->router   = Router::init();
				// $this->console 	= Console::

				$this->config->setArray(FilesLoader::chargeConfig(array(
					'config/globals',
					'config/database',
					'config/mail',
					'config/paths',
					'config/environments/development'
				)));

				// Config to system
				$this->config->setArray(array(
					'dir_config' 	  => $this->config->get('dir_base') . 'config/',
					'dir_lang' 		  => $this->config->get('dir_base') . 'config/lang/',
					'dir_env' 		  => $this->config->get('dir_base') . 'config/environments/',
					'dir_app' 		  => $this->config->get('dir_base') . 'app/',
					'dir_vendor' 	  => $this->config->get('dir_base') . 'vendor/',
					'dir_unitest' 	  => $this->config->get('dir_base') . 'unitest/',
					'dir_storage' 	  => $this->config->get('dir_base') . 'storage/',
					'dir_libs' 		  => $this->config->get('dir_base') . 'libs/',
					'dir_db' 		  => $this->config->get('dir_base') . 'db/',
					'dir_bin' 		  => $this->config->get('dir_base') . 'bin/',
					'dir_namespace'	  => $this->config->get('dir_base') . 'vendor/altiviaot/framework/atlantis/',
					'name_param_lang' => ':attribute'
				));

				if (file_exists($path = $this->config->get('dir_config') .'routers.php')){ include $path; }

				$this->listDependencies();

				// Load lenguage to default
				$this->config->setArray(
					FilesLoader::chargeLang()
				);
			}

			public function listDependencies()
			{
				// echo '<pre>';
				// print_r(glob($this->config->get('dir_namespace').'/*.php'));
				// echo '</pre>'; exit();
			}

			public function init()
			{
				if (!isset(self::$instance)) {
					$c = __CLASS__;
					self::$instance = new $c;
				}

				return self::$instance;
			}

			public function getEnv()
			{
				return $this->config->get('environment');
			}

			public function run()
			{
				// This method route app to run or down
				if(!$this->config->get('maintenance')){
					$this->turnon();
				}else{
					$this->shutdown();
				}
			}

			public function setLocale($i)
			{
				if (isset($this->config->get['locale'])){
					$this->config->set('locale', $i);
				}
			}

			private function shutdown($callback = null)
			{
				$response_origin = (!empty($_SERVER['HTTP_ORIGIN']))? $_SERVER['HTTP_ORIGIN'] : "http://{$_SERVER['HTTP_HOST']}";

				header('Access-Control-Allow-Origin: ' . $response_origin);
				header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
				header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
				header('Access-Control-Allow-Credentials: true');

				View::make('error/503', array(
					'title' 	 => 'The server is maintenance',
					'stylesheet' => 'resources/css/home/stylesheet_errors.css'
				));

				exit();
			}

			private function turnon($callback = null)
			{
				$this->name = 'atlantisInit' . md5(($name ? $name : 'a7la97i3') . rand(4, 8));
				$this->config->set('version', version);
				$this->config->set('app_name', $this->name);

				try {
					Logs::debuger('Mensaje');

					$this->response = Router::handle($this->request);
    				$this->response->send();

					// Booth::run($this->config); // Booth this App
				} catch (Exception $e) {

				}
			}
		}
	}