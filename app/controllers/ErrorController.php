<?php
	/**
	  Error Controller
	*
	* @author Ing. Jonathan Olier djom202@gmail.com
	*
	*/

	class ErrorController extends ControllerBase
	{
	    public function index()
	    {
	        HTTP::JSON(500);
	    }
	}