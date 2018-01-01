<?php

require __DIR__.'/../vendor/autoload.php';

$application = new \App\Application(
	new \App\Manager\Router(
		require __DIR__ . '/../config/routes.php'
	),
	require __DIR__ . '/../config/config.php'
);
$application->run();