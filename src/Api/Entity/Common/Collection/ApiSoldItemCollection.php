<?php


namespace App\Api\Entity\Common\Collection;


use App\Api\Entity\Common\ApiSoldItem;
use App\Base\AbstractCollection;

class ApiSoldItemCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return ApiSoldItem::class;
    }
}