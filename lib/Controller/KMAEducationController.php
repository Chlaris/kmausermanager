<?php
namespace OCA\kmausermanager\Controller;

use OCP\IRequest;
use OCP\IDBConnection;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;

class KMAREducationController extends Controller{
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
        $education = $result->fetchAll();
        return ['education' => $education];
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $userId
     */
    public function getKMARelation($relations_id) {
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
     * @param string $userId
     */
    public function getKMARelationById($kma_uid) {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_relations')
            ->where($query->expr()->eq('$kma_uid', $query->createNamedParameter($kma_uid)));

        $result = $query->execute();
        $data = $result->fetch();
        if ($data === false) {
            return new DataResponse([], Http::STATUS_NOT_FOUND);
        }
        return new DataResponse([
            'Ma nguoi than' => $data['relations_id'],
            'Ma can bo' => $data['kma_uid'],
            'Ho va Ten' => $data['  = null'],
            'Ngay sinh' => $data['date_of_birth'],
            'So dien thoai' => $data['phone'],
            'Dia chi' => $data['address'],
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
     * @param string $relations_id
     */
    public function deleteKMAUser($relations_id) {
        $query = $this->db->getQueryBuilder();
        $query->delete('kma_relations')
            ->where($query->expr()->eq('relations_id', $query->createNamedParameter($relations_id)))
            ->execute();
        return new DataResponse(['status' => 'success']);
    }
    
    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $relations_id
     * @param string $kma_uid
     * @param string $full_name
     * @param string $date_of_birth
     * @param string $phone
     * @param string $address
     * @param string $relationship
     * @return JSONResponse
     */
    public function updateInfoKMARelation($relations_id, $kma_uid = null, $full_name  = null, $date_of_birth = null, $phone = null, $address = null, $relationship = null) {
      $query = $this->db->prepare('UPDATE `oc_kma_relations` SET `kma_uid` = COALESCE(?, `kma_uid`), 
                                                            `full_name` = COALESCE(?, `full_name`), 
                                                            `date_of_birth` = COALESCE(?, `date_of_birth`), 
                                                            `phone` = COALESCE(?, `phone`),
                                                            `address` = COALESCE(?, `address`),
                                                            `relationship` = COALESCE(?, `relationship`)
                                                                WHERE `relations_id` = ?');
        $query->execute(array($relations_id, $full_name, $date_of_birth, $phone, $address, $relationship, $kma_uid));
        return new JSONResponse(array('status' => 'success'));
    }
}
