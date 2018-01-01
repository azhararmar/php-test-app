<?php

namespace App\Manager;

class Response
{
	public function redirectTo($route)
	{
		header('Location: '.$route);
		die();
	}
}
