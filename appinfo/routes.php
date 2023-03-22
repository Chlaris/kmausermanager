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
		// ['name' => 'KMAUser#sayHi', 'url' => '/sayhi', 'verb' => 'GET'],
		['name' => 'KMAUser#getAllKMAUser', 'url' => '/all_kma_user', 'verb' => 'GET'],
		['name' => 'KMAUser#getKMAUser', 'url' => '/kma_user/{kma_uid}', 'verb' => 'GET'],
		['name' => 'KMAUser#getKMAUserbyPosition', 'url' => '/kma_user_by_position/{position_id}', 'verb' => 'GET'],
		['name' => 'KMAUser#getKMAUserbyUnit', 'url' => '/kma_user_by_unit/{unit_id}', 'verb' => 'GET'],
		['name' => 'KMAUser#createKMAUser', 'url' => '/create_kma_user', 'verb' => 'POST'],
		['name' => 'KMAUser#deleteKMAUser', 'url' => '/delete_kma_user/{kma_uid}', 'verb' => 'DELETE'],
		['name' => 'KMAUser#updateInfoKMAUser', 'url' => '/update_kma_user/{kma_uid}', 'verb' => 'PUT'],
		

		#Nguoithan
		['name' => 'KMARelations#getAllKMARelations', 'url' => '/all_kma_relations', 'verb' => 'GET'],
		['name' => 'KMARelations#getKMARelation', 'url' => '/kma_relation/{relations_id}', 'verb' => 'GET'],
		['name' => 'KMARelations#getKMARelationBykmaUID', 'url' => '/kma_relation_by_uid/{kma_uid}', 'verb' => 'GET'],
		['name' => 'KMARelations#createKMARelation', 'url' => '/create_kma_relation', 'verb' => 'POST'],
		['name' => 'KMARelations#deleteKMARelation', 'url' => '/delete_kma_relation/{relations_id}', 'verb' => 'DELETE'],
		['name' => 'KMARelations#updateInfoKMARelation', 'url' => '/update_kma_relation/{relations_id}', 'verb' => 'PUT'],

		#Daotao
		['name' => 'KMAEducation#createKMAEducation', 'url' => '/create_kma_education', 'verb' => 'POST'],
		['name' => 'KMAEducation#getAllKMAEducation', 'url' => '/all_kma_educations', 'verb' => 'GET'],
		['name' => 'KMAEducation#getKMAEducation', 'url' => '/kma_education/{education_id}', 'verb' => 'GET'],
		['name' => 'KMAEducation#getKMAEducationByUID', 'url' => '/kma_education_by_uid/{kma_uid}', 'verb' => 'GET'],
		['name' => 'KMAEducation#updateInfoKMAEducation', 'url' => '/update_kma_education/{education_id}', 'verb' => 'PUT'],
		['name' => 'KMAEducation#deleteKMAEducation', 'url' => '/delete_kma_education/{education_id}', 'verb' => 'DELETE'],

		#Congtac
		['name' => 'KMABusiness#createKMABusiness', 'url' => '/create_kma_business', 'verb' => 'POST'],
		['name' => 'KMABusiness#getAllKMABusiness', 'url' => '/all_kma_businesses', 'verb' => 'GET'],
		['name' => 'KMABusiness#getKMABusiness', 'url' => '/kma_business/{business_id}', 'verb' => 'GET'],
		['name' => 'KMABusiness#getKMABusinessByUID', 'url' => '/kma_business_by_uid/{kma_uid}', 'verb' => 'GET'],
		['name' => 'KMABusiness#deleteKMABusiness', 'url' => '/delete_kma_business/{business_id}', 'verb' => 'DELETE'],
		['name' => 'KMABusiness#updateInfoKMABusiness', 'url' => '/update_kma_business/{business_id}', 'verb' => 'PUT'],

		#Chucvu
		['name' => 'KMAPosition#createKMAPosition', 'url' => '/create_kma_position', 'verb' => 'POST'],
		['name' => 'KMAPosition#getAllKMAPositions', 'url' => '/all_kma_positions', 'verb' => 'GET'],
		['name' => 'KMAPosition#getKMAPosition', 'url' => '/kma_position/{position_id}', 'verb' => 'GET'],
		['name' => 'KMAPosition#deleteKMAPosition', 'url' => '/delete_kma_position/{position_id}', 'verb' => 'DELETE'],
		['name' => 'KMAPosition#updateInfoKMAPosition', 'url' => '/update_kma_position/{position_id}', 'verb' => 'PUT'],

		#Donvi
		['name' => 'KMAUnit#createKMAUnit', 'url' => '/create_kma_unit', 'verb' => 'POST'],
		['name' => 'KMAUnit#getAllKMAUnit', 'url' => '/all_kma_units', 'verb' => 'GET'],
		['name' => 'KMAUnit#getKMAUnit', 'url' => '/kma_unit/{unit_id}', 'verb' => 'GET'],
		['name' => 'KMAUnit#deleteKMAUnit', 'url' => '/delete_kma_unit/{unit_id}', 'verb' => 'DELETE'],
		['name' => 'KMAUnit#updateInfoKMAUnit', 'url' => '/update_kma_unit/{unit_id}', 'verb' => 'PUT'],

		#Khenthuong-Kyluat
		['name' => 'KMABonus#createKMABonus', 'url' => '/create_kma_bonus', 'verb' => 'POST'],
		['name' => 'KMABonus#getAllKMABonuses', 'url' => '/all_kma_bonuses', 'verb' => 'GET'],
		['name' => 'KMABonus#getKMABonus', 'url' => '/kma_bonus/{bonus_id}', 'verb' => 'GET'],
		['name' => 'KMABonus#getKMABonusbyUID', 'url' => '/kma_bonus_by_uid/{kma_uid}', 'verb' => 'GET'],
		['name' => 'KMABonus#getKMABonusbytype', 'url' => '/kma_bonus_by_type/{type}', 'verb' => 'GET'],
		['name' => 'KMABonus#deleteKMABonus', 'url' => '/delete_kma_bonus/{bonus_id}', 'verb' => 'DELETE'],
		['name' => 'KMABonus#updateInfoKMABonus', 'url' => '/update_kma_bonus/{bonus_id}', 'verb' => 'PUT'],

		#Chibo
		['name' => 'KMACell#createKMACell', 'url' => '/create_kma_cell', 'verb' => 'POST'],
		['name' => 'KMACell#getAllKMACells', 'url' => '/all_kma_cells', 'verb' => 'GET'],
		['name' => 'KMACell#getKMACell', 'url' => '/kma_cell/{cell_id}', 'verb' => 'GET'],
		['name' => 'KMACell#deleteKMACell', 'url' => '/delete_kma_cell/{cell_id}', 'verb' => 'DELETE'],
		['name' => 'KMACell#updateInfoKMACell', 'url' => '/update_kma_cell/{cell_id}', 'verb' => 'PUT'],

    ],
];
