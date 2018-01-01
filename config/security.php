<?php
// Define routes mentioned public url (the one which does not require login) and secured url (the one which requires login)

return [
    'security' => [
        'login_route' => '/account/sign-in',
        'home_route' => '/item/list',
        'public' => [
            '/account/sign-in'
        ],
        'secured' => [
            '/',
            '/item/list',
            '/category/list',
            '/account/sign-out'
        ]
    ]
];