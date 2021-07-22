<?php


namespace App\Core\Entity\Collection;


use App\Base\AbstractCollection;
use App\Core\Entity\SoldItem;
use ArrayIterator;
use Traversable;

/**
 * @method SoldItem[]|ArrayIterator|Traversable getIterator()
 * @method SoldItem|null                        next()
 * @method SoldItem|null                        current()
 * @method SoldItem|null                        first()
 * @method SoldItem|null                        last()
 * @method SoldItem|null                        get($key)
 */
class SoldItemCollection extends AbstractCollection
{
    protected function getClassName(): string
    {
        return SoldItem::class;
    }
}