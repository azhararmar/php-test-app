<?php

namespace App\Controller;

use App\Manager\Request;

class CategoryController
{
	public function listAction(Request $request)
	{
		return 'category/list.html';
	}
}
