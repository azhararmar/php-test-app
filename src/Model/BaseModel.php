<?php

namespace App\Model;

use App\Manager\DBManager;

class BaseModel
{
	public static function getConnection()
	{
		return DBManager::getInstance()->getConnection();
	}
}
