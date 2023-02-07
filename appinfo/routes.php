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
		['name' => 'KMAUser#sayHi', 'url' => '/sayhi', 'verb' => 'GET'],
		['name' => 'KMAUser#getAllKMAUser', 'url' => '/all_kma_user', 'verb' => 'GET'],
		['name' => 'KMAUser#getKMAUser', 'url' => '/kma_user/{kma_uid}', 'verb' => 'GET'],
		['name' => 'KMAUser#createKMAUser', 'url' => '/create_kma_user', 'verb' => 'POST'],
		['name' => 'KMAUser#deleteKMAUser', 'url' => '/delete_kma_user', 'verb' => 'DELETE'],
		['name' => 'KMAUser#updateInfoKMAUser', 'url' => '/update_kma_user/{kma_uid}', 'verb' => 'PUT'],
		

		#Nguoithan
		['name' => 'KMARelations#getAllKMARelations', 'url' => '/all_kma_relations', 'verb' => 'GET'],
		['name' => 'KMARelations#getKMARelation', 'url' => '/kma_relation/{relations_id}', 'verb' => 'GET'],
		// ['name' => 'KMARelations#getKMARelationById', 'url' => '/kma_relation{kma_uid}', 'verb' => 'GET'],
		['name' => 'KMARelations#createKMARelation', 'url' => '/create_kma_relation', 'verb' => 'POST'],
		['name' => 'KMARelations#deleteKMARelation', 'url' => '/delete_kma_relation', 'verb' => 'DELETE'],
		['name' => 'KMARelations#updateInfoKMARelation', 'url' => '/update_kma_relation/{relations_id}', 'verb' => 'PUT'],
    ],
];
