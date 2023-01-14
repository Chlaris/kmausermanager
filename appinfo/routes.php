<?php
/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\KMAUserManager\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */
return [
    'routes' => [
        
		#Page
		['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],
		['name' => 'page#add', 'url' => '/add', 'verb' => 'GET'],

		['name' => 'page#do_echo', 'url' => '/echo', 'verb' => 'POST'],

		#Canbo
		['name' => 'canbo#sayHi', 'url' => '/sayhi', 'verb' => 'GET'],
		['name' => 'canbo#getAllKMAUser', 'url' => '/all_kma_user', 'verb' => 'GET'],
		['name' => 'canbo#getKMAUser', 'url' => '/kma_user/{username}', 'verb' => 'GET'],
		['name' => 'canbo#createCanbo', 'url' => '/create_kma_user', 'verb' => 'POST'],
		['name' => 'canbo#deleteCanbo', 'url' => '/delete_kma_user', 'verb' => 'DELETE']
		
    ],

//    'ocs' => [
//		['root' => '/kma', 'name' => 'Canbo#getCanbo', 'url' => '/kma_users', 'verb' => 'GET'],
        // apis
		// [
		// 	'name' => 'canbo#getCanbo',
		// 	'url' => '/api/v1/users/{path}',
		// 	'verb' => 'GET',
		// 	'requirements' => [
		// 		'path' => '.*',
		// 	]
		// ],
        // [
		// 	'name' => 'user#users',
		// 	'url' => '/api/v1/users/',
		// 	'verb' => 'POST',
		// 	'requirements' => [
		// 		'path' => '.*',
		// 	]
		// ],
        // [
		// 	'name' => 'user#users',
		// 	'url' => '/api/v1/users/',
		// 	'verb' => 'PUT',
		// 	'requirements' => [
		// 		'path' => '.*',
		// 	]
		// ],
        // [
		// 	'name' => 'user#users',
		// 	'url' => '/api/v1/users/',
		// 	'verb' => 'DELETE',
		// 	'requirements' => [
		// 		'path' => '.*',
		// 	]
		// ],
    //]
];
