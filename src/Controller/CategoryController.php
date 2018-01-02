<?php

namespace App\Controller;

use App\Manager\Request;
use App\Manager\Response;
use App\Model\Category;
use App\Utils\Common;

class CategoryController extends BaseController
{
	public function listAction(Request $request)
	{
		return $this->render('category/list.html', [
			'categories' => Category::fetchAll()
		]);
	}

	public function newAction(Request $request)
	{
		if ($request->isPost()) {
			$postData = $request->getPost();
			// Validate empty email
			if (empty($postData['name'])) {
				$errorMessages['fields']['name'] = 'Name is required and can\'t be empty.';
			}
			// Validate empty password
			if (empty($postData['type'])) {
				$errorMessages['fields']['type'] = 'Type is required and can\'t be empty.';
			}
			// Validate empty password
			if ('subcategory' == $postData['type'] && empty($postData['parent_id'])) {
				$errorMessages['fields']['category'] = 'Parent category is required and can\'t be empty.';
			}
			// Validate uploaded file (if exist)
			if (!empty($_FILES['image'])) {
				if ($_FILES['image']['error'] > 0) {
					$errorMessages['fields']['image'] = 'Somethong went wrong with the upload, make sure to select correct image.';
				}
			}
			if (!empty($errorMessages)) {
				$errorMessages['status'] = 'error';
				$errorMessages['message'] = 'Invalid credentials.';
				return Response::dispatchJson($errorMessages);
			}
			if (!empty($_FILES['image'])) {
				$fileExtension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
				$newImageName = Common::generateRandomString(32).'.'.$fileExtension;
				move_uploaded_file($_FILES['image']['tmp_name'], $this->getParameter('upload_dir').$newImageName);
				$postData['image'] = $newImageName;
			}
			Category::insert($postData);
			$response['status'] = 'success';
			$response['message'] = 'Successfully inserted, redirecting...';
			$response['redirect_uri'] = '/category/list';
			return Response::dispatchJson($response);
		}
		return $this->render('category/new.html', [
			'categories' => Category::fetchParents()
		]);
	}
}
