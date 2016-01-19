<?php
	// Filters

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