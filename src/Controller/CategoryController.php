<?php

namespace App\Controller;

use App\Manager\Request;

class CategoryController extends BaseController
{
	public function listAction(Request $request)
	{
		return 'category/list.html';
	}
}
