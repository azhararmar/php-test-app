<?php

namespace App\Controller;

use App\Manager\Security;
use App\Manager\Response;

class BaseController
{
	protected $security;

	protected $response;

	protected $template;

	protected $data = array();

	protected $parameters;

	public function setSecurityManager(Security $security)
	{
		$this->security = $security;
		return $this;
	}

	public function getSecurityManager()
	{
		return $this->security;
	}

	public function setResponse(Response $response)
	{
		$this->response = $response;
		return $this;
	}

	public function getResponse()
	{
		return $this->response;
	}

	public function render($template, array $data = array())
	{
		$this->template = $template;
		$this->data = $data;
	}

	public function getTemplate()
	{
		return $this->template;
	}

	public function getData()
	{
		return $this->data;
	}

	public function setParameters(array $parameters)
	{
		$this->parameters = $parameters;
		return $this;
	}

	public function getParameter($key)
	{
		return $this->parameters[$key];
	}
}
