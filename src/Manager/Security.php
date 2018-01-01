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

	public function eraseSession()
	{
		session_destroy();
		session_unset();
		unset($_SESSION["user"]);
		$_SESSION = array();
	}

	public function authenticate(array $userInfo = array())
	{
		$_SESSION['user'] = $userInfo;
	}
}
