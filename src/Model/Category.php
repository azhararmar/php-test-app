<?php

namespace App\Model;

use PDO;

class Category extends BaseModel
{
	public static function insert(array $data)
	{
		$fields = array();
		$fields['name'] = ':name';
		if ('subcategory' == $data['type']) {
			$fields['parent_id'] = ':parent_id';
		}
		if (!empty($data['image'])) {
			$fields['image'] = ':image';
		}
		$sql = 'INSERT INTO category('.implode(', ', array_keys($fields)).') VALUES('.implode(', ', array_values($fields)).')';
		$sth = self::getConnection()->prepare($sql);
		foreach ($fields as $key => $value) {
			$sth->bindParam($value, $data[$key]);
		}
		return $sth->execute();
	}

	public static function fetchParents()
	{
		$sth = self::getConnection()->prepare('SELECT id, name FROM category WHERE parent_id IS NULL');
		$sth->execute();
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}

	public static function fetchAll()
	{
		$sth = self::getConnection()->prepare('
			SELECT
				c.id,
				c.name,
				c.image,
				c.parent_id,
				pc.name as parent_name
			FROM
				category c
			LEFT JOIN
				category pc ON pc.parent_id = c.id
			ORDER BY
				c.id DESC
		');
		$sth->execute();
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}

	public static function fetchByParentId($categoryId)
	{
		$sth = self::getConnection()->prepare('
			SELECT
				c.id,
				c.name,
				c.image
			FROM
				category c
			WHERE
				c.parent_id = :parent_id
			ORDER BY
				c.id DESC
		');
		$sth->bindParam(':parent_id', $categoryId);
		$sth->execute();
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
}
