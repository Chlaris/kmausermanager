<?php
namespace OCA\kmausermanager\Controller;

use OCP\IRequest;
use OCP\IDBConnection;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;

class KMAPositionController  extends Controller{
    private $db;

    public function __construct($AppName, IRequest $request, IDBConnection $db) {
        parent::__construct($AppName, $request);
        $this->db = $db;
    }


    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     */
    public function getAllKMAPositions() {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_position');

        $result = $query->execute();
        $positions = $result->fetchAll();
        return ['positions' => $positions];
    }



    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $position_id
     */
    public function getKMAPosition($position_id) {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_position')
            ->where($query->expr()->eq('position_id', $query->createNamedParameter($position_id)));

        $result = $query->execute();
        $data = $result->fetch();
        if ($data === false) {
            return new DataResponse([], Http::STATUS_NOT_FOUND);
        }
        return new DataResponse([
            'Ma chuc vu' => $data['position_id'],
            'Ten chuc vu' => $data['position_name'],
            'Phu cap' => $data['allowance'],
            'Ghi chu' => $data['remark'],
            // Add other desired user information here
        ]);
    }	
	

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $position_id
     * @param string $position_name
     * @param string $allowance
	 * @param string $remark
     */
    public function createKMAPosition($position_id, $position_name, $allowance, $remark) {
        $query = $this->db->getQueryBuilder();
        $query->insert('kma_position')
            ->values([
                'position_id' => $query->createNamedParameter($position_id),
                'position_name' => $query->createNamedParameter($position_name),
                'allowance' => $query->createNamedParameter($allowance),
                'remark' => $query->createNamedParameter($remark),
                
                // Add other desired columns here
            ])
            ->execute();
        return new DataResponse(['status' => 'success']);
    }


    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $position_id
     */
    public function deleteKMAPosition($position_id) {
        $query = $this->db->getQueryBuilder();
        $query->delete('kma_position')
            ->where($query->expr()->eq('position_id', $query->createNamedParameter($position_id)))
            ->execute();
        return new DataResponse(['status' => 'success']);
    }



    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $position_id
     * @param string $position_name
     * @param string $allowance
	 * @param string $remark
     * @return JSONResponse
     */
    public function updateInfoKMAPosition($position_id, $position_name = null, $allowance  = null, $remark = null) {
        $query = $this->db->prepare('UPDATE `oc_kma_position` SET `position_name` = COALESCE(?, `position_name`), 
                                                            `allowance` = COALESCE(?, `allowance`), 
                                                            `remark` = COALESCE(?, `remark`)
                                                                WHERE `position_id` = ?');
        $query->execute(array($position_name, $allowance, $remark, $position_id));
        return new JSONResponse(array('status' => 'success'));
    }
}
