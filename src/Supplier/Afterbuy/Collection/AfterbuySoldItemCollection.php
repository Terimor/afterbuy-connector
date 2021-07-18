<?php


namespace App\Supplier\Afterbuy\Collection;


use App\Base\AbstractCollection;
use App\Supplier\Afterbuy\Common\AfterbuySoldItem;

class AfterbuySoldItemCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return AfterbuySoldItem::class;
    }
}