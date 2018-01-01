<?php

namespace App;

use App\Manager\Router;
use App\Manager\Request;

class Application
{
	protected $router;

	protected $config;

	protected $contentTemplate;

	public function __construct(Router $router, array $config = array())
	{
		$this->router = $router;
		$this->config = $config;
	}

	public function run()
	{
		$request = new Request();
		$routeConfig = $this->router->getConfig();
		// If no match is found display 404
		if (!array_key_exists($request->getRequestUri(), $routeConfig)) {
			return include_once $this->config['templates']['404'];
		}
		// Validate route mapping in the config
		$matchedRoute = explode(':', $routeConfig[$request->getRequestUri()]);
		if (count($matchedRoute) != 2) {
			throw new \Exception(
				'Invalid Mapping Format Used For Route {'.$request->getRequestUri().'}, Requred format is {Controller:action}'
			);
		}
		$controller = $matchedRoute[0];
		$controllerFQCN = 'App\Controller\\'.$controller;
		$action = $matchedRoute[1];
		if (!class_exists($controllerFQCN)) {
			throw new \Exception('Invalid Controller {'.$controller.'}');
		}
		if (!method_exists($controllerFQCN, $action)) {
			throw new \Exception('Invalid Action {'.$action.'} for controller {'.$controller.'}');
		}
		$controller = new $controllerFQCN();
		$template = $controller->$action($request);
		if (empty($template) || !is_string($template)) {
			throw new \Exception(
				'Action must return template path in string format in '.$controllerFQCN.'::'.$action
			);
		}
		// Check if returned template path exist
		$templatePath = $this->config['view_dir'].$template;
		if (!file_exists($templatePath)) {
			throw new \Exception('Template not found at given path {'.$templatePath.'}');
		}
		$this->contentTemplate = $templatePath;
		include_once $this->config['templates']['layout'];
		return $this;
	}

	public function content()
	{
		include_once $this->contentTemplate;
	}

	public function getConfig()
	{
		return $this->config;
	}
}
