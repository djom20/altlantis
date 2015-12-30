<?php
	/**
	  Migrations Controller
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	class MigrationsController extends ControllerBase
	{
		public function index()
		{
			$params = array(
				'title' 		=> 'Migrations Logs',
				'stylesheet' 	=> 'resources/css/migrations/stylesheet_migrations.css',
				'migrations' 	=> null
			);

			View::make('migrations/index', $params);
		}
	}