<?php

namespace App\Core\Repository;

use App\Core\Entity\Category;
use App\Core\Entity\Collection\CategoryCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }

    public function findAll(): CategoryCollection
    {
        return new CategoryCollection(parent::findAll());
    }

    public function findOneById(int $id): Category
    {
        $qb = $this->createQueryBuilder('category')
            ->andWhere('category.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
