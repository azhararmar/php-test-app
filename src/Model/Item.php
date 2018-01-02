<?php

namespace App\Model;

use PDO;

class Item extends BaseModel
{
	public static function insert(array $data)
	{
		$sql = 'INSERT INTO item(name, stock, price, category_id) VALUES(:name, :stock, :price, :category_id)';
		$sth = self::getConnection()->prepare($sql);
		$sth->bindParam(':name', $data['name']);
		$sth->bindParam(':stock', $data['stock']);
		$sth->bindParam(':price', $data['price']);
		$sth->bindParam(':category_id', $data['subcategory_id']);
		return $sth->execute();
	}

	public static function fetchAll()
	{
		$sth = self::getConnection()->prepare('
			SELECT
				i.id,
				i.name,
				i.stock,
				i.price,
				c.name as c_name
			FROM
				item i
			LEFT JOIN
				category c ON i.category_id = c.id
			ORDER BY
				i.id DESC
		');
		$sth->execute();
		$results = $sth->fetchAll(PDO::FETCH_ASSOC);
		return $results;
	}
}
