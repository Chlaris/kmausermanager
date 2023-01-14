<?php

namespace OCA\KMAUserManager\Db;

use OCP\DB\QueryBuilder\IQueryBuilder;
use OCP\IDBConnection;
use OCP\AppFramework\Db\QBMapper;

class KMA_CanboMapper extends QBMapper {

    public function __construct(IDBConnection $db) {
        parent::__construct($db, 'oc_kma_canbo');
    }


    /**
     * @throws \OCP\AppFramework\Db\DoesNotExistException if not found
     * @throws \OCP\AppFramework\Db\MultipleObjectsReturnedException if more than one result
     */
    public function find(string $username) {
        $qb = $this->db->getQueryBuilder();

        $qb->select('*')
           ->from('oc_kma_canbo')
           ->where(
               $qb->expr()->eq('username', $qb->createNamedParameter($id, IQueryBuilder::PARAM_STRING))
           );

        return $this->findEntity($qb);
    }


    public function findAll($limit=null, $offset=null) {
        $qb = $this->db->getQueryBuilder();

        $qb->select('*')
           ->from('oc_kma_canbo')
           ->setMaxResults($limit)
           ->setFirstResult($offset);

        return $this->findEntities($sql);
    }
}