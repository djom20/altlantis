<?php
	/**
	  RequestEvent Class
	*
	* @Coreor Ing. Jonathan Olier djom202@gmail.com
	* @version 1.0
	* @package Atlantis
	* @link http://atlantis.altiviaot.com
	* @copyright Copyright (c) 2016 AltiviaOT
	*
	*/

	// namespace Framework;

	use Symfony\Component\HttpFoundation\Request;
	use Symfony\Component\EventDispatcher\Event;

	if(!class_exists('RequestEvent'))
	{
		class RequestEvent extends Event
		{
			protected $request;

			public function setRequest(Request $request)
			{
				$this->request = $request;
			}

			public function getRequest()
			{
				return $this->request;
			}

			public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
			{
				$event = new RequestEvent();
				$event->setRequest($request);

				$this->dispatcher->dispatch('request', $event);
			}
		}
	}