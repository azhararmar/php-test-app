<?php

namespace App\Controller;

use App\Manager\Request;
use App\Manager\Response;
use App\Model\Category;
use App\Model\Item;

class DefaultController extends BaseController
{
	public function indexAction(Request $request)
	{
		// User is no logged in
		if (!$this->getSecurityManager()->userIsLoggedIn()) {
			$this->getResponse()->redirectTo('/account/sign-in');
		} else {
			// User is logged in
			$this->getResponse()->redirectTo('/item/list');
		}
		
	}
}
