<?php

namespace App\Controller;

use App\Manager\Security;
use App\Manager\Response;

class BaseController
{
	protected $security;

	protected $response;

	protected $template;

	protected $params = array();

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

	public function render($template, array $params = array())
	{
		$this->template = $template;
		$this->params = $params;
	}

	public function getTemplate()
	{
		return $this->template;
	}

	public function getParams()
	{
		return $this->params;
	}
}
