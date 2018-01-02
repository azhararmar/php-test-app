<?php

namespace App\Controller;

use App\Manager\Request;
use App\Manager\Response;
use App\Model\Category;
use App\Model\Item;

class ItemController extends BaseController
{
	public function listAction(Request $request)
	{
		return $this->render('item/list.html', [
			'items' => Item::fetchAll()
		]);
	}

	public function newAction(Request $request)
	{
		if ($request->isPost()) {
			$postData = $request->getPost();
			if (empty($postData['category_id'])) {
				$errorMessages['fields']['category_id'] = 'Category is required and can\'t be empty.';
			}
			if (empty($postData['subcategory_id'])) {
				$errorMessages['fields']['subcategory_id'] = 'Sub Category is required and can\'t be empty.';
			}
			if (empty($postData['name'])) {
				$errorMessages['fields']['name'] = 'Name is required and can\'t be empty.';
			}
			if (empty($postData['stock'])) {
				$errorMessages['fields']['stock'] = 'Stock is required and can\'t be empty.';
			}
			if (empty($postData['price'])) {
				$errorMessages['fields']['price'] = 'Price is required and can\'t be empty.';
			}
			if (!empty($postData['stock']) && !is_numeric($postData['stock'])) {
				$errorMessages['fields']['stock'] = 'Stock must contains integer values only.';
			}
			if (!empty($postData['price']) && !is_numeric($postData['price'])) {
				$errorMessages['fields']['price'] = 'Price must contains integer values only.';
			}
			if (!empty($errorMessages)) {
				$errorMessages['status'] = 'error';
				$errorMessages['message'] = 'Invalid credentials.';
				return Response::dispatchJson($errorMessages);
			}
			Item::insert($postData);
			$response['status'] = 'success';
			$response['message'] = 'Successfully inserted, redirecting...';
			$response['redirect_uri'] = '/item/list';
			return Response::dispatchJson($response);

		}
		return $this->render('item/new.html', [
			'categories' => Category::fetchParents()
		]);
	}
}
