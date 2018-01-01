<?php

namespace App\Manager;

class Security
{
	public function __construct()
	{
		session_start();
	}

	public function userIsLoggedIn()
	{
		return !empty($_SESSION['user']);
	}
}