<?php
	/**
	  FacebookApi Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('FacebookApi'))
	{
		class FacebookApi
		{
			private $app_id;
			private $app_secret;
			private $app_token;

			public function __construct($app_id, $app_secret)
			{
				$this->app_id 		= $app_id;
				$this->app_secret 	= $app_secret;
				$this->app_token 	= $this->setAppToken();
			}

			private function setAppToken()
			{
				$url = "https://graph.facebook.com/oauth/access_token?client_id={$this->app_id}&client_secret={$this->app_secret}&grant_type=client_credentials";

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_TIMEOUT, 20);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$json_object = curl_exec($ch);
				curl_close($ch);

				return $json_object;
			}

			public function request($url, $options = array())
			{
				$url = "https://graph.facebook.com/" . $url . "?";
				if(count($options) > 0)
				{
					$url .= http_build_query($options) . "&";
				}
				$url .= $this->app_token;

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_TIMEOUT, 20);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$json_object = curl_exec($ch);
				curl_close($ch);

				return json_decode($json_object);
			}
		}
	}