<?php

	class IndexController extends ControllerBase
	{
		public function index()
		{
			$params = array('idproduct' => 1, 'product' => 'Arroz', 'exist' => 23, 'color' => 'green');
			HTTP::JSON(Partial::response(HTTP::Value(200), $params));
		}
	}