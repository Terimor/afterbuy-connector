<?php


namespace App\Core\Entity\Collection;


use App\Base\AbstractCollection;
use App\Core\Entity\Order;
use ArrayIterator;
use Traversable;

/**
 * @method Order[]|ArrayIterator|Traversable getIterator()
 * @method Order|null                        next()
 * @method Order|null                        current()
 * @method Order|null                        first()
 * @method Order|null                        last()
 * @method Order|null                        get($key)
 */
class OrderCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return Order::class;
    }

    public function getAllSoldItems(): SoldItemCollection
    {
        $soldItems = new SoldItemCollection();

        foreach ($this as $order) {
            foreach ($order->getSoldItems() as $soldItem) {
                $soldItems->add($soldItem);
            }
        }

        return $soldItems;
    }
}