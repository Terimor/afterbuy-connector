<?php


namespace App\Core\Entity\Collection;


use App\Base\AbstractCollection;
use App\Core\Entity\AfterbuyAccount;

class AfterbuyAccountCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return AfterbuyAccount::class;
    }
}