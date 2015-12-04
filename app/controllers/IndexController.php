<?php
	/**
	  Index Controller
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	class IndexController extends ControllerBase
	{
		public function _Always()
		{
			$this->config->set('template', 'default');
		}

		public function index()
		{
			$params = array(
				'title' => 'Welcome',
				'stylesheet' => 'resources/css/stylesheet_home.css'
			);
			$this->view->show('home/index');
		}
	}