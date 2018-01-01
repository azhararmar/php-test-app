<?php

namespace App\Controller;

use App\Manager\Request;

class ItemController
{
	public function indexAction(Request $request)
	{
		return 'item/list.html';
	}
}