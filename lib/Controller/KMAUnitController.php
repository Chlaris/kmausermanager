<?php
namespace OCA\kmausermanager\Controller;

use OCP\IRequest;
use OCP\IDBConnection;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;

class KMAUnitController  extends Controller{
    private $db;

    public function __construct($AppName, IRequest $request, IDBConnection $db) {
        parent::__construct($AppName, $request);
        $this->db = $db;
    }


    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     */
    public function getAllKMAUnit() {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_unit');

        $result = $query->execute();
        $units = $result->fetchAll();
        return ['units' => $units];
    }



    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $unit_id
     */
    public function getKMAUnit($unit_id) {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_unit')
            ->where($query->expr()->eq('unit_id', $query->createNamedParameter($unit_id)));

        $result = $query->execute();
        $data = $result->fetch();
        if ($data === false) {
            return new DataResponse([], Http::STATUS_NOT_FOUND);
        }
        return new DataResponse([
            'Ma don vi' => $data['unit_id'],
            'Ten don vi' => $data['unit_name'],
            'Mo ta' => $data['description'],
            'Ma truong don vi' => $data['chief_unit'],
            'Ma pho don vi' => $data['deputy_unit'],
            'Ma don vi cha' => $data['parent_unit'],
            // Add other desired user information here
        ]);
    }	
	

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $unit_id
     * @param string $unit_name
     * @param string $description
	 * @param string $chief_unit
     * @param string $deputy_unit
     * @param string $parent_unit
     */
    public function createKMAUnit($unit_id, $unit_name, $description, $chief_unit, $deputy_unit, $parent_unit) {
        $query = $this->db->getQueryBuilder();
        $query->insert('kma_unit')
            ->values([
                'unit_id' => $query->createNamedParameter($unit_id),
                'unit_name' => $query->createNamedParameter($unit_name),
                'description' => $query->createNamedParameter($description),
                'chief_unit' => $query->createNamedParameter($chief_unit),
                'deputy_unit' => $query->createNamedParameter($deputy_unit),
                'parent_unit' => $query->createNamedParameter($parent_unit),
                // Add other desired columns here
            ])
            ->execute();
        return new DataResponse(['status' => 'success']);
    }


    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $unit_id
     */
    public function deleteKMAUnit($unit_id) {
        $query = $this->db->getQueryBuilder();
        $query->delete('kma_unit')
            ->where($query->expr()->eq('unit_id', $query->createNamedParameter($unit_id)))
            ->execute();
        return new DataResponse(['status' => 'success']);
    }



    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $unit_id
     * @param string $unit_name
     * @param string $description
	 * @param string $chief_unit
     * @param string $deputy_unit
     * @param string $parent_unit
     * @return JSONResponse
     */
    public function updateInfoKMAUnit($unit_id, $unit_name = null, $description  = null, $chief_unit = null, $deputy_unit = null, $parent_unit = null) {
        $query = $this->db->prepare('UPDATE `oc_kma_unit` SET `unit_name` = COALESCE(?, `unit_name`), 
                                                        `description` = COALESCE(?, `description`), 
                                                        `chief_unit` = COALESCE(?, `chief_unit`), 
                                                        `deputy_unit` = COALESCE(?, `deputy_unit`), 
                                                        `parent_unit` = COALESCE(?, `parent_unit`)
                                                            WHERE `unit_id` = ?');
        $query->execute(array($unit_name, $description, $chief_unit, $deputy_unit, $parent_unit, $unit_id));
        return new JSONResponse(array('status' => 'success'));
    }
}
