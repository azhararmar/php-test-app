<?php

namespace App\Controller;

use App\Manager\Request;

class ItemController
{
	public function listAction(Request $request)
	{
		return 'item/list.html';
	}
}
