<?php

namespace App\Repository;

use App\Entity\RevelToNetsuiteHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RevelToNetsuiteHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method RevelToNetsuiteHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method RevelToNetsuiteHistory[]    findAll()
 * @method RevelToNetsuiteHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RevelToNetsuiteHistoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RevelToNetsuiteHistory::class);
    }

    // /**
    //  * @return RevelToNetsuiteHistory[] Returns an array of RevelToNetsuiteHistory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RevelToNetsuiteHistory
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
