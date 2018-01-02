<?php

return [
	'/' => 'DefaultController:indexAction',
	'/item/list' => 'ItemController:listAction',
	'/item/new' => 'ItemController:newAction',
	'/category/list' => 'CategoryController:listAction',
	'/category/new' => 'CategoryController:newAction',
	'/item/fetch-category-by-parent-id' => 'CategoryController:fetchCategoriesAction',
	'/account/sign-in' => 'AccountController:signInAction',
	'/account/sign-out' => 'AccountController:signOutAction',
];
