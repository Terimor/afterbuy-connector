<?php

namespace App\Core\Repository;

use App\Core\Entity\CategoryRule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CategoryRule|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryRule|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryRule[]    findAll()
 * @method CategoryRule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CategoryRule::class);
    }

    // /**
    //  * @return CategoryRule[] Returns an array of CategoryRule objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CategoryRule
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
