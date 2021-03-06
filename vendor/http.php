<?php
	/**
		HTTP Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('HTTP'))
	{
		class HTTP
		{
			protected static $messages = array(
				200 => '200 OK',
				304 => '304 Not Modified',
				400 => '400 Bad Request',
				401 => '401 Unauthorized',
				403 => '403 Forbidden',
				404 => '404 Not Found',
				424 => '424 Method Failure',
				500 => '500 Internal Server Error'
			);

			public static function JSON($value)
			{
				$response_origin = (!empty($_SERVER['HTTP_ORIGIN']))? $_SERVER['HTTP_ORIGIN'] : "http://{$_SERVER['HTTP_HOST']}";

				header('Access-Control-Allow-Origin: ' . $response_origin);
				header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
				header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
				header('Access-Control-Allow-Credentials: true');
				header('content-type: application/json; charset=utf-8');

				$array_send = (is_numeric($value))? HTTP::Value($value) : $value;

				echo json_encode($array_send);
				exit();
			}

			public static function Value($code)
			{
				return array(
					'_code' => $code,
					'_message' => HTTP::$messages[$code],
					'_response' => ''
				);
			}

			public static function encrypt($value)
			{
				$value = str_replace(' ', '+', urldecode($value));
				$GLOBALS['_AES']->setData($value);
				return $GLOBALS['_AES']->encrypt();
			}

			public static function decrypt($value, $isNumber = false)
			{
				$value = str_replace(' ', '+', urldecode($value));
				$GLOBALS['_AES']->setData($value);
				$data = $GLOBALS['_AES']->decrypt();
				if(!is_numeric($data) && $isNumber) {
					HTTP::JSON(400);
				}
				return $data;
			}
		}
	}