<?php

namespace App\Controller;

use App\Manager\Request;

class AccountController
{
	public function signInAction(Request $request)
	{
		$_SESSION['user'] = array(
			'id' => 1,
			'name' => 'Ibrahim Azhar'
		);
		return 'account/sign-in.html';
	}

	public function signOutAction(Request $request)
	{
		
	}
}