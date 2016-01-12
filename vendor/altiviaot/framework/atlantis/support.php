<?php
	/**
		Support-Helper Class
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace Framework;

	if ( ! function_exists('app'))
	{
		/**
		 * Get the root Facade application instance.
		 *
		 * @param  string  $make
		 * @return mixed
		 */
		function app($make = null)
		{
			if ( ! is_null($make))
			{
				return app()->make($make);
			}

			return Illuminate\Support\Facades\Facade::getFacadeApplication();
		}
	}

	if ( ! function_exists('csrf_token'))
	{
		/**
		 * Get the CSRF token value.
		 *
		 * @return string
		 */
		function csrf_token()
		{
			$session = app('session');

			if (isset($session))
			{
				return $session->getToken();
			}
			else
			{
				throw new RuntimeException("Application session store not set.");
			}
		}
	}

	if ( ! function_exists('last'))
	{
		/**
		 * Get the last element from an array.
		 *
		 * @param  array  $array
		 * @return mixed
		 */
		function last($array)
		{
			return end($array);
		}
	}