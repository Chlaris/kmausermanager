<?php
namespace OCA\kmausermanager\Controller;

use OCP\IRequest;
use OCP\IDBConnection;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;

class KMARelationsController extends Controller{
    private $db;

    public function __construct($AppName, IRequest $request, IDBConnection $db) {
        parent::__construct($AppName, $request);
        $this->db = $db;
    }

    /**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */

    public function getAllKMARelations() {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_relations');

        $result = $query->execute();
        $relations = $result->fetchAll();
        return ['relations' => $relations];
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $relations_id
     */
    public function getKMARelation($relations_id) {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_relations')
            ->where($query->expr()->eq('relations_id', $query->createNamedParameter($relations_id)));

        $result = $query->execute();
        $data = $result->fetch();
        if ($data === false) {
            return new DataResponse([], Http::STATUS_NOT_FOUND);
        }
        return new DataResponse([
            'Ma nguoi than' => $data['relations_id'],
            'Ma can bo' => $data['kma_uid'],
            'Ho va Ten' => $data['full_name'],
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
     * @param string $kma_uid
     */
    public function getKMARelationBykmaUID($kma_uid) {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_relations')
            ->where($query->expr()->eq('kma_uid', $query->createNamedParameter($kma_uid)));

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
     * @param string $relations_id
     * @param string $kma_uid
     * @param string $full_name
     * @param string $date_of_birth
     * @param string $phone
     * @param string $address
     * @param string $relationship
     */
    public function createKMARelation($relations_id, $kma_uid, $full_name, $date_of_birth, $phone, $address, $relationship) {
        $query = $this->db->getQueryBuilder();
        $query->insert('kma_relations')
            ->values([
                'relations_id' => $query->createNamedParameter($relations_id),
                'kma_uid' => $query->createNamedParameter($kma_uid),
                'full_name' => $query->createNamedParameter($full_name),
                'date_of_birth' => $query->createNamedParameter($date_of_birth),
                'phone' => $query->createNamedParameter($phone),
                'address' => $query->createNamedParameter($address),
                'relationship' => $query->createNamedParameter($relationship),
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
    public function deleteKMARelation($relations_id) {
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
        $query->execute(array( $kma_uid, $full_name, $date_of_birth, $phone, $address, $relationship, $relations_id));
        return new JSONResponse(array('status' => 'success'));
    }
}
