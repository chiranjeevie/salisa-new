<?php

namespace App\Repository;

use App\Entity\NetsuiteToRevelHistory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method NetsuiteToRevelHistory|null find($id, $lockMode = null, $lockVersion = null)
 * @method NetsuiteToRevelHistory|null findOneBy(array $criteria, array $orderBy = null)
 * @method NetsuiteToRevelHistory[]    findAll()
 * @method NetsuiteToRevelHistory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NetsuiteToRevelHistoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, NetsuiteToRevelHistory::class);
    }

    // /**
    //  * @return NetsuiteToRevelHistory[] Returns an array of NetsuiteToRevelHistory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NetsuiteToRevelHistory
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
