<?php

namespace App\Repository;

use App\Entity\RecommendedRequirements;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RecommendedRequirements|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecommendedRequirements|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecommendedRequirements[]    findAll()
 * @method RecommendedRequirements[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecommendedRequirementsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecommendedRequirements::class);
    }

    // /**
    //  * @return RecommendedRequirements[] Returns an array of RecommendedRequirements objects
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
    public function findOneBySomeField($value): ?RecommendedRequirements
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
