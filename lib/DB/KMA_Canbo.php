<?php

namespace OCA\KMAUserManager\Db;

use OCP\AppFramework\Db\Entity;

class KMA_Canbo extends Entity {

    protected $username;
    protected $ma_cv;
    protected $ma_pb;
    protected $ho_ten;
    protected $ngay_sinh;
    protected $gioi_tinh;
    protected $sdt;
    protected $dia_chi;
    protected $cmnd_cccd;
    protected $email;

    public function __construct() {
        // add types in constructor
        $this->addType('username', 'string');
        $this->addType('ma_cv', 'string');
        $this->addType('ma_pb', 'string');
        $this->addType('ho_ten', 'string');
        $this->addType('ngay_sinh', 'datetime');
        $this->addType('gioi_tinh', 'boolean');
        $this->addType('sdt', 'string');
        $this->addType('dia_chi', 'string');
        $this->addType('cmnd_cccd', 'string');
        $this->addType('email', 'string');
    }
}