<?php


namespace App\Supplier\Afterbuy\Collection;


use App\Base\AbstractCollection;
use App\Supplier\Afterbuy\Common\AfterbuyOrder;

class AfterbuyOrderCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return AfterbuyOrder::class;
    }
}