<?php

namespace App;

use App\Manager\Router;
use App\Manager\Request;
use App\Manager\Response;
use App\Manager\Security;

class Application
{
	protected $router;

	protected $request;

	protected $response;

	protected $security;

	protected $config;

	protected $content;

	public function __construct(Router $router, array $config = array())
	{
		$this->router = $router;
		$this->config = $config;
		$this->request = new Request();
		$this->response = new Response();
		$this->security = new Security();
	}

	public function run()
	{
		$request = $this->request;
		$response = $this->response;
		$security = $this->security;
		$routeConfig = $this->router->getConfig();
		$matchedUri = $request->getMatchedUri();
		// If no match is found display 404
		if (!array_key_exists($matchedUri, $routeConfig)) {
			return include_once $this->config['templates']['404'];
			die;
		}
		// Validate route mapping in the config
		$matchedRoute = explode(':', $routeConfig[$matchedUri]);
		if (count($matchedRoute) != 2) {
			throw new \Exception(
				'Invalid Mapping Format Used For Route {'.$matchedUri.'}, Requred format is {Controller:action}'
			);
		}
		$controller = $matchedRoute[0];
		$action = $matchedRoute[1];
		$controllerFQCN = 'App\Controller\\'.$controller;
		if (!class_exists($controllerFQCN)) {
			throw new \Exception('Invalid Controller {'.$controller.'}');
		}
		if (!method_exists($controllerFQCN, $action)) {
			throw new \Exception('Invalid Action {'.$action.'} for controller {'.$controller.'}');
		}
		// Validate Security
		$loginRoute = $this->config['security']['login_route'];
		// If user is not logged in, redirect user to login route
		if (!$security->userIsLoggedIn() && $loginRoute != $matchedUri) {
			$this->response->redirectTo($loginRoute);
			return;
		}
		// If user is logged in and tries to visit sign-in page, redirect user to home route
		$homeRoute = $this->config['security']['home_route'];
		if ($security->userIsLoggedIn() && $loginRoute == $matchedUri) {
			$this->response->redirectTo($homeRoute);
			return;
		}
		// Continue with rest of operations after security validations
		$controller = new $controllerFQCN();
		$template = $controller->$action($request);
		$requiresTemplate = !empty($template);
		if (true === $requiresTemplate) {
			if (!is_string($template)) {
				throw new \Exception(
					'Action must return template path in string format in '.$controllerFQCN.'::'.$action
				);
			}
			// Check if returned template path exist
			$templatePath = $this->config['view_dir'].$template;
			if (!file_exists($templatePath)) {
				throw new \Exception('Template not found at given path {'.$templatePath.'}');
			}
			$this->content = $templatePath;
			require_once $this->config['templates']['layout'];
		}
		return $this;
	}

	public function content()
	{
		require_once $this->content;
	}

	public function getConfig()
	{
		return $this->config;
	}
}
