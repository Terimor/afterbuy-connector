<?php


namespace App\Core\Entity\Collection;


use App\Base\AbstractCollection;
use App\Core\Entity\SoldItem;

class SoldItemCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return SoldItem::class;
    }
}