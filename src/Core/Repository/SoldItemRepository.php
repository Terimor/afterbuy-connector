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

    public function findAll(): SoldItemCollection
    {
        return new SoldItemCollection(parent::findAll());
    }
}
