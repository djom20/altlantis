<?php
	/**
	  TwitterApi Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	if(!class_exists('TwitterApi'))
	{
		class TwitterApi
		{
			private $token;
			private $token_secret;
			private $consumer_key;
			private $consumer_secret;
			private $oauth;

			public function __construct($token, $token_secret, $consumer_key, $consumer_secret)
			{
				$this->token 			= $token;
				$this->token_secret 	= $token_secret;
				$this->consumer_key 	= $consumer_key;
				$this->consumer_secret 	= $consumer_secret;

				$this->oauth = array(
				    'oauth_consumer_key' 	 => $this->consumer_key,
				    'oauth_token' 			 => $this->token,
				    'oauth_nonce' 			 => (string)mt_rand(), // a stronger nonce is recommended
				    'oauth_timestamp' 		 => time(),
				    'oauth_signature_method' => 'HMAC-SHA1',
				    'oauth_version' 		 => '1.0'
				);

				$this->oauth = array_map("rawurlencode", $this->oauth); // must be encoded before sorting
			}

			public function request($url, $query, $method = "GET")
			{
				$url = "https://api.twitter.com/1.1/" . $url;
				$query = array_map("rawurlencode", $query);

				$arr = array_merge($this->oauth, $query); // combine the values THEN sort

				asort($arr); // secondary sort (value)
				ksort($arr); // primary sort (key)

				// http_build_query automatically encodes, but our parameters
				// are already encoded, and must be by this point, so we undo
				// the encoding step
				$querystring = urldecode(http_build_query($arr, '', '&'));

				// mash everything together for the text to hash
				$base_string = $method."&".rawurlencode($url)."&".rawurlencode($querystring);

				// same with the key
				$key = rawurlencode($this->consumer_secret)."&".rawurlencode($this->token_secret);

				// generate the hash
				$signature = rawurlencode(base64_encode(hash_hmac('sha1', $base_string, $key, true)));

				$this->oauth['oauth_signature'] = $signature; // don't want to abandon all that work!
				ksort($this->oauth); // probably not necessary, but twitter's demo does it

				// also not necessary, but twitter's demo does this too
				function add_quotes($str) { return '"'.$str.'"'; }
				$this->oauth = array_map("add_quotes", $this->oauth);

				// this is the full value of the Authorization line
				$auth = "OAuth " . urldecode(http_build_query($this->oauth, '', ', '));

				// if you're doing post, you need to skip the GET building above
				// and instead supply query parameters to CURLOPT_POSTFIELDS
				if($method == "GET")
				{
					$options = $this->getMethod($auth, $url, $query);
				}
				else
				{
					$options = $this->postMethod($auth, $url, $query);
				}

				// do our business
				$feed = curl_init();
				curl_setopt_array($feed, $options);
				$json = curl_exec($feed);
				curl_close($feed);

				return json_decode($json);
			}

			private function getMethod($auth, $url, $query)
			{
				// this time we're using a normal GET query, and we're only encoding the query params
				// (without the oauth params)
				$url .= "?".http_build_query($query);
				$url=str_replace("&amp;","&",$url); //Patch by @Frewuill

				return array(CURLOPT_HTTPHEADER => array("Authorization: $auth"),
							CURLOPT_HEADER => false,
							CURLOPT_URL => $url,
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_SSL_VERIFYPEER => false);
			}

			private function postMethod($auth, $url, $query)
			{
				return array(CURLOPT_HTTPHEADER => array("Authorization: $auth"),
							CURLOPT_POSTFIELDS => $query,
							CURLOPT_HEADER => false,
							CURLOPT_URL => $url,
							CURLOPT_RETURNTRANSFER => true,
							CURLOPT_SSL_VERIFYPEER => false);
			}
		}
	}