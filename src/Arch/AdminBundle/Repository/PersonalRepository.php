<?php

namespace Arch\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * PersonalRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PersonalRepository extends EntityRepository
{
    private $_table = 'ArchAdminBundle:Personal';

    public function findAll() {
        $qb = $this->_em->createQueryBuilder()
            ->select('per, pos, dep')
            ->from($this->_table, 'per')
            ->join('per.position', 'pos')
            ->join('per.department', 'dep');
        $res = $qb->getQuery()->getResult();
        return $res;
    }
}