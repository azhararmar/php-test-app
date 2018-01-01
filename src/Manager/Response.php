<?php

namespace App\Manager;

class Response
{
	public static function redirectTo($route)
	{
		header('Location: '.$route);
		die();
	}

	public static function dispatchJson(array $data = array())
	{
		header('Content-type: application/json');
		echo json_encode($data);
		die;
	}
}
