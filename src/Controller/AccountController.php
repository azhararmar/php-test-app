<?php

namespace App\Controller;

use App\Manager\Request;
use App\Manager\Response;
use App\Model\User;

class AccountController extends BaseController
{
	public function signInAction(Request $request)
	{
		$errorMessages = array();
		if ($request->isPost() && $request->isXmlHttpRequest()) {
			$postData = $request->getPost();
			// Validate empty email
			if (empty($postData['email'])) {
				$errorMessages['fields']['email'] = 'Email address is required and can\'t be empty.';
			}
			// Validate empty password
			if (empty($postData['password'])) {
				$errorMessages['fields']['password'] = 'Password is required and can\'t be empty.';
			}
			// Validate email address
			if (!empty($postData['email']) && !filter_var($postData['email'], \FILTER_VALIDATE_EMAIL)) {
				$errorMessages['fields']['email'] = 'Invalid email address';
			}
			// Check if user with given email address exist
			$user = User::fetchByEmailAddress($postData['email']);
			if (empty($user)) {
				$errorMessages['fields']['email'] = 'User with this email address not found.';
			}
			// Match Password
			if ($user && !password_verify($postData['password'], $user['password'])) {
				$errorMessages['fields']['password'] = 'Invalid password.';
			}
			if (!empty($errorMessages)) {
				$errorMessages['status'] = 'error';
				$errorMessages['message'] = 'Invalid credentials.';
				return Response::dispatchJson($errorMessages);
			}
			// Validation passed
			$this->getSecurityManager()->authenticate($user);
			$response['status'] = 'success';
			$response['message'] = 'Successfully authencaated, redirecting...';
			$response['redirect_uri'] = '/item/list';
			return Response::dispatchJson($response);
		}
		return $this->render('account/sign-in.html');
	}

	public function signOutAction(Request $request)
	{
		$this->getSecurityManager()->eraseSession();
		$this->getResponse()->redirectTo('/account/sign-in');
	}
}
