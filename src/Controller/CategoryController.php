<?php

namespace App\Controller;

use App\Manager\Request;

class CategoryController extends BaseController
{
	public function listAction(Request $request)
	{
		return $this->render('category/list.html');
	}

	public function newAction(Request $request)
	{
		return $this->render('category/new.html');
	}
}
