<?php

namespace App\Repository;

use App\Entity\AnalysisType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AnalysisType|null find($id, $lockMode = null, $lockVersion = null)
 * @method AnalysisType|null findOneBy(array $criteria, array $orderBy = null)
 * @method AnalysisType[]    findAll()
 * @method AnalysisType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnalysisTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AnalysisType::class);
    }

    // /**
    //  * @return AnalysisType[] Returns an array of AnalysisType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AnalysisType
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
