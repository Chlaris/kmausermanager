<?php
namespace OCA\kmausermanager\Controller;

use OCP\IRequest;
use OCP\IDBConnection;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;

class KMACellController  extends Controller{
    private $db;

    public function __construct($AppName, IRequest $request, IDBConnection $db) {
        parent::__construct($AppName, $request);
        $this->db = $db;
    }


    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     */
    public function getAllKMACells() {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_cell');

        $result = $query->execute();
        $cells = $result->fetchAll();
        return ['cells' => $cells];
    }



    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $cell_id
     */
    public function getKMACell($cell_id) {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_cell')
            ->where($query->expr()->eq('cell_id', $query->createNamedParameter($cell_id)));

        $result = $query->execute();
        $data = $result->fetch();
        if ($data === false) {
            return new DataResponse([], Http::STATUS_NOT_FOUND);
        }
        return new DataResponse([
            'Ma chi bo' => $data['cell_id'],
            'Ten chi bo' => $data['cell_name'],
            'Mo ta' => $data['description'],
            'Ma don vi' => $data['unit_id'],
            'Ma bi thu' => $data['secretary_id'],
            'Ma pho bi thu' => $data['vice_secretary_id'],
            'Ma cap uy 1' => $data['executive_committee_1st'],
            'Ma cap uy 2' => $data['executive_committee_2nd'],
            // Add other desired user information here
        ]);
    }	
	

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $cell_id
     * @param string $cell_name
     * @param string $description
	 * @param string $unit_id
     * @param string $secretary_id
     * @param string $vice_secretary_id
     * @param string $executive_committee_1st
     * @param string $executive_committee_2nd
     */
    public function createKMACell($cell_id, $cell_name, $description, $unit_id, $secretary_id, $vice_secretary_id, $executive_committee_1st, $executive_committee_2nd) {
        $query = $this->db->getQueryBuilder();
        $query->insert('kma_cell')
            ->values([
                'cell_id' => $query->createNamedParameter($cell_id),
                'cell_name' => $query->createNamedParameter($cell_name),
                'description' => $query->createNamedParameter($description),
                'unit_id' => $query->createNamedParameter($unit_id),
                'secretary_id' => $query->createNamedParameter($secretary_id),
                'vice_secretary_id' => $query->createNamedParameter($vice_secretary_id),
                'executive_committee_1st' => $query->createNamedParameter($executive_committee_1st),
                'executive_committee_2nd' => $query->createNamedParameter($executive_committee_2nd),
                // Add other desired columns here
            ])
            ->execute();
        return new DataResponse(['status' => 'success']);
    }


    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $cell_id
     */
    public function deleteKMACell($cell_id) {
        $query = $this->db->getQueryBuilder();
        $query->delete('kma_cell')
            ->where($query->expr()->eq('cell_id', $query->createNamedParameter($cell_id)))
            ->execute();
        return new DataResponse(['status' => 'success']);
    }



    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $cell_id
     * @param string $cell_name
     * @param string $description
	 * @param string $unit_id
     * @param string $secretary_id
     * @param string $vice_secretary_id
     * @param string $executive_committee_1st
     * @param string $executive_committee_2nd
     * @return JSONResponse
     */
    public function updateInfoKMACell($cell_id, $cell_name = null, $description  = null, $unit_id = null, $secretary_id = null, $vice_secretary_id = null, $executive_committee_1st = null, $executive_committee_2nd = null) {
        $query = $this->db->prepare('UPDATE `oc_kma_cell` SET `cell_name` = COALESCE(?, `cell_name`), 
                                                            `description` = COALESCE(?, `description`), 
                                                            `unit_id` = COALESCE(?, `unit_id`),
                                                            `secretary_id` = COALESCE(?, `secretary_id`),
                                                            `vice_secretary_id` = COALESCE(?, `vice_secretary_id`),
                                                            `executive_committee_1st` = COALESCE(?, `executive_committee_1st`),
                                                            `executive_committee_2nd` = COALESCE(?, `executive_committee_2nd`)
                                                                WHERE `cell_id` = ?');
        $query->execute(array($cell_name, $description, $unit_id, $secretary_id, $vice_secretary_id, $executive_committee_1st, $executive_committee_2nd, $cell_id));
        return new JSONResponse(array('status' => 'success'));
    }
}
