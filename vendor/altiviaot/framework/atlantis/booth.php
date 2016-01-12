<?php
	/**
	  Booth Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace Framework;

	if(!class_exists('Booth'))
	{
		class Booth
		{
			public static function run(Config $config)
			{
				// Incluyendo helpers class
				FilesLoader::requireOnce('app/helpers');
				FilesLoader::requireOnce('config/routers');

				// Set TimeZone
				date_default_timezone_set($config->get('timezone') ? $config->get('timezone') : 'UTC');

				// Init mirgations to database
				//$m = new Migrator();
				//$m->rollback();

				// Set config display errors
				if ($config->get('environment') != 'test') ini_set('display_errors', 'Off');

				//Formamos el nombre del Controlador o en su defecto, tomamos que es el IndexController
				if(!empty($_GET['controller']))
				{
					$controllerName = ucwords($_GET['controller']) . 'Controller';
				} else {
					$controllerName = 'IndexController';
				}

				//Lo mismo sucede con las acciones, si no hay accion, tomamos index como accion
				if(!empty($_GET['action']))
				{
					$actionName = $_GET['action'];
				} else {
					$actionName = 'index';
				}

				//Definimos variables globales de controlador / accion
				define('ControllerName', $controllerName);
				define('ActionName', $actionName);

				//Declarando los arrays que se pasaran al controlador
				$delete = $post = $get = $put = array();

				//Obtener las variables pasadas por GET del request_uri
				if(!empty($_GET['frontGetVars']))
				{
					$get = explode('/', $_GET['frontGetVars']);
				} else {
					$tmp = array();
					preg_match_all("/(?P<key>[a-zA-Z_][a-zA-Z0-9_-]*)=(?P<value>[^&]*)/", $_SERVER['REQUEST_URI'], $tmp);
					for ($i = 0; $i < count($tmp['key']); $i++) {
						$get[$tmp['key'][$i]] = $tmp['value'][$i];
					}
				}

				//Obtener las variables por metodos
				$method = $_SERVER['REQUEST_METHOD'];
				if($method == 'PUT' || $method == 'DELETE' || $method == 'POST')
				{
					$params = array();
					parse_str(file_get_contents('php://input'), $params);
					$GLOBALS["_{$method}"] = $params;
					$_REQUEST = $params + $_REQUEST;

					if ($method == 'PUT')
					{
						$put = $params;
					} elseif ($method == 'DELETE') {
						$delete = $params;
					} elseif ($method == 'POST') {
						$post = $params;
					}
				} else if ($method == 'GET') {
					$_GET = $get;
				}

				$controllerPath = $config->get('dir_controllers') . $controllerName . '.php';
				//Incluimos el fichero que contiene nuestra clase controladora solicitada
				if (is_file($controllerPath))
				{
					require $controllerPath;
				} else {
					//Si el controlador anterior no existe, llamamos al controlador de Error
					$controllerName = 'ErrorController';
					$controllerPath = $config->get('dir_controllers') . $controllerName . '.php';
					$actionName = 'index';
					echo '</pre>';
					print_r($config->getArray());
					echo '</pre>'; exit();
					echo $config->get('dir_controllers'); exit();
					require $controllerPath;
				}

				//Si no existe la clase que buscamos y su acción, llamamos al controlador de Error
				if (!method_exists($controllerName, $actionName))
				{
					$controllerName = 'ErrorController';
					$controllerPath = $config->get('dir_controllers') . $controllerName . '.php';
					$actionName = 'index';
					require $controllerPath;
				}

				//Creamos el Controlador
				$controller = new $controllerName($post, $get, $_FILES, $put, $delete);

				//Finalmente creamos una instancia del controlador y llamamos a la accion
				$controller->_Always();
				$controller->$actionName();
			}
		}
	}