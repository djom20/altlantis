<?php
	$loader = require __DIR__.'/vendor/autoload.php';
	// $loader->register();

	// $app = App::init(); 	// Declare instance
	// $app->run(); 			// Init Server

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

	$request   = Request::createFromGlobals();
	$app       = new Core();

    $app->on('request', function (RequestEvent $event) {
        echo 'This event is '.$event->getRequest()->getPathInfo().'<br><br>';

        if ('admin' == $event->getRequest()->getPathInfo()) {
            echo 'Access Denied!';
            exit();
        }

        if ('user' == $event->getRequest()->getPathInfo()) {
            echo '<h1>Users</h1>';
        }

        if ('/' == $event->getRequest()->getPathInfo()) {
            echo '<h1>Welome to Atlantis</h1>';
        }
    });

    $app->map('/', function () {
        return View::make('home/index');
    });

    $app->map('/user/{iduser}/buy/{idbuy}', function ($iduser, $idbuy) {
        return new Response('Your id user is ' . $iduser . ' and your id buy is '. $idbuy);
    });

    $response = $app->handle($request);
    $response->send();
