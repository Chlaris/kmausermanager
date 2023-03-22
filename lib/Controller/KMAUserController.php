<?php
namespace OCA\kmausermanager\Controller;

use OCP\IRequest;
use OCP\IDBConnection;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;
use OCP\AppFramework\OCS\OCSNotFoundException;

class KMAUserController  extends Controller{
    private $db;

    // /** @var IUserManager */
	// protected $userManager;

    // public function __construct($AppName, IRequest $request, IDBConnection $db, IUserManager $userManager) {
    //     parent::__construct($AppName, $request);
    //     $this->db = $db;
    //     $this->userManager = $userManager;
    // }

    public function __construct($AppName, IRequest $request, IDBConnection $db) {
        parent::__construct($AppName, $request);
        $this->db = $db;
    }

	/**
	 * CAUTION: the @Stuff turns off security checks; for this page no admin is
	 *          required and no CSRF check. If you don't know what CSRF is, read
	 *          it up in the docs or you might create a security hole. This is
	 *          basically the only required method to add this exemption, don't
	 *          add it to any other method if you don't exactly know what it does
	 * 
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
    public function sayHi() {
		$message = "It's work, brooooo";
        return new DataResponse($message);
    }


    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     */
    public function getAllKMAUser() {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_user');

        $result = $query->execute();
        $users = $result->fetchAll();
        return ['users' => $users];
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $userId
     */
    public function getKMAUser($kma_uid) {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_user')
            ->where($query->expr()->eq('kma_uid', $query->createNamedParameter($kma_uid)));

        $result = $query->execute();
        $data = $result->fetch();
        if ($data === false) {
            return new DataResponse([], Http::STATUS_NOT_FOUND);
        }
        return new DataResponse([
            'Usename' => $data['kma_uid'],
            'Ho va Ten' => $data['full_name'],
            'Ngay sinh' => $data['date_of_birth'],
            'Gioi tinh' => $data['gender'],
            'So dien thoai' => $data['phone'],
            'Dia chi' => $data['address'],
            'CCCD/CMND' => $data['id_number'],
            'Email' => $data['email'],
            'Ma chuc vu' => $data['position_id'],
            'Luong co so' => $data['salary'],
            'He so luong' => $data['coefficients_salary'],
            'Muc thue' => $data['tax'],
            'Ngay vao Dang' => $data['communist_party_joined'],
            'Ngay vao Dang chinh thuc' => $data['communist_party_confirmed'],
            'Ma don vi' => $data['unit_id'],
            // Add other desired user information here
        ]);
    }	
	

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $kma_uid
     * @param string $full_name
     * @param string $date_of_birth
	 * @param string $gender
     * @param string $phone
     * @param string $address
     * @param string $id_number
     * @param string $email
     * @param string $position_id
     * @param string $salary
     * @param string $coefficients_salary
     * @param string $tax
     * @param string $day_joined
     * @param string $communist_party_joined
     * @param string $communist_party_confirmed
     * @param string $unit_id
     */
    public function createKMAUser($kma_uid, $full_name, $date_of_birth, $gender, $phone, $address, $id_number, $email, $position_id, $salary, $coefficients_salary, $tax, $day_joined, $communist_party_joined, $communist_party_confirmed, $unit_id) {
        $user = $this->db->getQueryBuilder();
        $user->select('*')
            ->from('accounts')
            ->where($user->expr()->eq('uid', $user->createNamedParameter($kma_uid)));
        $result = $user->execute();
        $data = $result->fetch();
        if ($data === false) {
            return new DataResponse(["Don't have this account"], Http::STATUS_NOT_FOUND);
        }

        $query = $this->db->getQueryBuilder();
        $query->insert('kma_user')
            ->values([
                'kma_uid' => $query->createNamedParameter($kma_uid),
                'full_name' => $query->createNamedParameter($full_name),
                'date_of_birth' => $query->createNamedParameter($date_of_birth),
                'gender' => $query->createNamedParameter($gender),
                'phone' => $query->createNamedParameter($phone),
                'address' => $query->createNamedParameter($address),
                'id_number' => $query->createNamedParameter($id_number),
                'email' => $query->createNamedParameter($email),
                'position_id' => $query->createNamedParameter($position_id),
                'salary' => $query->createNamedParameter($salary),
                'coefficients_salary' => $query->createNamedParameter($coefficients_salary),
                'tax' => $query->createNamedParameter($tax),
                'day_joined' => $query->createNamedParameter($day_joined),
                'communist_party_joined' => $query->createNamedParameter($communist_party_joined),
                'communist_party_confirmed' => $query->createNamedParameter($communist_party_confirmed),
                'unit_id' => $query->createNamedParameter($unit_id),
                // Add other desired columns here
            ])
            ->execute();
        return new DataResponse(['status' => 'success']);
    }


    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $kma_uid
     */
    public function deleteKMAUser($kma_uid) {
        $query = $this->db->getQueryBuilder();
        $query->delete('kma_user')
            ->where($query->expr()->eq('kma_uid', $query->createNamedParameter($kma_uid)))
            ->execute();
        return new DataResponse(['status' => 'success']);
    }



    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $kma_uid
     * @param string $full_name
     * @param string $date_of_birth
	 * @param string $gender
     * @param string $phone
     * @param string $address
     * @param string $id_number
     * @param string $email
     * @param string $position_id
     * @param string $salary
     * @param string $coefficients_salary
     * @param string $tax
     * @param string $day_joined
     * @param string $communist_party_joined
     * @param string $communist_party_confirmed
     * @param string $unit_id
     * @return JSONResponse
     */
    public function updateInfoKMAUser($kma_uid, $id_number = null, $full_name  = null, $date_of_birth = null, $gender = null, $phone = null, $address = null, $email = null, $position_id = null, $salary = null, $coefficients_salary = null, $tax = null, $day_joined = null, $communist_party_joined = null, $communist_party_confirmed = null, $unit_id = null) {
        $query = $this->db->prepare('UPDATE `oc_kma_user` SET `id_number` = COALESCE(?, `id_number`), 
                                                            `full_name` = COALESCE(?, `full_name`), 
                                                            `date_of_birth` = COALESCE(?, `date_of_birth`), 
                                                            `gender` = COALESCE(?, `gender`),
                                                            `phone` = COALESCE(?, `phone`),
                                                            `address` = COALESCE(?, `address`),
                                                            `email` = COALESCE(?, `email`),
                                                            `position_id` = COALESCE(?, `position_id`),
                                                            `salary` = COALESCE(?, `id_number`),
                                                            `coefficients_salary` = COALESCE(?, `coefficients_salary`),
                                                            `tax` = COALESCE(?, `tax`),
                                                            `day_joined` = COALESCE(?, `day_joined`),
                                                            `communist_party_joined` = COALESCE(?, `communist_party_joined`),
                                                            `communist_party_confirmed` = COALESCE(?, `communist_party_confirmed`),
                                                            `unit_id` = COALESCE(?, `unit_id`)
                                                                WHERE `kma_uid` = ?');
        $query->execute(array($id_number, $full_name, $date_of_birth, $gender, $phone, $address, $email, $position_id, $salary, $coefficients_salary, $tax, $day_joined, $communist_party_joined, $communist_party_confirmed, $unit_id, $kma_uid));
        return new JSONResponse(array('status' => 'success'));
    }




    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $userId
     */
    public function getKMAUserbyPosition($position_id) {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_user')
            ->where($query->expr()->eq('position_id', $query->createNamedParameter($position_id)));

        $result = $query->execute();
        $data = $result->fetch();
        if ($data === false) {
            return new DataResponse([], Http::STATUS_NOT_FOUND);
        }
        return new DataResponse([
            'Usename' => $data['kma_uid'],
            'Ho va Ten' => $data['full_name'],
            'Ngay sinh' => $data['date_of_birth'],
            'Gioi tinh' => $data['gender'],
            'So dien thoai' => $data['phone'],
            'Dia chi' => $data['address'],
            'CCCD/CMND' => $data['id_number'],
            'Email' => $data['email'],
            'Ma chuc vu' => $data['position_id'],
            'Luong co so' => $data['salary'],
            'He so luong' => $data['coefficients_salary'],
            'Muc thue' => $data['tax'],
            'Ngay vao Dang' => $data['communist_party_joined'],
            'Ngay vao Dang chinh thuc' => $data['communist_party_confirmed'],
            'Ma don vi' => $data['unit_id'],
            // Add other desired user information here
        ]);
    }



    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $userId
     */
    public function getKMAUserbyUnit($unit_id) {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_user')
            ->where($query->expr()->eq('unit_id', $query->createNamedParameter($unit_id)));

        $result = $query->execute();
        $data = $result->fetch();
        if ($data === false) {
            return new DataResponse([], Http::STATUS_NOT_FOUND);
        }
        return new DataResponse([
            'Usename' => $data['kma_uid'],
            'Ho va Ten' => $data['full_name'],
            'Ngay sinh' => $data['date_of_birth'],
            'Gioi tinh' => $data['gender'],
            'So dien thoai' => $data['phone'],
            'Dia chi' => $data['address'],
            'CCCD/CMND' => $data['id_number'],
            'Email' => $data['email'],
            'Ma chuc vu' => $data['position_id'],
            'Luong co so' => $data['salary'],
            'He so luong' => $data['coefficients_salary'],
            'Muc thue' => $data['tax'],
            'Ngay vao Dang' => $data['communist_party_joined'],
            'Ngay vao Dang chinh thuc' => $data['communist_party_confirmed'],
            'Ma don vi' => $data['unit_id'],
            // Add other desired user information here
        ]);
    }

}
