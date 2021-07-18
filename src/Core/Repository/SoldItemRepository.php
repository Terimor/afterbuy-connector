<?php

namespace App\Core\Repository;

use App\Core\Entity\SoldItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SoldItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method SoldItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method SoldItem[]    findAll()
 * @method SoldItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SoldItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SoldItem::class);
    }
}
