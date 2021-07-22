<?php

namespace App\Core\Repository;

use App\Core\Entity\AfterbuyAccount;
use App\Core\Entity\Collection\AfterbuyAccountCollection;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AfterbuyAccountRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AfterbuyAccount::class);
    }

    public function findAll(): AfterbuyAccountCollection
    {
        return new AfterbuyAccountCollection(parent::findAll());
    }
}
