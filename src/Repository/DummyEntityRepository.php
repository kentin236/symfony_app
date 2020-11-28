<?php

namespace App\Repository;

use App\Entity\DummyEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DummyEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method DummyEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method DummyEntity[]    findAll()
 * @method DummyEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DummyEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DummyEntity::class);
    }

    // /**
    //  * @return DummyEntity[] Returns an array of DummyEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DummyEntity
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
