<?php
	/**
	  InstallerController Controller
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	class InstallerController extends ControllerBase
	{
		public function _Always()
		{
			$this->config->set('template', 'installer');
		}

		public function install()
		{
			$params = array('title' => 'Welcome');
			$this->view->show('install/installer', $params);
		}
	}