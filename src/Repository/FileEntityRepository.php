<?php

namespace App\Repository;

use App\Entity\FileEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FileEntity|null find($id, $lockMode = null, $lockVersion = null)
 * @method FileEntity|null findOneBy(array $criteria, array $orderBy = null)
 * @method FileEntity[]    findAll()
 * @method FileEntity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FileEntityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FileEntity::class);
    }

    // /**
    //  * @return FileEntity[] Returns an array of FileEntity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FileEntity
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
