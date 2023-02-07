<?php
namespace OCA\kmausermanager\Controller;

use OCP\IRequest;
use OCP\IDBConnection;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;

class KMAEducationController extends Controller{
    private $db;

    public function __construct($AppName, IRequest $request, IDBConnection $db) {
        parent::__construct($AppName, $request);
        $this->db = $db;
    }

    /**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */

    public function getAllKMAEducation() {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_education');

        $result = $query->execute();
        $educations = $result->fetchAll();
        return ['educations' => $educations];
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $education_id
     */
    public function getKMAEducation($education_id) {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_education')
            ->where($query->expr()->eq('education_id', $query->createNamedParameter($education_id)));

        $result = $query->execute();
        $data = $result->fetch();
        if ($data === false) {
            return new DataResponse([], Http::STATUS_NOT_FOUND);
        }
        return new DataResponse([
            'Ma dao tao' => $data['education_id'],
            'Ma can bo' => $data['kma_uid'],
            'Nam tot nghiep' => $data['graduate_time'],
            'Ngay bat dau' => $data['admision_time'],
            'Don vi dao tao' => $data['training_unit'],
            'Chuyen nganh' => $data['specialization'],
            'Van bang' => $data['diploma'],
            'Ket qua' => $data['graduated_with'],
            // Add other desired user information here
        ]);
    }	
    
    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $education_id
     * @param string $kma_uid
     * @param string $graduate_time
     * @param string $admision_time
     * @param string $training_unit
     * @param string $specialization
     * @param string $diploma
     * @param string $graduated_with
     */
    public function createKMAEducation($education_id, $kma_uid, $graduate_time, $admision_time, $training_unit, $specialization, $diploma, $graduated_with) {
        $query = $this->db->getQueryBuilder();
        $query->insert('kma_education')
            ->values([
                'education_id' => $query->createNamedParameter($education_id),
                'kma_uid' => $query->createNamedParameter($kma_uid),
                'graduate_time' => $query->createNamedParameter($graduate_time),
                'admision_time' => $query->createNamedParameter($admision_time),
                'training_unit' => $query->createNamedParameter($training_unit),
                'specialization' => $query->createNamedParameter($specialization),
                'diploma' => $query->createNamedParameter($diploma),
                'graduated_with' => $query->createNamedParameter($graduated_with),
                // Add other desired columns here
            ])
            ->execute();
        return new DataResponse(['status' => 'success']);
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $education_id
     */
    public function deleteKMAEducation($education_id) {
        $query = $this->db->getQueryBuilder();
        $query->delete('kma_education')
            ->where($query->expr()->eq('education_id', $query->createNamedParameter($education_id)))
            ->execute();
        return new DataResponse(['status' => 'success']);
    }
    
    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $education_id
     * @param string $kma_uid
     * @param string $graduate_time
     * @param string $admision_time
     * @param string $training_unit
     * @param string $specialization
     * @param string $diploma
     * @param string $graduated_with
     * @return JSONResponse
     */
    public function updateInfoKMAEducation($education_id, $kma_uid = null, $graduate_time  = null, $admision_time = null, $training_unit = null, $specialization = null, $diploma = null, $graduated_with = null) {
      $query = $this->db->prepare('UPDATE `oc_kma_education` SET `kma_uid` = COALESCE(?, `kma_uid`), 
                                                            `graduate_time` = COALESCE(?, `graduate_time`), 
                                                            `admision_time` = COALESCE(?, `admision_time`), 
                                                            `training_unit` = COALESCE(?, `training_unit`),
                                                            `specialization` = COALESCE(?, `specialization`),
                                                            `diploma` = COALESCE(?, `diploma`), 
                                                            `graduated_with` = COALESCE(?, `graduated_with`), 
                                                                WHERE `education_id` = ?');
        $query->execute(array($relations_id, $graduate_time, $admision_time, $training_unit, $specialization, $diploma, $graduated_with, $kma_uid));
        return new JSONResponse(array('status' => 'success'));
    }
}
