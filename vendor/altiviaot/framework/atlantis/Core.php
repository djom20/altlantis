<?php
	/**
	  Core Class
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
    use Symfony\Component\HttpFoundation\Response;
    use Symfony\Component\HttpKernel\HttpKernelInterface;

	use Symfony\Component\Routing\Matcher\UrlMatcher;
	use Symfony\Component\Routing\RequestContext;
	use Symfony\Component\Routing\RouteCollection;
	use Symfony\Component\Routing\Route;
	use Symfony\Component\Routing\Exception\ResourceNotFoundException;
	use Symfony\Component\EventDispatcher\EventDispatcher;

	if(!class_exists('Core'))
	{
		class Core implements HttpKernelInterface
		{
			protected $routes;

			public function __construct()
			{
				$this->routes 		= new RouteCollection();
				$this->dispatcher 	= new EventDispatcher();
			}

			public function on($event, $callback)
			{
				$this->dispatcher->addListener($event, $callback);
			}

			public function fire($event)
		    {
			    return $this->dispatcher->dispatch($event);
			}

			public function handle(Request $request, $type = HttpKernelInterface::MASTER_REQUEST, $catch = true)
			{
				// create a context using the current request
				$context = new RequestContext();
				$context->fromRequest($request);

				$matcher = new UrlMatcher($this->routes, $context);

				try {
					$attributes = $matcher->match($request->getPathInfo());
					$callback = $attributes['callback'];
					unset($attributes['callback']);
					$response = call_user_func_array($callback, $attributes);
				} catch (ResourceNotFoundException $e) {
					$response = new Response('Error, Route Not found!', 404);
				}

				return $response;
			}

			public function map($path, $callback) {
				$this->routes->add($path, new Route(
					$path,
					array('callback' => $callback)
				));
			}
		}
	}