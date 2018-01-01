<?php

namespace App\Model;

use PDO;

class User extends BaseModel
{
	public static function fetchByEmailAddress($email)
	{
		$dbh = self::getConnection();
		$sth = $dbh->prepare('SELECT id, name, email, password FROM user WHERE user.email = :email');
		$sth->bindParam(':email', $email);
		$sth->execute();
		return $sth->fetch(PDO::FETCH_ASSOC);
	}
}
