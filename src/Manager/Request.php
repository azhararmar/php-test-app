<?php

namespace App\Manager;

class Request
{
	public function getMatchedUri()
	{
		return $_SERVER['REQUEST_URI'];
	}

	public function getPost()
	{
		return $_POST;
	}
}
