<?php

namespace App\Controller;

use App\Manager\Request;

class ItemController extends BaseController
{
	public function listAction(Request $request)
	{
		return $this->render('item/list.html');
	}

	public function newAction(Request $request)
	{
		return $this->render('item/new.html');
	}
}
