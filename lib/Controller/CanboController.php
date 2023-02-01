<?php
namespace OCA\kmausermanager\Controller;

use OCP\IRequest;
use OCP\IDBConnection;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http;

class CanboController  extends Controller{
    private $db;

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
            ->from('kma_canbo');

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
    public function getKMAUser($username) {
        $query = $this->db->getQueryBuilder();
        $query->select('*')
            ->from('kma_canbo')
            ->where($query->expr()->eq('username', $query->createNamedParameter($username)));

        $result = $query->execute();
        $data = $result->fetch();
        if ($data === false) {
            return new DataResponse([], Http::STATUS_NOT_FOUND);
        }
        return new DataResponse([
            'usename' => $data['username'],
            'Ho va Ten' => $data['ho_ten'],
            'email' => $data['email'],
            // Add other desired user information here
        ]);
    }	
	

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $username
     * @param string $ma_cv
     * @param string $ma_pb
	 * @param string $ho_ten
     * @param string @sdt
     * @param string @dia_chi
     * @param string @email
     * @param string @cmnd_cccd
     */
    public function createCanbo($username, $ma_cv, $ma_pb, $ho_ten, $sdt, $dia_chi, $email, $cmnd_cccd) {
        $query = $this->db->getQueryBuilder();
        $query->insert('kma_canbo')
            ->values([
                'username' => $query->createNamedParameter($username),
                'ma_cv' => $query->createNamedParameter($ma_cv),
                'ma_pb' => $query->createNamedParameter($ma_pb),
                'ho_ten' => $query->createNamedParameter($ho_ten),
                'sdt' => $query->createNamedParameter($sdt),
                'dia_chi' => $query->createNamedParameter($dia_chi),
                'cmnd_cccd' => $query->createNamedParameter($cmnd_cccd),
                'email' => $query->createNamedParameter($email)

                // Add other desired columns here
            ])
            ->execute();
        return new DataResponse(['status' => 'success']);
    }


    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $username
     */
    public function deleteCanbo($username) {
        $query = $this->db->getQueryBuilder();
        $query->delete('kma_canbo')
            ->where($query->expr()->eq('username', $query->createNamedParameter($username)))
            ->execute();
        return new DataResponse(['status' => 'success']);
    }



    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     *
     * @param string $username
     * @param string $ma_cv
     * @param string $ma_pb
     * @param string $ho_ten
     * @param string $sdt
     * @param string $dia_chi
     * @param string $cmnd_cccd
     * @param string $email
     * @return JSONResponse
     */
    public function updateInfoKMA($username, $ma_cv=null, $ma_pb=null, $ho_ten=null, $sdt=null, $dia_chi=null, $cmnd_cccd=null, $email=null) {
        $query = $this->db->prepare('UPDATE `oc_kma_canbo` SET `ma_cv` = COALESCE(?, `ma_cv`), 
                                                            `ma_pb` = COALESCE(?, `ma_pb`), 
                                                            `ho_ten` = COALESCE(?, `ho_ten`),
                                                            `sdt` = COALESCE(?, `sdt`),
                                                            `dia_chi` = COALESCE(?, `dia_chi`),
                                                            `cmnd_cccd` = COALESCE(?, `cmnd_cccd`),
                                                            `email` = COALESCE(?, `email`)
                                                                WHERE `username` = ?');
        $query->execute(array($ma_cv, $ma_pb, $ho_ten, $sdt, $dia_chi, $cmnd_cccd, $email, $username));
        return new JSONResponse(array('status' => 'success'));
    }
}
