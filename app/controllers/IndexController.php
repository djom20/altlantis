<?php
	/**
	  Index Controller
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	class IndexController extends ControllerBase
	{
		public function index()
		{
			$_params = array(
				'title' 	 => 'Welcome',
				'stylesheet' => 'resources/css/home/stylesheet_home.css'
			);

			$this->view->show('home/index', $_params);
		}
	}