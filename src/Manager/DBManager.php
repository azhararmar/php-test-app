<?php

namespace App\Manager;

use PDO;

class DBManager
{
	const HOST = 'localhost';
	const DBNAME = 'php_test_app';
	const DBUSER = 'needle';
	const DBPASS = 'needle';

	protected static $instance;

	private function __construct() {}

	public static function getInstance()
	{
		if (empty(self::$instance)) {
			self::$instance = new DBManager();
		}
		return self::$instance;
	}

	public function getConnection()
	{
		try {
			$dbh = new PDO('mysql:host='.self::HOST.';dbname='.self::DBNAME, self::DBUSER, self::DBPASS);
		} catch(PDOException $exception) {
			echo $exception->getMessage();
		}
		return $dbh;
	}
}