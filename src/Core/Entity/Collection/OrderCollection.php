<?php


namespace App\Core\Entity\Collection;


use App\Base\AbstractCollection;
use App\Core\Entity\Order;

class OrderCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return Order::class;
    }
}