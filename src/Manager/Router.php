<?php

namespace App\Manager;

class Router
{
	protected $config;

	public function __construct(array $config = array())
	{
		$this->config = $config;
		return $this;
	}

	public function getConfig()
	{
		return $this->config;
	}
}
