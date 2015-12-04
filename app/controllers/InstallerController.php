<?php
	/**
	  InstallerController Controller
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	class InstallerController extends ControllerBase
	{
		public function install()
		{
			$params = array(
				'title' => 'Welcome',
				'stylesheet' => 'resources/css/installer/stylesheet_install.css'
			);

			$this->view->show('install/installer', $params);
		}
	}