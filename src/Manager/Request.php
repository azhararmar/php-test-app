<?php

namespace App\Manager;

class Request
{
	public function getRequestUri()
	{
		return $_SERVER['REQUEST_URI'];
	}

	public function getPost()
	{
		return $_POST;
	}
}
