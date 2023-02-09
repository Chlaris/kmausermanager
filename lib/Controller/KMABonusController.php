<?php
namespace OCA\kmausermanager\Controller;

use OCP\IRequest;
use OCP\IDBConnection;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;

class KMABonusController extends Controller{
    private $db;

    public function __construct($AppName, IRequest $request, IDBConnection $db) {
        parent::__construct($AppName, $request);
        $this->db = $db;
    }


    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     */
    public function getAllKMABonuses() {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_bonus');

        $result = $query->execute();
        $bonuses = $result->fetchAll();
        return ['bonuses' => $bonuses];
    }



    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $bonus_id
     */
    public function getKMABonus($bonus_id) {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_bonus')
            ->where($query->expr()->eq('bonus_id', $query->createNamedParameter($bonus_id)));

        $result = $query->execute();
        $data = $result->fetch();
        if ($data === false) {
            return new DataResponse([], Http::STATUS_NOT_FOUND);
        }
        return new DataResponse([
            'Ma khen thuong/ky luat' => $data['bonus_id'],
            'Hinh thuc' => $data['form'],
            'Thoi gian' => $data['time'],
            'Ly do' => $data['reason'],
            'So quyet dinh' => $data['number_decision'],
            'Co quan quyet dinh' => $data['department_decision'],
            'Ma can bo' => $data['kma_uid'],
            'Loai' => $data['type'],
            // Add other desired user information here
        ]);
    }	
	

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $bonus_id
     * @param string $form
     * @param string $time
	 * @param string $reason
     * @param string $number_decision
     * @param string $department_decision
     * @param string $kma_uid
     * @param string $type
     */
    public function createKMABonus($bonus_id, $form, $time, $reason, $number_decision, $department_decision, $kma_uid, $type) {
        $query = $this->db->getQueryBuilder();
        $query->insert('kma_bonus')
            ->values([
                'bonus_id' => $query->createNamedParameter($bonus_id),
                'form' => $query->createNamedParameter($form),
                'time' => $query->createNamedParameter($time),
                'reason' => $query->createNamedParameter($remark),
                'number_decision' => $query->createNamedParameter($number_decision),
                'department_decision' => $query->createNamedParameter($department_decision),
                'kma_uid' => $query->createNamedParameter($kma_uid),
                'type' => $query->createNamedParameter($type),
                // Add other desired columns here
            ])
            ->execute();
        return new DataResponse(['status' => 'success']);
    }


    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $bonus_id
     */
    public function deleteKMABonus($bonus_id) {
        $query = $this->db->getQueryBuilder();
        $query->delete('kma_bonus')
            ->where($query->expr()->eq('bonus_id', $query->createNamedParameter($bonus_id)))
            ->execute();
        return new DataResponse(['status' => 'success']);
    }



    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $bonus_id
     * @param string $form
     * @param string $time
	 * @param string $reason
     * @param string $number_decision
     * @param string $department_decision
     * @param string $kma_uid
     * @param string $type
     * @return JSONResponse
     */

    public function updateInfoKMABonus($bonus_id, $form = null, $time  = null, $reason = null, $number_decision = null, $department_decision = null, $kma_uid = null) {
        $query = $this->db->prepare('UPDATE `oc_kma_bonus` SET `form` = COALESCE(?, `form`), 
                                                            `time` = COALESCE(?, `time`), 
                                                            `reason` = COALESCE(?, `reason`), 
                                                            `number_decision` = COALESCE(?, `number_decision`), 
                                                            `department_decision` = COALESCE(?, `department_decision`), 
                                                            `kma_uid` = COALESCE(?, `kma_uid`)
                                                                WHERE `bonus_id` = ?');
        $query->execute(array($form, $time, $reason, $number_decision, $department_decision, $kma_uid, $bonus_id));
        return new JSONResponse(array('status' => 'success'));
    }
}
