<?php
namespace OCA\kmausermanager\Controller;

use OCP\IRequest;
use OCP\IDBConnection;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;

class KMABusinessController  extends Controller{
    private $db;

    public function __construct($AppName, IRequest $request, IDBConnection $db) {
        parent::__construct($AppName, $request);
        $this->db = $db;
    }


    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     */
    public function getAllKMABusiness() {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_business');

        $result = $query->execute();
        $businesses = $result->fetchAll();
        return ['businesses' => $businesses];
    }


    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $business_id
     */
    public function getKMABusiness($business_id) {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_business')
            ->where($query->expr()->eq('business_id', $query->createNamedParameter($business_id)));

        $result = $query->execute();
        $data = $result->fetch();
        if ($data === false) {
            return new DataResponse([], Http::STATUS_NOT_FOUND);
        }
        return new DataResponse([
            'Ma cong tac' => $data['business_id'],
            'Ma can bo' => $data['kma_uid'],
            'Ngay bat dau' => $data['start_time'],
            'Ngay ket thuc' => $data['end_time'],
            'Don vi' => $data['unit'],
            'Chuc vu' => $data['position'],
            // Add other desired user information here
        ]);
    }	
	

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $business_id
     * @param string $kma_uid
     * @param string $start_time
     * @param string $end_time
     * @param string $unit
     * @param string $position
     */
    public function createKMABusiness($business_id, $kma_uid, $start_time, $end_time, $unit, $position) {
        $query = $this->db->getQueryBuilder();
        $query->insert('kma_business')
            ->values([
                'business_id' => $query->createNamedParameter($business_id),
                'kma_uid' => $query->createNamedParameter($kma_uid),
                'start_time' => $query->createNamedParameter($start_time),
                'end_time' => $query->createNamedParameter($end_time),
                'unit' => $query->createNamedParameter($unit),
                'position' => $query->createNamedParameter($position),
                // Add other desired columns here
            ])
            ->execute();
        return new DataResponse(['status' => 'success']);
    }


    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $business_id
     */
    public function deleteKMABusiness($business_id) {
        $query = $this->db->getQueryBuilder();
        $query->delete('kma_business')
            ->where($query->expr()->eq('business_id', $query->createNamedParameter($business_id)))
            ->execute();
        return new DataResponse(['status' => 'success']);
    }



    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $business_id
     * @param string $kma_uid
     * @param string $start_time
     * @param string $end_time
     * @param string $unit
     * @param string $position
     * @return JSONResponse
     */
    public function updateInfoKMABusiness($business_id, $kma_uid = null, $start_time = null, $end_time  = null, $unit = null, $position = null) {
        $query = $this->db->prepare('UPDATE `oc_kma_business` SET `kma_uid` = COALESCE(?, `kma_uid`),
                                                            `start_time` = COALESCE(?, `start_time`), 
                                                            `end_time` = COALESCE(?, `end_time`),
                                                            `unit` = COALESCE(?, `unit`),
                                                            `position` = COALESCE(?, `position`)
                                                                WHERE `business_id` = ?');
        $query->execute(array($kma_uid, $start_time, $end_time, $unit, $position, $business_id));
        return new JSONResponse(array('status' => 'success'));
    }
}
