<?php

require __DIR__.'/../vendor/autoload.php';

$application = new \App\Application(
	new \App\Manager\Router(
		require __DIR__ . '/../config/routes.php'
	),
	array_merge_recursive(
		require __DIR__ . '/../config/config.php',
		require __DIR__ . '/../config/security.php'
	)
);
$application->run();