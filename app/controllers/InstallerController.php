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
			$this->config->set('template', 'installer.php');
		}

		public function install()
		{
			$params = array();
			$this->view->show('install/installer.php', $params);
		}
	}