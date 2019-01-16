<?php

namespace App\Repository;

use App\Entity\SyncHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SyncHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method SyncHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method SyncHistory[]    findAll()
 * @method SyncHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SyncHistoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SyncHistory::class);
    }

    // /**
    //  * @return SyncHistory[] Returns an array of SyncHistory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SyncHistory
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    protected function someRandomInfo()
    {
        return $this->createQueryBuilder('s')
            ->getQuery()
            ->getOneOrNullResult();
    }
}
