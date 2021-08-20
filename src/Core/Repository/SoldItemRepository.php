<?php

namespace App\Core\Repository;

use App\Core\Entity\Collection\SoldItemCollection;
use App\Core\Entity\SoldItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class SoldItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SoldItem::class);
    }

    public function save(SoldItem $soldItem): void
    {
        $this->getEntityManager()->persist($soldItem);
        $this->getEntityManager()->flush();
    }

    public function findAll(): SoldItemCollection
    {
        return new SoldItemCollection(parent::findAll());
    }

    public function findAllWithoutCategory(): SoldItemCollection
    {
        $qb = $this->createQueryBuilder('sold_item')
            ->andWhere('sold_item.category is null');

        return new SoldItemCollection($qb->getQuery()->getResult());
    }
}
