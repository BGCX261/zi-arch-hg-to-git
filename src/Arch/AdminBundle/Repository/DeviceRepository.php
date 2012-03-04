<?php

namespace Arch\AdminBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * DeviceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class DeviceRepository extends EntityRepository
{
    protected $_table = 'ArchAdminBundle:Device';

    public function findAll()
    {
        $qb = $this->_em->createQueryBuilder()
            ->select('dev, per')
            ->from($this->_table, 'dev')
            ->join('dev.personal', 'per');
        $res = $qb->getQuery()->getResult();
        return $res;
    }

    public function find($id)
    {
        $qb = $this->_em->createQueryBuilder()
            ->select('dev, per, hard, soft')
            ->from($this->_table, 'dev')
            ->join('dev.personal', 'per')
            ->join('dev.software', 'soft')
            ->join('dev.hardware', 'hard')
            ->andWhere('dev.id = :id')->setParameter('id', $id);
        $res = $qb->getQuery()->getResult();

        return count($res) ? $res[0] : false;
    }

    public function findByHardware($hardwareId)
    {
        $qb = $this->_em->createQueryBuilder()
            ->select('dev, hard')
            ->from($this->_table, 'dev')
            ->join('dev.hardware', 'hard')
            ->andWhere('hard.id = :id')->setParameter('id', $hardwareId);
        $res = $qb->getQuery()->getResult();
        return $res;
    }

    public function findBySoftware($softwareId)
    {
        $qb = $this->_em->createQueryBuilder()
            ->select('dev, soft')
            ->from($this->_table, 'dev')
            ->join('dev.software', 'soft')
            ->andWhere('soft.id = :id')->setParameter('id', $softwareId);
        $res = $qb->getQuery()->getResult();
        return $res;
    }
}